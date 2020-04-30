<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = Task::where('done', 0)->get();
        $doneTasks = Task::where('done', 1)->get();

        return view('home')
        ->with([
            'tasks' => $tasks, 
            'doneTasks' => $doneTasks
            ]);
    }
}
