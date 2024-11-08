<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamo;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Apoderado;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;



use Livewire\Component;
use PhpParser\Node\Stmt\Return_;

class HomeController extends Controller
{
    function index(){

        $token = Config::get('app.api_token');
        return view('form.index', compact('token'));

    }

    public function store(Request $request)
    {



        // Crear un nuevo reclamo
        $reclamo = new Reclamo();

        // Comprobar el tipo de persona y guardar los datos correspondientes
        if ($request->tipo_persona == 'natural') {
            $cliente = new Cliente();
            $cliente->nombres_apellidos = $request->nombres_apellidos;
            $cliente->dni = $request->dni;
            $cliente->email = $request->email;
            $cliente->fono_persona = $request->fono_persona;
            $cliente->tipo_persona = $request->tipo_persona;
            $cliente->menor_edad = $request->menor_edad ?? 'no';
            $cliente->save();

            $reclamo->cliente_id = $cliente->id;
            $reclamo->empresa_id = null;
        } elseif ($request->tipo_persona == 'juridica') {
            $empresa = new Empresa();
            $empresa->razon_social = $request->razon_social;
            $empresa->ruc = $request->ruc;
            $empresa->direccion = $request->direccion;
            $empresa->fono_empresa = $request->fono_empresa;
            $empresa->tipo_persona = $request->tipo_persona;
            $empresa->save();

            $reclamo->cliente_id = null;
            $reclamo->empresa_id = $empresa->id;
        }

        // Guardar los datos del reclamo
        $reclamo->tipo_reclamo = $request->tipo_reclamo;
        $reclamo->bien_contratado = $request->bien_contratado;
        $reclamo->texto_reclamo = $request->texto_reclamo;
        $reclamo->texto_queja = $request->texto_queja;
        $reclamo->detalle_reclamacion = $request->detalle_reclamacion;
        $reclamo->leido_aceptado = $request->has('leido_aceptado') ? 1 : 0;
        $reclamo->save();

        // Si el reclamante es menor de edad, guardar los datos del apoderado
        if ($request->menor_edad == 'si') {
            $apoderado = new Apoderado();
            $apoderado->id_cliente = $cliente->id; // Relacionado con el cliente menor de edad
            $apoderado->nombres_apellidos_apoderado = $request->nombres_apellidos_apoderado;
            $apoderado->dni_apoderado = $request->dni_apoderado;
            $apoderado->direccion_apoderado = $request->direccion_apoderado;
            $apoderado->save();
        }

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Reclamo registrado correctamente.');
    }

    public function admin (){
        $datosClientes = $this->consultarDatosClientes();
        $datosEmpresas = $this->consultarDatosEmpresas();
        return view('administration.index', compact('datosClientes', 'datosEmpresas'));
    }

    public function consultarReclamosPN(){


        $datosReclamosPN = $this->consultarReclamos()->paginate(5);
        $columnasPorDefecto = [
            'dni',
            'apellidos_cliente',
            'telefono_cliente',
            'correo_cliente',
            'menor_edad',
            'apellidos_apoderado',
            'dni_apoderado',
            'direccion_apoderado',
            'tipo_reclamo',
            'bien_contratado',
            'detalle_reclamacion',
            'estado'
        ];

        return view('administration.reclamos.p_naturales', compact('datosReclamosPN', 'columnasPorDefecto'));
    }

    public function consultarQuejasPN(){

        $datosQuejasPN = $this->consultarQuejas()->paginate(5);

        return view('administration.quejas.p_naturales', compact('datosQuejasPN'));

    }

    public function consultarDatosClientesA(){
        $datosClientesA = $this->consultarClientesEstadoA()->paginate(5);

        return view('administration.reclamos.en_atencion', compact('datosClientesA'));

    }

