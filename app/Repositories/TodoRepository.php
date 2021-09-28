<?php 
namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

/**
 * summary
 */
class TodoRepository implements TodoRepositoryInterface
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public function all()
    {
    	return Todo::orderByDesc('id')->where('user_id', auth()->user()->id)
            ->with('user', 'todo_status')
            ->get()
            ->map(function($todo) {
                return $todo->format();
            });
    }

    public function findById($todo)
    {
    	return Todo::with('user', 'todo_status')->where('id', $todo)->firstOrFail();
    }

    public function create($data)
    {
    	return Todo::create(
    		[
                'name' => $data['todo'], 
                'user_id' => auth()->user()->id,
                'todo_status_id' => $data['status'],

            ]
        );
    }

    public function update($data)
    {
    	$this->findById($data['id'])->update([
    		'name' => $data['todo'], 
    		'todo_status_id' => $data['status'],
    	]);
    }
}

 ?>