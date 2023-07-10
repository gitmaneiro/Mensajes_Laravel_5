<?php

namespace App\Http\Controllers;

use App\Configuracion;
use App\Mensajes;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class MensajesController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes = Mensajes::orderBy('updated_at', 'DESC')->get();
        return view('mensajes.index', compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mensajes.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Caracas');
        if($request->ajax()) {
            $campos = [
                'mensaje'   => $request['mensaje'],
                'status'    => $request['status']
            ];
            Mensajes::create($campos);
            return response()->json([
                'nuevoContenido' => $request->all()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mensajes  $mensajes
     * @return \Illuminate\Http\Response
     */
    public function show(Mensajes $mensajes, $id)
    {
        $this->mensaje = Mensajes::find($id);
        return view('mensajes.show', ['mensaje' => $this->mensaje]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mensajes  $mensajes
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensajes $mensajes, $id)
    {
        if(Auth::check()) {
            $this->mensaje = Mensajes::find($id);
            return view('mensajes.edit', ['mensaje' => $this->mensaje]);
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
     * @param  \App\Mensajes  $mensajes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensajes $mensajes, $id)
    {
        if(Auth::check()) {
            if($request->ajax()) {
                $this->mensaje = Mensajes::find($id);
                 $campos = [
                    'mensaje'   => $request['mensaje'],
                    'status'    => $request['status']
                ];
                $this->mensaje->fill($campos);
                $this->mensaje->save();
                return response()->json([
                    'nuevoContenido' => $campos           
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
     * @param  \App\Mensajes  $mensajes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensajes $mensajes, $id)
    {
        if(Auth::check()) {
            $this->mensaje = Mensajes::find($id);
            if (is_null ($this->mensaje))
                \App::abort(404);
            $this->mensaje->delete();
            if (\Request::ajax()) {
                return Response::json(array (
                    'success' => true,
                    'msg'     => 'Mensaje "' . $this->mensaje->status .'" eliminado satisfactoriamente',
                    'id'      => $this->mensaje->id
                ));
            }
            else {
                $mensaje = 'Mensaje "'.$this->mensaje->status.'" eliminado satisfactoriamente';
                Session::flash('message', $mensaje);
                return Redirect::route('mensajes.index');
            }
        }
        else {
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }
}
