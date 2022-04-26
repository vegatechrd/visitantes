<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\UsuariosGralModel;
    use App\Models\VisitasModel;
    use App\Models\InstitucionesModel;
    use App\Models\VisitantesModel;
    use App\Models\MotivosModel;
    use App\Models\EmpleadosVisitadosModel;


    class Visitas extends BaseController{


    

        public function __construct(){
            
            $this->session = session();
            $this->usuario = new UsuariosGralModel();
            $this->tabla = new VisitasModel();
            $this->tablaVisitantes = new VisitantesModel;
            $this->tablaInstituciones = new InstitucionesModel; 
            $this->privilegios_CRUD = $this->usuario->privs_opcion_menu_rol('/Visitas', $this->session->rol);
            $this->tablaMotivos = new MotivosModel();
            $this->instituciones = $this->tablaInstituciones->where('status_institucion', 1)->findAll();
            $this->motivos = $this->tablaMotivos->where('status', 1)->findAll();
            $this->tablaEmpleadosVisitados = new EmpleadosVisitadosModel;
            $this->visitantes = $this->tablaVisitantes->where('status', 1)->findAll(); 
            $this->departamentos_visitados = $this->tablaEmpleadosVisitados->getDepartamentos();
          
        }

           
        public function index(){
           
        if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {

        $datos = $this->tabla->GetAllVisitas();

                
                $data = ['titulo' => "Gestión De Visitas",
                         'datos' => $datos,    
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitas/visitas_presencia', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }

     

        public function create(){
            
            if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {

                           

                
                $data = ['titulo' => "Registrar Visitas", 
                         'instituciones' => $this->instituciones, 
                         'motivos' => $this->motivos,  
                         'visitantes' => $this->visitantes,      
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitas/new', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }

      public function edit($id){
            
            if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['U'] == "S") {
                
     $datos = $this->tabla->GetAllVisitas($id);

                $data = ['titulo' => "Editar Visitas", 
                         'visitantes' => $this->visitantes, 
                         'instituciones' => $this->instituciones, 
                         'motivos' => $this->motivos, 
                         'datos' => $datos,   
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitas/edit', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }

      public function view($id){
            
            if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {
                
     $datos = $this->tabla->GetAllVisitas($id);

                $data = ['titulo' => "Ver Visitas", 
                         'datos' => $datos,   
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitas/view', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }

          public function view_history($id){
            
            if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {
                
     $datos = $this->tabla->GetAllHistory($id);

                $data = ['titulo' => "Ver Visitas", 
                         'datos' => $datos,   
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitas/view_history', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }          


public function insert() {

if ($this->privilegios_CRUD['C'] == "S") {

// Variables de los campos recibidos desde la vista

// Datos del Visitante

$id_visitante = $this->request->getPost('id_visitante');

// Datos de la persona visitada

$codigo_empleado = $this->request->getPost('empleado_codigo');
$nombre_empleado = $this->request->getPost('nombre_empleado');
$departamento_empleado = $this->request->getPost('departamento');
$email_empleado = $this->request->getPost('email');
$extension_empleado = $this->request->getPost('extension');     
$puesto_empleado = $this->request->getPost('puesto');

// Datos Generales de la Visita

$varFecha = $this->request->getPost('fecha');
$date = str_replace('/', '-', $varFecha);
$dateFecha = date('Y-m-d', strtotime($date));
$varHora = $this->request->getPost('hora');
$dateHora = date('H:i:s', strtotime($varHora));
$no_gafete = $this->request->getPost('no_gafete');
$motivo_id = $this->request->getPost('motivo_visita');
$institucion_id = $this->request->getPost('institucion');
$total_visitantes = $this->request->getPost('total_visitantes');
$equipos = $this->request->getPost('equipos');

$verificar_empleado = $this->tablaEmpleadosVisitados->VerificarEmpleadoVisitado($codigo_empleado);

            if (!$verificar_empleado) {
                       $datos_visitado = $this->tablaEmpleadosVisitados->save(['codigo'=> $codigo_empleado,
                                                       'nombre'=> $nombre_empleado,
                                                       'departamento'=> $departamento_empleado,
                                                       'email'=> $email_empleado,
                                                       'extension'=> $extension_empleado,     
                                                       'puesto'=> $puesto_empleado,                                           
                                                       'status'=> 1]);
                    } // if !verificarEmpleado 

$requestData = $this->tabla->save(['visitante_id'=> $id_visitante,
                                                       'no_gafete'=> $no_gafete == "" ? NULL : $no_gafete,
                                                       'motivo_id'=> $motivo_id,
                                                       'institucion_id'=> $institucion_id == "" ? NULL : $institucion_id,     
                                                       'empleado_id'=> $codigo_empleado,    
                                                       'fecha'=> $dateFecha,
                                                       'hora_entrada'=> $dateHora,
                                                       'total_visitantes'=> $total_visitantes == "" ? NULL : $total_visitantes,
                                                       'equipos'=> $equipos == "" ? NULL : $equipos,
                                                       'usuario_id' => $this->session->idUsuario,
                                                       'status'=> 1]);
    
if ($requestData > 0) {

     $id_visita = $this->tabla->insertID();

    if(!empty($this->request->getPost('foto'))) {

    $nombre_carpeta = "fotos/".$id_visitante."/";    

    if(!is_dir($nombre_carpeta)){
    @mkdir($nombre_carpeta, 0777, true);
    @chmod($nombre_carpeta, 0777);    
    }
    

                     $img = $this->request->getPost('foto'); 
                     $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
                     $ruta_imagen = $nombre_carpeta.$id_visita.'.jpg';
                     file_put_contents($ruta_imagen,$data);
                     @chmod($ruta_imagen, 0777);
                     $this->tabla->update($id_visita, ['foto' => $ruta_imagen]);      

    } //if empty($foto)


$arrResponse = array("status" => true, "id_visita" => $id_visita, "msg" => 'Datos guardados correctamente!');    

} // End if RequestData


} // End Privilegios_CRUD

else {
 $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción'); 

}

echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
die();

} // End function Insert


public function update_salida() {

if ($this->privilegios_CRUD['U'] == "S") {

$varHora = $this->request->getPost('hora_salida');
$dateHoraSalida = date('H:i:s', strtotime($varHora));

$id_visita = $this->request->getPost('id_visita');

$requestData = $this->tabla->update($id_visita,
                                   ['hora_salida' => $dateHoraSalida,
                                    'status' => 3]);

}     
else {

$arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción'); 


 }

if ($requestData > 0) {
                                
                                                           
$arrResponse = array("status" => true, "msg" => 'Sus Datos fueron guardados correctamente!');
}
                  
echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
die();

} 

public function eliminarFotoUpdate() {

$ruta = $this->request->getPost('ruta_foto');
$id_visita = $this->request->getPost('id_visita');

if (file_exists($ruta)) {
    unlink($ruta);
$this->tabla->update($id_visita,['foto'=> NULL]);
$arrResponse = array("status" => true, "msg" => 'La foto fue eliminada correctamente!');
}  else {

$arrResponse = array("status" => false, "msg" => 'Hubo un error al eliminar la foto.');   
       }

echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
die();       
}       


public function update() {

if ($this->privilegios_CRUD['U'] == "S") {

    
// Variables de los campos recibidos desde la vista

// Datos del Visitante

$id_visitante = $this->request->getPost('id_visitante');

// Datos de la persona visitada

$codigo_empleado = $this->request->getPost('empleado_codigo');
$nombre_empleado = $this->request->getPost('nombre_empleado');
$departamento_empleado = $this->request->getPost('departamento');
$email_empleado = $this->request->getPost('email');
$extension_empleado = $this->request->getPost('extension');     
$puesto_empleado = $this->request->getPost('puesto');

// Datos Generales de la Visita

$id_visita = $this->request->getPost('id_visita');
$varFecha = $this->request->getPost('fecha');
$date = str_replace('/', '-', $varFecha);
$dateFecha = date('Y-m-d', strtotime($date));
$varHora = $this->request->getPost('hora');
$dateHora = date('H:i:s', strtotime($varHora));
$no_gafete = $this->request->getPost('no_gafete');
$motivo_id = $this->request->getPost('motivo_visita');
$institucion_id = $this->request->getPost('institucion');
$total_visitantes = $this->request->getPost('total_visitantes');
$equipos = $this->request->getPost('equipos');

$verificar_empleado = $this->tablaEmpleadosVisitados->VerificarEmpleadoVisitado($codigo_empleado);

            if (!$verificar_empleado) {
                       $datos_visitado = $this->tablaEmpleadosVisitados->save(['codigo'=> $codigo_empleado,
                                                       'nombre'=> $nombre_empleado,
                                                       'departamento'=> $departamento_empleado,
                                                       'email'=> $email_empleado,
                                                       'extension'=> $extension_empleado,     
                                                       'puesto'=> $puesto_empleado]);
                    } // if !verificarEmpleado 

$requestData = $this->tabla->update($id_visita,['visitante_id'=> $id_visitante,
                                                       'no_gafete'=> $no_gafete == "" ? NULL : $no_gafete,
                                                       'motivo_id'=> $motivo_id,
                                                       'institucion_id'=> $institucion_id == "" ? NULL : $institucion_id,     
                                                       'empleado_id'=> $codigo_empleado,    
                                                       'fecha'=> $dateFecha,
                                                       'hora_entrada'=> $dateHora,
                                                       'total_visitantes'=> $total_visitantes == "" ? NULL : $total_visitantes,
                                                       'equipos'=> $equipos == "" ? NULL : $equipos,
                                                       'usuario_id' => $this->session->idUsuario,
                                                       'status'=> 1]);
    
if ($requestData > 0) {

    if(!empty($this->request->getPost('foto'))) {

    $nombre_carpeta = "fotos/".$id_visitante."/";    

    if(!is_dir($nombre_carpeta)){
    @mkdir($nombre_carpeta, 0777, true);
    @chmod($nombre_carpeta, 0777);    
    }
    

                     $img = $this->request->getPost('foto'); 
                     $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
                     $ruta_imagen = $nombre_carpeta.$id_visita.'.jpg';
                     file_put_contents($ruta_imagen,$data);
                     @chmod($ruta_imagen, 0777);
                     $this->tabla->update($id_visita, ['foto' => $ruta_imagen]);      

    } //if empty($foto)



$arrResponse = array("status" => true, "id_visita" => $id_visita, "msg" => 'Datos actualizados correctamente!');    

} // End if RequestData


} // End Privilegios_CRUD

else {
 $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción'); 

}

echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
die();

  } //End Function   

  public function delete(){

                if ($this->privilegios_CRUD['D'] == "S") {

         $id = strClean(intval($this->request->getPost('id')));             
                                        
                         $requestDelete = $this->tabla->update($id,
                            ['status'=>intval(0)]);
                            
                            $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la visita.');
                        }else{

                    $arrResponse = array('status' => false, 'msg' => '¡Atención! no tienes permisos para realizar esta opción');
                    return redirect()->to(base_url().'/Dashboard');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         
            die();
        }




   public function historico(){

     if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {

        $datos = $this->tabla->GetAllHistory();

                
                $data = ['titulo' => "Histórico De Visitas",
                         'datos' => $datos,    
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitas/visitas_historico', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }

        }


   public function printGafete($id) {


  $datos = $this->tabla->GetAllVisitas($id);
  
  //$pdf = new \FPDF('P', 'mm', 'letter');
  $pdf = new \FPDF('P','mm',array(55,105));
  $pdf->AddPage();
  $pdf->SetMargins(3,3,3);
  $pdf->SetAutoPageBreak(false,0);
  $pdf->SetFont('Arial','B',20);
  $pdf->SetXY(0,5);
  $pdf->Cell(0,4, utf8_decode('INESPRE'), 0, 1, 'C');
  if ($datos['foto'] != '') { $ruta_foto = base_url().'/'.$datos['foto'];} else { $ruta_foto = base_url().'/dist/img/silueta.jpg';}
  $pdf->Image($ruta_foto,10,13,35,30,'JPG');
  $pdf->SetXY(0,45);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(55,5,utf8_decode($datos['nombres']), 0, 1, 'C');
  $pdf->SetXY(0,50);
  $pdf->Cell(55,5,utf8_decode($datos['apellidos']), 0, 1, 'C');
  $pdf->SetXY(0,55);  
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(55,5,utf8_decode($datos['identidad']), 0, 1, 'C');
  $pdf->SetXY(1,65);  
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(55,5,utf8_decode('Visita A:'), 0, 1, 'L');
  $pdf->SetXY(1,70);
  $pdf->SetFont('Arial','',8);
  $pdf->Multicell(55,5,utf8_decode($datos['empleado']), 0, 'L', 0);
  $pdf->SetXY(1,80);  
  $pdf->Multicell(55,5,utf8_decode($datos['departamento']), 0, 'L', 0);
  $pdf->SetXY(1,92);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(55,5, date('d-m-Y',strtotime($datos['fecha'])).' '.date("h:i:s A", strtotime($datos['hora_entrada'])), 0, 1,'C');

  $pdf->SetXY(0,98);
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(55,8,utf8_decode('VISITANTE'), 1, 1, 'C');
  $this->response->setHeader('Content-Type', 'application/pdf');
  $pdf->Output('Reporte.pdf', 'I'); 

   } 

   public function reportes(){

        $instituciones = $this->tablaInstituciones->findAll();
        $motivos = $this->tablaMotivos->findAll();
        $visitantes = $this->tablaVisitantes->findAll();

    
        $this->tabla->select('vt.nombres, vt.apellidos, v.no_gafete, ev.nombre as empleado, date_format(v.fecha, "%d-%m-%Y") as fecha, 
            date_format(v.hora_entrada,"%h:%i %p") as hora_entrada, v.status, v.equipos, v.total_visitantes, vt.identidad, vt.tipo_identidad, 
            ev.departamento, ev.extension, ev.puesto, v.foto, i.nombre_institucion, m.descripcion as motivo_visita, 
            date_format(v.hora_salida,"%h:%i %p") as hora_salida, ev.email');
        $this->tabla->from('visitas v');
        $this->tabla->join('visitantes vt', 'v.visitante_id = vt.id_visitante', 'left');
        $this->tabla->join('empleados_visitados ev', 'v.empleado_id = ev.codigo', 'left');
        $this->tabla->join('instituciones i', 'v.institucion_id = i.id_institucion', 'left');
        $this->tabla->join('motivos m', 'v.motivo_id = m.id_motivo', 'left');
        $this->tabla->where('v.status !=', 2);
        $this->tabla->where("v.fecha BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-d')."'");
        $this->tabla->orderBy('v.fecha', 'DESC');
        $this->tabla->groupBy('v.id_visita');
        $datos = $this->tabla->findAll();    
           

        $data = ['titulo' => 'Reportes',  'instituciones' => $instituciones, 'motivos' => $motivos,'visitantes' => $visitantes,
                'departamentos_visitados' => $this->departamentos_visitados, 'datos' => $datos];
            
            echo  view ('templates/header');
            echo  view ('templates/sidebar');
            echo  view ('reportes/reporte_dinamico', $data);
            echo  view ('templates/footer');
        }

    public function consulta_dinamica_visitas() {
    
        $fecha1 = $this->request->getPost('fecha_desde');
        $date = str_replace('/', '-', $fecha1);
        $fecha_desde = date('Y-m-d', strtotime($date)); 

        $fecha2 = $this->request->getPost('fecha_hasta');  
        $date2 = str_replace('/', '-', $fecha2);
        $fecha_hasta = date('Y-m-d', strtotime($date2));
      
        $visitante = $this->request->getPost('visitante');
        $departamento = $this->request->getPost('departamento');
        $empleado = $this->request->getPost('empleado'); 
        $motivos = $this->request->getPost('motivos');  
        $ordenar_por = $this->request->getPost('ordenar_por');
        $asc_desc = $this->request->getPost('asc_desc');   
        
        
            $this->tabla->select('vt.nombres, vt.apellidos, v.no_gafete, ev.nombre as empleado, date_format(v.fecha, "%d-%m-%Y") as fecha, 
            date_format(v.hora_entrada,"%h:%i %p") as hora_entrada, v.status, v.equipos, v.total_visitantes, vt.identidad, vt.tipo_identidad, 
            ev.departamento, ev.extension, ev.puesto, v.foto, i.nombre_institucion, m.descripcion as motivo_visita, 
            date_format(v.hora_salida,"%h:%i %p") as hora_salida, ev.email');
            $this->tabla->from('visitas v');
            $this->tabla->join('visitantes vt', 'v.visitante_id = vt.id_visitante', 'left');
            $this->tabla->join('empleados_visitados ev', 'v.empleado_id = ev.codigo', 'left');
            $this->tabla->join('instituciones i', 'v.institucion_id = i.id_institucion', 'left');
            $this->tabla->join('motivos m', 'v.motivo_id = m.id_motivo', 'left');
            $this->tabla->where('v.status !=', 2);
            $this->tabla->where("v.fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'");
            if ($visitante != 'TODOS') { $this->tabla->where("v.visitante_id", $visitante);}
            if ($departamento != 'TODOS') { $this->tabla->where("ev.departamento", $departamento);}
            if ($empleado != 'TODOS') { $this->tabla->where("v.empleado_id", $empleado);}
            if ($motivos != 'TODOS') { $this->tabla->where("v.motivo_id", $motivos);}
            $this->tabla->orderBy($ordenar_por, $asc_desc);
            $this->tabla->groupBy('v.id_visita');
            $datos = $this->tabla->findAll();
            
            echo json_encode($datos,JSON_UNESCAPED_UNICODE);
            die();     
    }

   


    } //End Function Construct
?>