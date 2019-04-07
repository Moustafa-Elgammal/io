<?php


namespace System\Comments\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use System\Posts\Models\Posts;

class Comments extends Model
{
    protected $table = "posts_comments";

    public function post()
    {
        return $this->belongsTo(Posts::class,'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
