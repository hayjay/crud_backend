<?php 
namespace App\Repositories;

use App\Interfaces\TodoStatusRepositoryInterface;
use App\Models\TodoStatus;

class TodoStatusRepository implements TodoStatusRepositoryInterface
{
    /**
     * Responsible for statuses of a todo
     */
    public function __construct()
    {
        
    }

    public function all()
    {
    	return TodoStatus::all();
    }
}

 ?>