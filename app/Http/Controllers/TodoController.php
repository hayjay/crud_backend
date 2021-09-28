<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\{StoreRequest, UpdateRequest};
use App\Interfaces\{TodoRepositoryInterface, TodoStatusRepositoryInterface};

class TodoController extends Controller
{  
    private $todoRepository;
    private $todoStatusRepository;


    public function __construct(TodoRepositoryInterface $todoRepository, TodoStatusRepositoryInterface $todoStatusRepository)
    {
        $this->todoRepository = $todoRepository;
        $this->todoStatusRepository = $todoStatusRepository;
        return $this->middleware('auth');
    }

    public function index()
    {
        
    }

    public function create()
    {
        $todos = $this->todoRepository->all();
        $statuses = $this->todoStatusRepository->all();
        return view('home', compact('todos', 'statuses'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $this->todoRepository->create($data);
            return back()->with('success', 'Todo created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        } 
    }

    public function update(UpdateRequest $request, $todo)
    {
        $data = $request->validated();
        $this->todoRepository->update([
            'todo' => $data['todo'],
            'status' => $data['status'],
            'id' => $todo
        ]);
        return redirect(route('all_todos'))->with('success', 'Todo updated successfully.');
    }

}
