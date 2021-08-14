<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Cliente::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create([
            'nombreComercial' => $request->post('nombreComercial'),
            'razonSocial' => $request->post('razonSocial'),
            'rubro' => $request->post('rubro'),
            'observacion' => $request->post('observacion'),
        ]);

        return response()->json([
            'messagge' => 'Created'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->update([
            'nombreComercial' => $request->post('nombreComercial'),
            'razonSocial' => $request->post('razonSocial'),
            'rubro' => $request->post('rubro'),
            'observacion' => $request->post('observacion'),
        ]);
        return response()->json([
            'messagge' => 'Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        if ($cliente->delete()) {
            return response()->json([
                'data' => [
                    'message' => 'Post Deleted'
                ]
            ], 204);
        }else{
            return response()->json([
                'message'=>'Error Delete'
            ],500);
        } 
    }
}
