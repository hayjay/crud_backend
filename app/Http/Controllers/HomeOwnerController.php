<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HomeOwner\StoreRequest;
use App\Services\HomeOwner\StoreService;

class HomeOwnerController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        
    }

    public function create()
    {
        return view('index');
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            (new StoreService(request()->file('home_owner_data')))->run();
            return back()->with('success', 'You\'ve successfully uploaded the homeowner data.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
    }

}
