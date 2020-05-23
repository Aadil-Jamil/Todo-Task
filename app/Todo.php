<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['taskText', 'user_id', 'isDone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
