<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusConfig;
use App\Task;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;


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
        if(Auth::user()->role == 'admin'){
            $data['tasks'] = Task::all();
        }else if(Auth::user()->role == 'developer'){
            $data['tasks'] = Task::where('dev_id',Auth::user()->id)->get();
        }else if(Auth::user()->role == 'user'){
            $data['tasks'] = Task::where('user_id',Auth::user()->id)->get();
        }
        $data['order_tasks'] = $data['tasks']->where('status_id',1);
        $data['order'] = count($data['order_tasks']);
        $data['pending_tasks'] = $data['tasks']->where('status_id',2);
        $data['pending'] = count($data['pending_tasks']);
        $data['running_tasks'] = $data['tasks']->where('status_id',3);
        $data['running'] = count($data['running_tasks']);
        $data['smooth_tasks'] = $data['tasks']->where('status_id',4);
        $data['smooth'] = count($data['smooth_tasks']);
        $data['done_tasks'] = $data['tasks']->where('status_id',5);
        $data['done'] = count($data['done_tasks']);
        $data['cancel_tasks'] = $data['tasks']->where('status_id',6);
        $data['cancel'] = count($data['cancel_tasks']);
        // $results = Task::join('status_configs', 'tasks.status_id', '=', 'status_configs.id')
        //             ->select('status_configs.status', DB::raw('COUNT(*) as status_count'))
        //             ->groupBy('status_configs.status')
        //             ->get();
        // foreach($results as $result){
        //     $data[$result->status] = $result->status_count??0;
        // }
        // dd($data);
        return view('welcome',$data);
    }

    public function toggledarkmode(Request $req){
        $is_darked = $req->is_darked;
        // Session::put('is_darked', !$is_darked);
        session(['is_darked' => !$is_darked]);
        return response()->json(['is_darked'=>!$is_darked]);
    }
}
