<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct(){
        // OTORISASI GATE

        $this->middleware(function($request, $next){
            if(Gate::allows('manage-users')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::paginate(25);

        $filterKeyword = $request->get('email');

        if($filterKeyword){
            $users = \App\User::where("email", "LIKE", "%$filterKeyword%")->paginate(10);
        }
        
        return view('users.index', ['users' => $users]);
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
        \Validator::make($request->all(), [
            "name" => "required|min:3|max:200",
            "nik" => "required|min:16",
            "no_telp" => "required|min:11|max:13",
            "no_wa" => "required|min:11|max:13",
            "email" => "required|email|max:200",
            "password" => "required|min:8|max:200|confirmed",
            "password_confirmation" => "required|same:password"
        ])->validate();

        $new_user = new \App\User;
        $new_user->name = $request->get('name');
        $new_user->nik = $request->get('nik');
        $new_user->no_telp = $request->get('no_telp');
        $new_user->no_wa = $request->get('no_wa');
        $new_user->email = $request->get('email');
        $new_user->password = \Hash::make($request->get('password'));
                
        $new_user->save();
        
        return redirect()->route('users.create')->with('status', 'Operator successfully saved');
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
        $user = \App\User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
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
        $user = \App\User::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|min:3|max:200",
            "nik" => "required|min:16",
            "no_telp" => "required|min:11|max:13",
            "no_wa" => "required|min:11|max:13",
            "email" => "required|email|max:200"
        ])->validate();

        $user->name = $request->get('name');
        $user->nik = $request->get('nik');
        $user->no_telp = $request->get('no_telp');
        $user->no_wa = $request->get('no_wa');
        $user->email = $request->get('email');
                
        $user->save();
        
        return redirect()->route('users.edit', ['id' => $id])->with('status', 'Operator successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);

        $user->delete();
        
        return redirect()->route('users.index')->with('status', 'Operator successfully delete');
    }

    public function operatorSearch(Request $request)
    {
        $keyword = $request->get('q');

        $users = \App\User::where("name", "LIKE", "%$keyword%")->get();
        
        return $users;
    }
}
