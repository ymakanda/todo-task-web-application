<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTodoTaskList extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'todo_task_list_id',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function todoTasks()
    {
        return $this->hasMany(TodoTaskList::class);
    }
}
