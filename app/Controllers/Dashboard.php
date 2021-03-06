<?php

namespace App\Controllers;

use App\Models\UsuariosGralModel;
use App\Models\InstitucionesModel;
use App\Models\VisitasModel;
use App\Models\VisitantesModel;
use App\Models\EmpleadosVisitadosModel;
use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    protected $usuario;
	protected $titulo;
   
	public function __construct() {

		$this->session = session();      
        $this->usuario = new UsuariosGralModel();	
		$this->privilegios_CRUD = $this->usuario->privs_opcion_menu_rol('/Empleados', $this->session->rol);
		$this->tablaEmpleados = new EmpleadosVisitadosModel;
		$this->tablaVisitas = new VisitasModel;
		$this->tablaVisitantes = new VisitantesModel;

	}

	public function index(){

	$visitas_activas = $this->tablaVisitas->selectCount('id_visita')->where('status', 1)->first();
	$visitas_concluidas = $this->tablaVisitas->selectCount('id_visita')->where('status', 3)->first();
	$visitantes = $this->tablaVisitantes->selectCount('id_visitante')->where('status', 1)->first();
	$personal_visitado = $this->tablaEmpleados->selectCount('codigo')->first();
	
	$data = ['titulo' => 'Dashboard', 'privs' => $this->privilegios_CRUD, 'visitas_concluidas' => $visitas_concluidas,'visitas_activas' => $visitas_activas, 
	'visitantes' => $visitantes, 'personal_visitado' => $personal_visitado];
		
		echo  view ('templates/header');
		echo  view ('templates/sidebar');
		echo  view ('templates/dashboard', $data);
		echo  view ('templates/footer');
	}


	public function getVisitasxMes() {

	$datos = $this->tablaVisitas->query("CALL getVisitasxMes")->getResult();
	echo json_encode($datos);
	}	



}
