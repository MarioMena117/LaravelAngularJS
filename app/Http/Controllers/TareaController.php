<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $tareas = request()->user()->tareas;

        return response()->json([
            'tareas' => $tareas,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre'        => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $tarea = Tarea::create([
            'nombre'        => request('nombre'),
            'descripcion' => request('descripcion'),
            'user_id'     => Auth::user()->id
        ]);

        return response()->json([
            'tarea'    => $tarea,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
         $this->validate($request, [
            'nombre'        => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $tarea->nombre = request('nombre');
        $tarea->descripcion = request('descripcion');
        $tarea->save();

        return response()->json([
            'message' => 'Tarea actualizada exitosamente!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        
         $tarea->delete();

        return response()->json([
            'message' => 'Tarea eliminada exitosamente!'
        ], 200);
    }
}
