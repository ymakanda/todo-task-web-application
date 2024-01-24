<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\TodoTaskList;
use \App\Models\UserTodoTaskList;

class UserTodoTaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);
        $todoTask = TodoTaskList::find(1);
        
        if($user && $todoTask){
            $userTodo = UserTodoTaskList::create([
                'user_id' => $user->id,
                'todo_task_list_id' => $todoTask->id,
            ]);
        }
        
    }
}
