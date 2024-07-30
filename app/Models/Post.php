<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'post';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $guarded = ['id']; //messassignment-auto generate

    //protected $fillable = ['fillable']; //user wajib isi, pilih salah satu

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        //return $this->belongsTo(User::class); //boleh guna mcm ni jika betul Naming Convensyen
        return $this->belongsTo(User::class, 'author', 'id'); //fk (connect), pk (user)
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id'); //fk (connect-ANAK), pk (user-BAPAk)
    }


}