<?php

namespace App;

use App\Mail\AlphaKeyMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class AlphaKey extends Model
{
    protected $fillable = [
        'alpha_sign_up_id',
        'recipient_email',
        'recipient_user_id',
        'assigned_by',
        'key',
        'email_sent_at'
    ];

    public static function generateKey(): string
    {
        return Uuid::uuid4();
    }

    public function alphaSignUp(): BelongsTo
    {
        return $this->belongsTo(AlphaSignUp::class);
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function sendEmail(): AlphaKey
    {
        Mail::to($this->recipient_email)
            ->queue(new AlphaKeyMail($this));

        return $this;
    }
}
