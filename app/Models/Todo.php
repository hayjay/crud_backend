<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'todo_status_id', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function todo_status()
    {
    	return $this->belongsTo(TodoStatus::class);
    }

    public function format()
    {
    	return [
            'id' => $this->id,
            'name' => $this->name,
            'owner' => $this->user->name,
            'status' => $this->todo_status->name,
        ];
    }
}
