<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['users'] = User::where('role','!=','admin')->get();

        return view('user_views.showusers',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user_views.createuser');
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
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'phone_1' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ];

        // Validation messages
        $messages = [
            'username.unique' => 'Username has already been taken.',
            'email.unique' => 'Email has already been taken.',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone_1 = $request->phone_1;
        $user->phone_2 = $request->phone_2;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(['success'=>'User data is inserted!']);
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
        $data['user'] = User::findorfail($id);
        $data['caption'] = 'Edit User';
        return view('user_views.edituser',$data);
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
        // Validation rules
        $rules = [
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required|string|max:255',
            'phone_1' => 'required|string|max:20',
        ];

        // Validation messages
        $messages = [
            'username.unique' => 'Username has already been taken.',
            'email.unique' => 'Email has already been taken.',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findorfail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone_1 = $request->phone_1;
        $user->phone_2 = $request->phone_2;
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with(['success'=>'User data is updated!']);
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
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->back()->with(['success'=>'User data is deleted']);
    }
}
