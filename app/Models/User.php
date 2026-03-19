<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected function initials(): Attribute{
        return Attribute::make(
            get: function () {

                $words = explode (' ', trim($this->name));

                if (count($words) === 1 ){
                    return strtoupper(mb_substr($words[0], 0, 2));
                }
                $firstLetter = mb_substr($words[0], 0, 1);
                $lastLetter = mb_substr(end($words), 0, 1);

                return strtoupper($firstLetter . $lastLetter);
            },

        );

    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    // public function initials(): string
    // {
    //     return Str::of($this->name)
    //         ->explode(' ')
    //         ->take(2)
    //         ->map(fn ($word) => Str::substr($word, 0, 1))
    //         ->implode('');
    // }
}
