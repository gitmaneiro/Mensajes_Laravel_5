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

class BackController extends Controller
{
	public function __construct(){
        //$this->middleware('auth');
    }
    
    public function index()
    {
        $configuracion = Configuracion::find(1);
    	return view ('layouts.base', ['configuracion' => $configuracion]);
    }

    public function httpush(Request $request){
    	if($request->ajax()){
    		set_time_limit(0);
			$fecha_ac = isset($request['timestamp']) ? $request['timestamp']:0;
			$fecha_bd = date("Y-m-d H:i:s");

			while($fecha_bd <= $fecha_ac) {	
				$con = Mensajes::select('updated_at')->orderBy('updated_at', 'DESC')->limit(1)->get();
				usleep(100000);
				clearstatcache();
				foreach($con as $ro) {
					$fecha_bd = strtotime($ro['updated_at']);
				}
			}

			$datos_query = Mensajes::orderBy('updated_at', 'DESC')->limit(1)->get();
			$ar = [];

			foreach($datos_query as $row) {
				$ar["timestamp"] 	= strtotime($row['updated_at']);	
				$ar["mensaje"] 		= $row['mensaje'];	
				$ar["id"] 			= $row['id'];	
				$ar["status"] 		= $row['status'];	
			}

    		return response()->json([
                'json' => $ar
            ]);
    	}
    }

    public function mensajes(Request $request) {
        $configuracion = Configuracion::find(1);
    	date_default_timezone_set('America/Caracas');
    	if($request->ajax()){
    		$desde = Carbon::now()->subSecond()->toDateTimeString();
    		$hasta = Carbon::now()->addSecond()->toDateTimeString();
    		$q = Mensajes::whereBetween('updated_at', [$desde, $hasta])->get();
            $consulta = Mensajes::orderBy('updated_at', "DESC")->limit($configuracion->cantidadMensajes)->get();
            $mensajesPantalla = "";
            foreach($consulta as $data) {
                $mensajesPantalla .= '<div class="col-xs-12 col-md-12">';
                $mensajesPantalla .= '<div class="card-box tilebox-one">';
                $mensajesPantalla .= '<h4 class="text-dark-blue text-uppercase m-b-20">'.$data["status"].'</h4>';
                $mensajesPantalla .= '<h5 class="m-b-20" data-plugin="counterup">'.$data["mensaje"].'</h5>';
                $mensajesPantalla .= '</div>';
                $mensajesPantalla .= '</div>';
            }
    		return response()->json([
                'respuesta' => $q, 
                'mensajesPantalla' => $mensajesPantalla
            ]);
    	}
    }

    public function editConfiguracion(Configuracion $configuracion)
    {
        $this->configuracion = Configuracion::find(1);
        return view('configuracion.edit', ['configuracion' => $this->configuracion]);
    }

    public function updateConfiguracion(Request $request, Configuracion $configuracion)
    {
        if($request->ajax()) {
            $this->configuracion = Configuracion::find(1);
             $campos = [
                'cantidadMensajes' => $request['cantidadMensajes'],
                'velocidad'        => $request['velocidad']
            ];
            $this->configuracion->fill($campos);
            $this->configuracion->save();
            return response()->json([
                'nuevoContenido' => $campos           
            ]);
        }
    }
}
