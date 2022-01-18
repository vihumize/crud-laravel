<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados'] = Empleado::paginate(2);
        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
        return view('index.blade');
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
$campos=[
    'Nombre'=>'required|string|max:100',
    'Apellido_paterno'=>'required|string|max:100',
    'Apellido_materno'=>'required|string|max:100',
    'Correo_electronico'=>'required|email',
    'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
];

$mensaje=[
    'required'=>'El :attribute es requerido',
    'Foto.required'=>'La foto es requerida'
];

$this->validate($request, $campos, $mensaje);
        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        if($request->hasfile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        } 

        Empleado::insert($datosEmpleado);
       // return response()->json($datosEmpleado);
       return redirect('empleado')->with('mensaje','Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido_paterno'=>'required|string|max:100',
            'Apellido_materno'=>'required|string|max:100',
            'Correo_electronico'=>'required|email',
           
        ];
        
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        
        if($request->hasfile('Foto')){
            $campos=[ 'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];
           
        }

        $this->validate($request, $campos, $mensaje);
        
        
        
        //
        $datosEmpleado = request()->except(['_token','_method']);

        if($request->hasfile('Foto')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        } 

        Empleado::where('id','=',$id)->update($datosEmpleado);        
        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));

        return redirect('empleado')->with('mensaje','Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        if(storage::delete('public/'.$empleado->Foto)){ //borrar datos y foto
    
            Empleado::destroy($id);
 
        }

        //Empleado::destroy($id); *borrar solo los datos no la foto
        return redirect('empleado')->with('mensaje','Borrado con exito');
    }
}
