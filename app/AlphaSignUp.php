<?php

namespace App;

use App\Mail\AlphaSignUpMail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;

/**
 * Class AlphaSignUp
 * @package App
 * @mixin Builder
 */
class AlphaSignUp extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'user_agent',
        'ip_address'
    ];

    /**
     * The authenticated user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function alphaKeys(): HasMany
    {
        return $this->hasMany(AlphaKey::class);
    }

    public function sendEmail(): AlphaSignUp
    {
        Mail::to($this->email)
            ->queue(new AlphaSignUpMail($this));

        return $this;
    }
}
