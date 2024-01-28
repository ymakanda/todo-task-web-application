<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\TodoTaskList;

class TodoTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_todo_task_list_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $todo = TodoTaskList::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('all-todo-task-list'));
        
        $response->assertOk();
    }

    public function test_show_todo_task_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $todo = TodoTaskList::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('view-todo', ['id' =>$todo->id]));
        
        $response->assertOk();
    }
    
    public function test_todo_task_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        $todo = TodoTaskList::factory()->create();
        $response = $this
            ->actingAs($user)
            ->put(route('update-todo', [
                'id' => $todo->id,
                'title' => 'Test User',
                'description' => 'Task todo is updated',
                'comments'  => 'Todo task is due'
            ]));
            
        $response
            ->assertRedirect(route('all-todo-task-list'));

        $todo->refresh();
        $this->assertSame('Test User', $todo->title);
        $this->assertSame('Task todo is updated', $todo->description);
        $this->assertNotNull($todo->comments);
    }

    public function test_todo_task_title_is_more_than_5(): void
    {
        $user = User::factory()->create();
        $todo = TodoTaskList::factory()->create();
        $title = \Faker\Factory::create()->text(maxNbChars:6);
        $response = $this
            ->actingAs($user)
            ->post(route('store-todo', [
                'title' => $title,
                'description' => 'Task todo is updated',
                'comments'  => 'this is due tomorrow'
            ]));
            $response
            ->assertRedirect(route('all-todo-task-list'));
    }

    
}
