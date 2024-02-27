<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Task;
use App\StatusConfig;
use App\Attachment;
use App\TimeLog;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
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
        $data['status_configs'] = StatusConfig::all();
        if(Auth::user()->role == 'admin'){
            $data['tasks'] = Task::orderBy('created_at','DESC')->get();
        }else if(Auth::user()->role == 'developer'){
            $data['tasks'] = Task::where('dev_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        }else if(Auth::user()->role == 'user'){
            $data['tasks'] = Task::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        }
        $data['order_tasks'] = $data['tasks']->where('status_id',1);
        $data['pending_tasks'] = $data['tasks']->where('status_id',2);
        $data['running_tasks'] = $data['tasks']->where('status_id',3);
        $data['smooth_tasks'] = $data['tasks']->where('status_id',4);
        $data['done_tasks'] = $data['tasks']->where('status_id',5);
        $data['cancel_tasks'] = $data['tasks']->where('status_id',6);

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
        $data['products'] = Product::with('faqs')->get();
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
        // Validation rules
        $rules = [
            'product_id' => 'required',
            'faq_id' => 'required',
            'type' => 'required',
            'type' => 'required',
        ];

        // Validation messages
        $messages = [
            'product_id.required' => 'Please select a product.',
            'faq_id.required' => 'Please select a faq.',
        ];

        //task added
        $task = new Task();
        $task->user_id = $request->user_id??Auth::user()->id;
        $task->product_id = $request->product_id;
        $task->faq_id = $request->faq_id;
        $task->type = $request->type;
        $task->status_id = 1;
        $task->service_warranty_start_date = $request->service_warranty_start_date;
        $task->service_warranty_end_date = $request->service_warranty_end_date;
        $task->description = $request->description;
        $task->dev_id = $request->dev_id;
        $task->progress = 0;
        $task->save();

        //timelog added
        $timelog = $task->timelog;
        if(!isset($timelog)){
            $timelog = new Timelog();
        }else{
            $timelog = $task->timelog;
        }
        $timelog->task_id = $task->id;
        $timelog->order_at = Carbon::now();
        $timelog->save();

        //attachment added
        $attachment = new Attachment();
        $attachment->task_id = $task->id;
        if(isset($request->photo_1)){
            $attachment->photo_1 = $request->photo_1->store('attachments/task_id_'.$task->id); // nrc back added
        }
        if(isset($request->photo_2)){
            $attachment->photo_2 = $request->photo_2->store('attachments/task_id_'.$task->id); // nrc back added
        }
        if(isset($request->photo_3)){
            $attachment->photo_3 = $request->photo_3->store('attachments/task_id_'.$task->id); // nrc back added
        }
        if(isset($request->photo_4)){
            $attachment->photo_4 = $request->photo_4->store('attachments/task_id_'.$task->id); // nrc back added
        }
        if(isset($request->photo_5)){
            $attachment->photo_5 = $request->photo_5->store('attachments/task_id_'.$task->id); // nrc back added
        }
        if(isset($request->receipt)){
            $attachment->receipt = $request->receipt->store('attachments/task_id_'.$task->id); // nrc back added
        }
        $attachment->save();

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
        $data['task'] = Task::findorfail($id);
        $data['attachment'] =  $data['task']->attachment;
        $data['timelog'] = $data['task']->timelog;
        self::foldercopy($id);
        return view('task_views.taskdetail',$data);
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
        $data['attachment'] =  $data['task']->attachment;
        $data['users'] = User::where('role','user')->get();
        $data['developers'] = User::where('role','developer')->get();
        $data['status_configs'] = StatusConfig::all();
        $data['products'] = Product::with('faqs')->get();
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
        $task->user_id = $request->user_id??$task->user_id;
        $task->product_id = $request->product_id??$task->product_id;
        $task->faq_id = $request->faq_id??$task->faq_id;
        $task->type = $request->type??$task->type;
        $task->status_id = $request->status_id??$task->status_id;
        //calculate cost
        if($request->status_id==5 || $task->status_id == 5){
            if ($task->type == 'service_ticket') {
                $task->cost = $task->duration * $task->product->price->service_ticket_price;
            }else{

                $task->cost = $task->duration * $task->product->price->change_request_price;
            }
        }
        // dd($task->cost);
        $task->service_warranty_start_date = $request->service_warranty_start_date??$task->service_warranty_start_date;
        $task->service_warranty_end_date = $request->service_warranty_end_date??$task->service_warranty_end_date;
        $task->description = $request->description??$task->service_warranty_end_date;
        $task->dev_id = $request->dev_id??$task->dev_id;
        $task->progress = $request->progress??$task->progress;
        $task->duration = $request->duration??$task->duration;
        $task->canceled_cmt = $request->canceled_cmt??$task->canceled_cmt;
        $task->save();

        //timelog added
        $timelog = $task->timelog;
        if(!isset($timelog)){
            $timelog = new Timelog();
        }else{
            $timelog = $task->timelog;
        }
        $str = $task->status->name.'_at';
        $timelog->task_id = $task->id;
        $timelog->$str = Carbon::now();
        $timelog->save();

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
        return redirect('/tasks')->with(['success'=>'Task is deleted']);
    }

    // protected function filemover($sourcepath,$task_id){
    //     try {
    //      if($sourcepath != null && $sourcepath != ''){
    //          $sourceFilePath=storage_path('app/'.$sourcepath);


    //          $path = public_path().'/attachments/task_id_'.$task_id;
    //          if (File::exists($path)){
    //              $destinationPath=public_path('/attachments/task_id_'.$task_id);
    //              File::deleteDirectory($destinationPath);
    //              try {
    //                  File::copy($sourceFilePath, $destinationPath);
    //              } catch (\Throwable $th) {
    //                 return;
    //              }
    //          }else if(File::exists(public_path().'/NLoan')){
    //              File::makeDirectory(public_path().'/NLoan/contract_'.$task_id);
    //              $destinationPath=public_path("NLoan/contract_".$task_id."/".$string);
    //              try {
    //                 File::copy($sourceFilePath, $destinationPath);
    //             } catch (\Throwable $th) {
    //                return;
    //             }
    //          }else{
    //              File::makeDirectory(public_path().'/NLoan');
    //              File::makeDirectory(public_path().'/NLoan/contract_'.$task_id);
    //              $destinationPath=public_path("NLoan/contract_".$task_id."/".$string);
    //              try {
    //                 File::copy($sourceFilePath, $destinationPath);
    //             } catch (\Throwable $th) {
    //                return;
    //             }
    //          };
    //         //  dd($destinationPath);
    //          return [$caption,$name];
    //         }
    //     } catch (\Exception $e) {
    //         return;
    //     }
    // }

    protected function foldercopy($task_id){
        $sourcePath = storage_path('app/attachments/task_id_'.$task_id); // Path to the folder you want to copy
        $destinationPath = public_path('attachments/task_id_'.$task_id); // Destination path in the public directory

        // Copy the folder recursively
        File::copyDirectory($sourcePath, $destinationPath);
    }
}
