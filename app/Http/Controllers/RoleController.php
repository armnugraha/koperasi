<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use Session, Validator, DB, Auth;

use App\Role;

class RoleController extends Controller
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
            $data = Role::select(DB::raw('@rownum  := @rownum  + 1 AS no'),'roles.*');

            return Datatables::of($data)->make(true);
        }

        return view("roles.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("roles.create");
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
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/roles/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Role::create($requestData);

        Session::flash('flash_message', 'Role added!');

        return redirect('/roles');
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
    public function edit(Role $role)
    {
        return view("roles.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/roles/'.$role->id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $getRole = Role::findOrFail($role->id);
        $getRole->update($requestData);

        Session::flash('flash_message', 'Role updated!');

        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::where('id', $role->id)->delete();

        Session::flash('flash_message', 'Role deleted!');

        return 'ok';
    }
}
