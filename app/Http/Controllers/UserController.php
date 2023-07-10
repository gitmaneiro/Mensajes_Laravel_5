<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Redirect;
use Response;
use Session;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $users = User::All();
            return view('usuarios.index', compact('users'));    
        }
        else
        {
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        if(Auth::check())
        {
            if($request->ajax()) {
                if(!empty($request->file('file'))) {
                    $file = $request->file('file');
                    $nombre = str_replace(':', '_', Carbon::now()->toDateTimeString().$file->getClientOriginalName());
                    $nombre = str_replace(' ', '_', $nombre);
                    \Storage::disk('users')->put($nombre,  \File::get($file));
                }
                else {
                    $nombre = '';
                }
                User::create([
                    'username'  => $request['username'], 
                    'name'      => $request['name'],
                    'cedula'    => $request['cedula'],
                    'email'     => $request['email'], 
                    'password'  => bcrypt($request['password']), 
                    'details'   => $request['details'],
                    'path'      => $nombre
                ]);
                
                return response()->json([
                    'nuevoContenido' => $request->all()
                ]);
            }    
        }
        else {
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$this->user = User::find($id);
        if(Auth::check() || Auth::user()->id == $id) {
            return view('usuarios.show', ['user' => $this->user]);
        }
        else {
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$this->user = User::find($id);
        if(Auth::check() || Auth::user()->id == $id) {
            return view('usuarios.edit', ['user' => $this->user]);    
        }
        else {
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
    	$this->user = User::find($id);
        if(Auth::check() || Auth::user()->id == $id) {
            if($request->ajax()) {
                if(!empty($request->file('file')) and $request->file('file') != '') {
                    \File::delete('uploads/users/'.$this->user->path);
                    $file = $request->file('file');
                    $nombre = str_replace(':', '_', Carbon::now()->toDateTimeString().$file->getClientOriginalName());
                    $nombre = str_replace(' ', '_', $nombre);
                    \Storage::disk('users')->put($nombre,  \File::get($file));
                }   

                else {
                    $nombre = $this->user->path;
                }

                $this->user->fill([
                    'username'  => $request['username'], 
                    'name'      => $request['name'],
                    'cedula'    => $request['cedula'],
                    'email'     => $request['email'], 
                    'details'   => $request['details'],
                    'path'      => $nombre
                    ]);
                $this->user->save();

                return Response::json([
                    'nuevoContenido' => $this->user
                ]);
            }
        }
        else {
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$this->user = User::find($id);
        if(Auth::check()) {
            if (is_null ($this->user)) {
                \App::abort(404);
            }

            $this->user->delete();

            if (\Request::ajax()) {
                \File::delete('uploads/users/'.$this->user->path);
                return Response::json(array (
                    'success' => true,
                    'msg'     => 'Usuario "' . $this->user->username . '" eliminado satisfactoriamente',
                    'id'      => $this->user->id,
                ));
            }
            else {
                Session::flash('message', 'Usuario "' . $this->user->username . '" eliminado satisfactoriamente');
                return Redirect::route('usuarios.index');
            }   
        }
        else {
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }
}
