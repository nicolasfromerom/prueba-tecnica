<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Cliente;
use Illuminate\Http\Request;

class TablaInfoController extends Controller
{
    public function index(){
        $data = Campaign::select('clientes.nombreComercial as cliente',
                'campaigns.titulo as campaign',
                'detalle_plan_medios.tipoNota',
                'detalle_plan_medios.statusPublicado',
                'plan_medios.nombre as plan_medio',
                'personas.nombres as nombre_periodista',
                'personas.apellidos as apellido_periodista',
                'medios.nombre as medio',
                'programas.nombre as nombre_programas',
                'medio_plataformas.valor as plataforma_valor',
                'plataformas.descripcion as plataforma_descripcion',
                'plataforma_clasificacions.descripcion as plataforma_clasificacions')
                ->join('clientes','campaigns.cliente_id','=','clientes.id')
                ->join('plan_medios','plan_medios.campaign_id','=','campaigns.id')
                ->join('detalle_plan_medios','plan_medios.id','=', 'detalle_plan_medios.idPlanMedio')
                ->join('programa_contactos','programa_contactos.id','=','detalle_plan_medios.idProgramaContacto')
                ->join('programas','programa_contactos.programa_id','=','programas.id')
                ->join('personas','programa_contactos.idContacto','personas.id')
                ->join('medio_plataformas','detalle_plan_medios.idsMedioPlataforma','=', 'medio_plataformas.id')
                ->join('medios','medio_plataformas.medio_id','=','medios.id')
                ->join('plataforma_clasificacions','plataforma_clasificacions.id','=','medio_plataformas.idPlataformaClasificacion')
                ->join('plataformas','plataformas.id','=','plataforma_clasificacions.plataforma_id')
                ->get();
        return response()->json($data);
    }
}
