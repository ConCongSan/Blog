<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 * @method static where(string $string, string $string1, $data)
 * @method static orderBy(string $string, string $string1)
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'post';
    protected $fillable = [
        'title',
        'content',
        'image',
        'tag_id',
        'username',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'user_id');
    }

    public function name()
    {
        return $this->belongsTo(Tag::class);
    }
}
