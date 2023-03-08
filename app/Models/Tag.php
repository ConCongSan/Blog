<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 */
class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tag';
    protected $fillable = [
        'name'
    ];

    public function tag()
    {
        return $this->hasOne(Post::class,'tag_id');
    }
}
