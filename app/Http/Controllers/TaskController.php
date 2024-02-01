<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
use App\StatusConfig;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['tasks'] = Task::all();

        return view('task_views.showtasks',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['users'] = User::where('role','user')->get();
        $data['developers'] = User::where('role','developer')->get();
        return view('task_views.createtask',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $task = new Task();
        $task->user_id = $request->user_id;
        $task->product_id = $request->product_id;
        $task->faq_id = $request->faq_id;
        $task->type = $request->type;
        $task->status = $request->status;
        $task->service_warranty_start_date = $request->service_warranty_start_date;
        $task->service_warranty_end_date = $request->service_warranty_end_date;
        $task->description = $request->description;
        $task->dev_id = $request->dev_id;
        $task->save();
        return redirect()->back()->with(['success'=>'Task is inserted!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['task'] = Task::findorfail($id);
        $data['users'] = User::where('role','user')->get();
        $data['developers'] = User::where('role','developer')->get();
        $data['status_configs'] = StatusConfig::all();
        return view('task_views.edittask',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = Task::findorfail($id);
        $task->user_id = $request->user_id;
        $task->product_id = $request->product_id;
        $task->faq_id = $request->faq_id;
        $task->type = $request->type;
        $task->status = $request->status;
        $task->service_warranty_start_date = $request->service_warranty_start_date;
        $task->service_warranty_end_date = $request->service_warranty_end_date;
        $task->description = $request->description;
        $task->dev_id = $request->dev_id;
        $task->save();
        return redirect()->back()->with(['success'=>'Task is updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::findorfail($id);
        $task->delete();
        return redirect()->back()->with(['success'=>'Task is deleted']);
    }
}
