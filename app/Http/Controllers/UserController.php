<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use Session, Validator, DB, Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));
            $data = User::select(DB::raw('@rownum  := @rownum  + 1 AS no'),'users.*');

            return Datatables::of($data)->make(true);
        }

        return view("users.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        
        $validator = Validator::make($requestData, [
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/users/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $requestData["password"] = bcrypt($requestData['password']);

        $db = User::create($requestData);

        $db->attachRole($requestData['role']);

        Session::flash('flash_message', 'User added!');

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("users.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id != $user->id && !\Laratrust::can("update-users")) {
            return abort(404);
        }

        $data = User::select('users.id','users.username','users.name', 'users.email','roles.id as role')
                ->join('role_user','role_user.user_id','users.id')
                ->join('roles','role_user.role_id','roles.id')
                ->where('users.id',$user->id)
                ->first();

        return view("users.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if (Auth::user()->id != $user->id && !\Laratrust::can("update-users")) {
            return abort(404);
        }

        $requestData = $request->all();
        
        $validator = Validator::make($requestData, [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/users/'.$user->id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $requestData["password"] = bcrypt($requestData['password']);

        $db = User::select('users.*','roles.id as role')
                ->join('role_user','role_user.user_id','users.id')
                ->join('roles','role_user.role_id','roles.id')
                ->find($user->id);

        $db->update($requestData);

        $db->detachRole($db->role);
        $db->attachRole($request['role']);

        Session::flash('flash_message', 'User updated!');

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->delete();

        Session::flash('flash_message', 'User deleted!');

        return 'ok';
    }
}
