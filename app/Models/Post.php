<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // para convervar el nombre belongs_to en posts y no user_id, pero enlazarlo aqui
    public function user(){
        return $this->belongsTo(User::class, 'belongs_to'); 
    }

    // Relacion un post a muchos comentarios
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
