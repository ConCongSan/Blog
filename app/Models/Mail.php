<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $user
 * @property mixed $user_id
 * @property mixed $mail
 * @property mixed $content
 */
class Mail extends Model
{
    use HasFactory;

    protected $table = 'email';
    protected $fillable = [
        'mail',
        'content',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMailNameAttribute()
    {
        $name = $this->user->username;
        return $name;
    }
}
