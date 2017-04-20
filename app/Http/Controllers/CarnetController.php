<?php

namespace Cdig\Http\Controllers;

use Illuminate\Http\Request;
use Cdig\Http\Requests;
use Cdig\Http\Controllers\Controller;
use Cdig\User;
use Cdig\Programa;

class CarnetController extends Controller
{
    public function getIndex(){
    	$programas = Programa::all();
    	$usuarios = User::where('admin',false)->with('programa')->get();
    	return view('admin',compact('programas','usuarios'));
    }

    public function postUsuario(Request $request)
    {
    	$rules = [
    		'nombre' => 'required|regex:/^([A-Za-z ÑñÁáÉéÍíÓóÚú])+$/i|min:5|max:80',
    		'identificacion' => 'required|regex:/^([0-9])+$/i|unique:users|min:5|max:10',
    		'email' => 'required|email|unique:users|min:5',
    		'programa_id' => 'required'
    	];

    	$this->validate($request, $rules);

    	$user = new User();
    	$user->nombre = $request->get('nombre');
    	$user->identificacion = $request->get('identificacion');
    	$user->email = $request->get('email');
    	$user->programa_id = $request->get('programa_id');
    	$user->save();
    	$request->session()->flash('exito','exito');
    	return redirect()->action('CarnetController@getIndex');
    }

    public function postUsuariosMasivos(Request $request)
    {
    	if ($request->hasFile('lista')) {
            $ext    = $request->file('lista')->getClientOriginalExtension();
            if ($ext == 'xlsx' || $ext == 'xls'){
                $programa_id = $request->get('programa_id');
                $lista = $request->file('lista');
                $programa = Programa::find($programa_id);

                \Excel::load($lista, function($data) use ($programa){
                    $NoRegistrados = [];
                    $estudiantes = $data->get();
                    foreach ($estudiantes as $est) {
                        $nombre         = $est->nombre;
                        $identificacion = $est->identificacion;
                        $email 			= $est->email;
                        $programa_id    = $programa->id;

                        $rules = [
                            'nombre'            => 'required|regex:/^([A-Za-z ÑñÁáÉéÍíÓóÚú])+$/i|min:7|max:60',
                            'identificacion'    => 'required|regex:/^([0-9])+$/i|max:15',
                            'email' 			=> 'required|email|unique:users|min:5'
                        ];

                        $datos = ["nombre" => $est->nombre, "identificacion"=>$est->identificacion, "email"=>$est->email];
                        $v = \Validator::make($datos, $rules);

                        //dd($array);

                        if ($v->fails()) {
                            array_push($NoRegistrados,['nombre' => $est->nombre, 'identificacion' => $est->identificacion, 'email'=>$est->email]);
                        }else{
                            $newEstudiante = new User();
                            if ($newEstudiante->isRegistered($identificacion, $email) == 0) {
                                User::create([
                                    'nombre'        => $nombre,
                                    'identificacion'=> $identificacion,
                                    'email'			=> $email,
                                    'programa_id'   => $programa_id,
                                    'password'      => bcrypt('0'),
                                    'admin'        	=> false
                                ]);
                            }else{
                                //Registro fallido
                                array_push($NoRegistrados,['nombre' => $est->nombre, 'identificacion' => $est->identificacion,'email'=>$est->email]);
                            }
                        }
                    }//End foreach

                    if (sizeof($NoRegistrados) > 0) {
                        \Excel::create('Registros-fallidos',function($excel) use ($NoRegistrados){
                            $excel->sheet('Registros Fallidos',function($sheet) use ($NoRegistrados){
                                for ($i = 0; $i < sizeof($NoRegistrados); $i++){
                                    $data = [];
                                    array_push($data,[$NoRegistrados[$i]['nombre'],$NoRegistrados[$i]['identificacion'],$NoRegistrados[$i]['email']]);
                                    $sheet->fromArray($data,'null','A1',false,false);
                                }
                            });
                        })->download('xlsx');
                    }
                })->get();

                $request->session()->flash('exito','exito');
                return redirect()->action("CarnetController@getIndex");
            }else{
                //No formato
                $request->session()->flash('no-formato','no-formato');
                return redirect()->back();
            }
        }else{
            //No file
            $request->session()->flash('no-file','no-file');
            return redirect()->back();
        }
    }

    public function getUsuarioEdicion($id)
    {
    	$usuario = User::find($id);
    	$datos = ['usuario'=>$usuario];
    	return $datos;
    }

    public function postUsuarioEdicion(Request $request)
    {
    	$user = User::find($request->get('user_id'));
    	$rules = [
    		'nombre' => 'required|regex:/^([A-Za-z ÑñÁáÉéÍíÓóÚú])+$/i|min:5|max:80',
    		'identificacion' => 'required|regex:/^([0-9])+$/i|unique:users,identificacion,'.$user->id.'|min:5|max:10',
    		'email' => 'required|email|unique:users,email,'.$user->id.'|min:5',
    		'programa_id' => 'required'
    	];

    	$this->validate($request, $rules);

    	$user->nombre = $request->get('nombre');
    	$user->identificacion = $request->get('identificacion');
    	$user->email = $request->get('email');
    	$user->programa_id = $request->get('programa_id');
    	$user->save();
    	$request->session()->flash('exito','exito');
    	return redirect()->action('CarnetController@getIndex');
    }

    public function postFoto(Request $request)
    {
    	if ($request->hasFile('foto')) {
            $mime   = $request->file('foto')->getMimeType();
            $ext    = $request->file('foto')->getClientOriginalExtension();
            if ($mime == 'image/jpeg' || $mime == 'image/png'){
                $id = $request->get('user_id_foto');
                $user = User::find($id);

                $file = $request->file('foto');
                $foto = "foto-user".$id.".".$ext;
                //\Storage::delete($candidato->foto);
                \Storage::disk('local')->put($foto, \File::get($file));

                $user->foto = $foto;
                $user->save();

                $request->session()->flash('exito','exito');
                return redirect()->action("CarnetController@getIndex");
            }else{
                //No formato
                $request->session()->flash('no-formato','no-formato');
                return redirect()->back();
            }
        }else{
           $request->session()->flash('no-file','no-file');
            return redirect()->back();
        }
    }

    public function getCarnet($id)
    {
    	$user = User::find($id);

    	if ($user) {
	    	$view =  view('carnet-prev',compact('user'));
	    	//return $view;
	    	$pdf = \App::make('dompdf.wrapper');
	        $pdf->loadHTML($view)->setPaper('letter','landscape')->setWarnings(false);
	        return $pdf->stream($user->nombre.".pdf");
    	}else{
    		return back();
    	}
    }
}
