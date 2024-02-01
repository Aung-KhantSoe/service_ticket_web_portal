<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusConfig;
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
        $data['status_configs'] = StatusConfig::all();
        $data['tasks'] = Task::all();
        $data['order_tasks'] = $data['tasks']->where('status','order');
        $data['pending_tasks'] = $data['tasks']->where('status','pending');
        $data['running_tasks'] = $data['tasks']->where('status','running');
        $data['smooth_tasks'] = $data['tasks']->where('status','smooth');
        $data['done_tasks'] = $data['tasks']->where('status','done');
        $data['cancel_tasks'] = $data['tasks']->where('status','cancel');
        return view('welcome',$data);
    }
}