    private function consultarDatosClientes()
    {
        return DB::select("
            SELECT
                c.dni AS dni,
                c.nombres_apellidos AS apellidos_cliente,
                c.fono_persona AS telefono_cliente,
                c.email AS correo_cliente,
                c.menor_edad,
                a.nombres_apellidos_apoderado AS apellidos_apoderado,
                a.dni_apoderado AS dni_apoderado,
                a.direccion_apoderado AS direccion_apoderado,
                r.tipo_reclamo,
                r.bien_contratado,
                CASE
                    WHEN r.tipo_reclamo = 'reclamo' THEN r.texto_reclamo
                    WHEN r.tipo_reclamo = 'queja' THEN r.texto_queja
                    ELSE NULL
                END AS reclamo_o_queja,
                r.detalle_reclamacion,
                r.estado
            FROM clientes c
            LEFT JOIN reclamos r ON c.id = r.cliente_id
            LEFT JOIN apoderados a ON c.id = a.id_cliente
            WHERE c.menor_edad = 'si'
            UNION ALL
            SELECT
                c.dni AS dni,
                c.nombres_apellidos AS apellidos_cliente,
                c.fono_persona AS telefono_cliente,
                c.email AS correo_cliente,
                c.menor_edad,
                NULL AS apellidos_apoderado,
                NULL AS dni_apoderado,
                NULL AS direccion_apoderado,
                r.tipo_reclamo,
                r.bien_contratado,
                CASE
                    WHEN r.tipo_reclamo = 'reclamo' THEN r.texto_reclamo
                    WHEN r.tipo_reclamo = 'queja' THEN r.texto_queja
                    ELSE NULL
                END AS reclamo_o_queja,
                r.detalle_reclamacion,
                r.estado
            FROM clientes c
            LEFT JOIN reclamos r ON c.id = r.cliente_id
            WHERE c.menor_edad = 'no'
        ");
    }


    private function consultarDatosEmpresas()
    {
        return DB::select("
            SELECT
                e.ruc,
                e.razon_social,
                e.fono_empresa AS telefono,
                e.direccion,
                r.tipo_reclamo,
                r.bien_contratado,
                CASE
                    WHEN r.tipo_reclamo = 'reclamo' THEN r.texto_reclamo
                    WHEN r.tipo_reclamo = 'queja' THEN r.texto_queja
                    ELSE NULL
                END AS reclamo_o_queja,
                r.detalle_reclamacion,
                r.estado
            FROM empresas e
            LEFT JOIN reclamos r ON e.id = r.empresa_id
        ");
    }

        private function consultarReclamos()
    {
        return DB::table('clientes AS c')
            ->select(
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                'r.texto_reclamo AS reclamo',
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos AS r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados AS a', 'c.id', '=', 'a.id_cliente')
            ->where(function ($query) {
                $query->where('c.menor_edad', 'si')
                      ->orWhere('c.menor_edad', 'no');
            })
            ->where('r.tipo_reclamo', 'reclamo');
    }

    private function consultarQuejas()
    {
        return DB::table('clientes AS c')
            ->select(
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                'r.texto_reclamo AS reclamo',
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos AS r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados AS a', 'c.id', '=', 'a.id_cliente')
            ->where(function ($query) {
                $query->where('c.menor_edad', 'si')
                      ->orWhere('c.menor_edad', 'no');
            })
            ->where('r.tipo_reclamo', 'queja');
    }

    private function consultarClientesEstadoA(){
        return DB::table('clientes AS c')
            ->select(
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw("CASE WHEN r.tipo_reclamo = 'reclamo' THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja"),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados as a', 'c.id', '=', 'a.id_cliente')
            ->where('r.estado', 'ATENDIDO')
            ->whereIn('r.tipo_reclamo', ['reclamo', 'queja']);

    }



    private function consultarQuejasAtendidas(){
        return DB::table('clientes AS c')
            ->select(
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                'r.texto_queja AS queja',
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados as a', 'c.id', '=', 'a.id_cliente')
            ->where('r.tipo_reclamo', 'queja')
            ->where('r.estado', 'ATENDIDO');

    }

    public function ConsultaQuejasAtendidasPN(){

        $quejasAtendidas = $this->consultarQuejasAtendidas()->paginate(5);

        return view('administration.quejas.atendidas', compact('quejasAtendidas'));
    }

    private function consultarReclamosEmpresas(){
        return DB::table('empresas AS e')
            ->select(
                'e.ruc',
                'e.razon_social',
                'e.fono_empresa AS telefono',
                'e.direccion',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw('CASE WHEN r.tipo_reclamo = "reclamo" THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja'),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'e.id', '=', 'r.empresa_id')
            ->where('r.tipo_reclamo', 'reclamo');

    }

    public function ConsultaReclamosEmpresas(){

        $reclamosEmpresas = $this->consultarReclamosEmpresas()->paginate(5);
        return view('administration.reclamos.p_juridicas', compact('reclamosEmpresas'));
    }

    private function consultarQuejasEmpresas(){
        return DB::table('empresas AS e')
            ->select(
                'e.ruc',
                'e.razon_social',
                'e.fono_empresa AS telefono',
                'e.direccion',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw('CASE WHEN r.tipo_reclamo = "reclamo" THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja'),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'e.id', '=', 'r.empresa_id')
            ->where('r.tipo_reclamo', 'queja')
            ->where('r.estado', 'POR ATENDER');    
    }

    public function ConsultaQuejasEmpresas(){

        $quejasEmpresas = $this->consultarQuejasEmpresas()->paginate(5);
        return view('administration.quejas.p_juridicas', compact('quejasEmpresas'));
    }

    private function consultarQuejasPorAtender(){
        return DB::table('clientes AS c')
            ->select(
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                'r.texto_queja AS queja',
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados as a', 'c.id', '=', 'a.id_cliente')
            ->where('r.tipo_reclamo', 'queja')
            ->where('r.estado', 'POR ATENDER');

    }

    public function ConsultaQuejasPorAtenderPN(){

        $quejasPorAtenderPN = $this->consultarQuejasPorAtender()->paginate(5);
        return view('administration.quejas.por_atender', compact('quejasPorAtenderPN'));
    }

    private function consultarQuejasEnAtencion(){
        return DB::table('clientes AS c')
            ->select(
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                'r.texto_queja AS queja',
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados as a', 'c.id', '=', 'a.id_cliente')
            ->where('r.tipo_reclamo', 'queja')
            ->where('r.estado', 'EN ATENCION');

    }

    public function ConsultaQuejasEnAtencionPN(){

        $quejasEnAtencionPN = $this->consultarQuejasEnAtencion()->paginate(5);
        return view('administration.quejas.en_atencion', compact('quejasEnAtencionPN'));
    }

    


    public function ConsultaReclamosPorAtenderPN(){

        $reclamosPorAtenderPN = $this->consultarReclamosPorAtender()->paginate(5);
        return view('administration.reclamos.por_atender', compact('reclamosPorAtenderPN'));
    }

    private function consultarReclamosPorAtender(){
        return DB::table('clientes AS c')
            ->select(
                'r.id as reclamo_id',
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw("CASE WHEN r.tipo_reclamo = 'reclamo' THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja"),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados as a', 'c.id', '=', 'a.id_cliente')
            ->whereIn('r.tipo_reclamo', ['reclamo']) // Permitir tanto reclamos como quejas
            ->where('r.estado', 'POR ATENDER');

    }

    private function consultarReclamosEnAtencion(){
        return DB::table('clientes AS c')
            ->select(
                'r.id as reclamo_id',
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw("CASE WHEN r.tipo_reclamo = 'reclamo' THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja"),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'c.id', '=', 'r.cliente_id')
            ->leftJoin('apoderados as a', 'c.id', '=', 'a.id_cliente')
            ->whereIn('r.tipo_reclamo', ['reclamo']) // Permitir tanto reclamos como quejas
            ->where('r.estado', 'EN ATENCION');
    }
        public function ConsultaReclamosEnAtencionPN(){

        $reclamosEnAtencionPN = $this->consultarReclamosEnAtencion()->paginate(5);
        return view('administration.reclamos.clientes-atendidos', compact('reclamosEnAtencionPN'));
    }

    // nuevo cod

    public function ConsultaReclamosPorAtenderPJ(){
        $reclamosPorAtenderPJ = $this->consultarReclamosPorAtenderEmpresas()->paginate(5);
        return view('administration.reclamos.por_atender_pj', compact('reclamosPorAtenderPJ'));
    }

    public function consultarReclamosPorAtenderEmpresas(){
        return DB::table('empresas AS e')
            ->select(
                'r.id as reclamo_id',
                'e.ruc',
                'e.razon_social',
                'e.fono_empresa AS telefono',
                'e.direccion',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw('CASE WHEN r.tipo_reclamo = "reclamo" THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja'),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'e.id', '=', 'r.empresa_id')
            ->whereIn('r.tipo_reclamo', ['reclamo']) 
            ->where('r.estado', 'POR ATENDER');
    }

    public function ConsultaReclamosEnAtencionPJ(){
        $reclamosEnAtencionPJ = $this->consultarReclamosEnAtencionEmpresas()->paginate(5);
        return view('administration.reclamos.en_atencion_pj', compact('reclamosEnAtencionPJ'));
    }


    public function consultarReclamosEnAtencionEmpresas(){
        return DB::table('empresas AS e')
            ->select(
                'r.id as reclamo_id',
                'e.ruc',
                'e.razon_social',
                'e.fono_empresa AS telefono',
                'e.direccion',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw('CASE WHEN r.tipo_reclamo = "reclamo" THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja'),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'e.id', '=', 'r.empresa_id')
            ->whereIn('r.tipo_reclamo', ['reclamo']) 
            ->where('r.estado', 'EN ATENCION');
    }


    // consultar reclamos atendidas empresas

    public function ConsultaReclamosAtendidosPJ(){
        $reclamosAtendidosPJ = $this->consultarReclamosAtendidasEmpresas()->paginate(5);
        return view('administration.reclamos.atendidas_pj', compact('reclamosAtendidosPJ'));
    }

    public function consultarReclamosAtendidasEmpresas(){
        return DB::table('empresas AS e')
            ->select(
                'e.ruc',
                'e.razon_social',
                'e.fono_empresa AS telefono',
                'e.direccion',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw('CASE WHEN r.tipo_reclamo = "reclamo" THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja'),
                'r.detalle_reclamacion',
                'r.estado'
            )
            ->leftJoin('reclamos as r', 'e.id', '=', 'r.empresa_id')
            ->whereIn('r.tipo_reclamo', ['reclamo']) 
            ->where('r.estado', 'ATENDIDO');
    }


}
