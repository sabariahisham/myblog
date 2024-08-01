<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $guarded = ['id'];

    function getRouteKeyName()
    {
        return 'uuid'; //untuk guna uuid
    }

    public function user() //turun dlm bentuk model
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function comments() //turun dlm bentuk collection
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}