<?php

namespace App\Controllers;

use App\Models\UsuariosGralModel;
use App\Models\InstitucionesModel;
use App\Models\VisitasModel;
use App\Models\VisitantesModel;
use App\Models\EmpleadosVisitadosModel;
use CodeIgniter\Controller;

class Reportes extends BaseController
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

	$data = ['titulo' => 'Reportes'];
		
		echo  view ('templates/header');
		echo  view ('templates/sidebar');
		echo  view ('reportes/reporte_dinamico', $data);
		echo  view ('templates/footer');
	}


	public function getVisitasxMes() {

	$datos = $this->tablaVisitas->query("CALL getVisitasxMes")->getResult();
	echo json_encode($datos);
	}	



}
