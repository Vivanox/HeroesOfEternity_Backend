<?php

namespace Tests\Feature;

use App\AlphaSignUp;
use App\Mail\AlphaKeyMail;
use App\Mail\AlphaSignUpMail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use function factory;
use function route;

class AlphaSignUpTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateAnAlphaSignUpAsAnAuthenticatedUser()
    {
        Mail::fake();

        Sanctum::actingAs(
            $user = factory(User::class)->create()
        );

        $this
            ->postJson('/api/alpha-sign-up', ['email' => 'john@example.com'])
            ->assertSuccessful();

        $this->assertDatabaseHas('alpha_sign_ups', [
            'user_id' => $user->id,
            'email' => 'john@example.com',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Symfony'
        ]);

        Mail::assertQueued(AlphaSignUpMail::class, function (AlphaSignUpMail $mail) {
            return $mail->hasTo('john@example.com');
        });
    }

    public function testCanCreateAnAlphaSignUpAsAGuest()
    {
        Mail::fake();

        $this
            ->postJson('/api/alpha-sign-up', ['email' => 'john@example.com'])
            ->assertSuccessful();

        $this->assertDatabaseHas('alpha_sign_ups', [
            'user_id' => null,
            'email' => 'john@example.com',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Symfony'
        ]);

        Mail::assertQueued(AlphaSignUpMail::class, function (AlphaSignUpMail $mail) {
            return $mail->hasTo('john@example.com');
        });
    }

    public function testAnAdminCanAssignAlphaKey()
    {
        Mail::fake();

        User::$AdminEmails = ['john@example.com'];
        Sanctum::actingAs(
            $admin = factory(User::class)->create(['email' => 'john@example.com'])
        );

        $alphaSignUp = factory(AlphaSignUp::class)->create(['email' => 'jessie@example.com']);

        $this->post(route('alpha-sign-up.assign-alpha-key', $alphaSignUp));

        $this->assertDatabaseHas('alpha_keys', [
            'alpha_sign_up_id' => $alphaSignUp->id,
            'recipient_email' => $alphaSignUp->email,
            'recipient_user_id' => $alphaSignUp->user_id,
            'assigned_by' => $admin->id
        ]);

        Mail::assertQueued(AlphaKeyMail::class, function (AlphaKeyMail $mail) {
            return $mail->hasTo('jessie@example.com');
        });
    }

    public function testNonAdminCannotAssignAlphaKey()
    {
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $alphaSignUp = factory(AlphaSignUp::class)->create();

        $this->post(route('alpha-sign-up.assign-alpha-key', $alphaSignUp));

        $this->assertDatabaseMissing('alpha_keys', [
            'alpha_sign_up_id' => $alphaSignUp->id,
        ]);
    }

    public function testGuestCannotAssignAlphaKey()
    {
        $alphaSignUp = factory(AlphaSignUp::class)->create(['email' => 'jessie@example.com']);

        $this->postJson(route('alpha-sign-up.assign-alpha-key', $alphaSignUp))
            ->assertUnauthorized();
    }
}
