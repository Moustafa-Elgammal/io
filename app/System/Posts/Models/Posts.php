<?php


namespace System\Posts\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use System\Comments\Models\Comments;

class Posts extends Model
{
    protected $table = 'posts';
    use SoftDeletes;

    public function comments(){
        return $this->hasMany(Comments::class, 'post_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
