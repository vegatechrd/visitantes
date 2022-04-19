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

        public function reportes(){

           

            $data = ['titulo' => 'Reportes',  'instituciones' => $this->instituciones, 'motivos' => $this->motivos,'visitantes' => $this->visitantes,
                    'departamentos_visitados' => $this->departamentos_visitados];
                
                echo  view ('templates/header');
                echo  view ('templates/sidebar');
                echo  view ('reportes/reporte_dinamico', $data);
                echo  view ('templates/footer');
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

            if ($this->privilegios_CRUD['R'] == "S") {
                
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
                                                       'puesto'=> $puesto_empleado,                                           
                                                       'status'=> 1]);
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
                            ['status'=>intval(2)]);
                            
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

public function reporte_general() {

$datos = $this->tabla->GetAllHistory();

$pdf = new \PDF_MC_Table('L', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10,10,0);
$pdf->SetAutoPageBreak(false,0);

$pdf->Image(base_url().'/dist/img/logo.jpg',10,8,45,0,'JPG');
$pdf->SetXY(110,15);
$pdf->SetFont('Arial','B',13);

$pdf->Cell(190,5,utf8_decode('INSTITUTO DE ESTABILIZACIÓN DE PRECIOS'), 0, 1, 'L');
$pdf->SetXY(133,21);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(190,5,utf8_decode('DIRECCIÓN EJECUTIVA'), 0, 1, 'L');
$pdf->SetXY(112,27);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(90,5,utf8_decode('REPORTE GENERAL VISITAS INSTITUCIÓN'), 0, 1, 'L');


$pdf->SetLineWidth(0.7);
$pdf->SetDrawColor(13,90,46);
$pdf->Line(10,41,268,41);
$pdf->SetDrawColor(174, 163, 34);
$pdf->SetLineWidth(0.7);
$pdf->Line(10,43,268,43);

$pdf->Ln(18);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',9);
$pdf->SetLineWidth(0.3);
$pdf->SetFillColor(13,90,46);
$pdf->Cell(20,6,utf8_decode('Fecha'),1,0,'L',1);
$pdf->Cell(35,6,utf8_decode('Visitante'),1,0,'L',1);
$pdf->Cell(20,6,utf8_decode('Identidad'),1,0,'L',1);
$pdf->Cell(62,6,utf8_decode('Persona Visitada'),1,0,'L',1);
$pdf->Cell(78,6,utf8_decode('Departamento'),1,0,'L',1);
$pdf->Cell(23,6,utf8_decode('Hora Entrada'),1,0,'L',1);
$pdf->Cell(20,6,utf8_decode('Hora Salida'),1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Ln();
$pdf->SetWidths(array(20,35,20,62,78,23,20));
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0);
if ($datos) {
foreach ($datos as $dato) {
$pdf->Row(array(
date("d/m/Y", strtotime($dato['fecha'])),    
utf8_decode($dato['nombres'].' '.$dato['apellidos']),
utf8_decode($dato['identidad']),
utf8_decode($dato['empleado']),
utf8_decode($dato['departamento']),
date('h:i A', strtotime($dato['hora_entrada'])),
date('h:i A', strtotime($dato['hora_salida'])),
));
}    
}
else {
$pdf->Cell(260,6,"No se encontraron Datos",1,0,'C');
}
$this->response->setHeader('Content-Type', 'application/pdf');
$pdf->Output('Reporte_General.pdf', 'I');


}


public function printVisita($idVisita) {

    $datos = $this->tabla->GetAllHistory($idVisita);

   
    
    $pdf = new \FPDF('P', 'mm', 'letter');
    $pdf->AddPage();
    $pdf->SetMargins(10,10,0);
    $pdf->SetAutoPageBreak(false,0);
    
    $pdf->Image(base_url().'/dist/img/logo.jpg',10,8,45,'JPG');
    $pdf->SetXY(80,15);
    $pdf->SetFont('Arial','B',13);
    
    $pdf->Cell(190,5,utf8_decode('INSTITUTO DE ESTABILIZACIÓN DE PRECIOS'), 0, 1, 'L');
    $pdf->SetXY(106,21);
    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(190,5,utf8_decode('DIRECCIÓN EJECUTIVA'), 0, 1, 'L');
    $pdf->SetXY(105,27);
    $pdf->SetFont('Arial','',13);
    $pdf->Cell(90,5,utf8_decode('REPORTE VISITA NO:'.$datos['id_visita']), 0, 1, 'L');
    
    $pdf->SetLineWidth(0.7);
    $pdf->SetDrawColor(13,90,46);
    $pdf->Line(10,41,203,41);
    $pdf->SetDrawColor(174, 163, 34);
    $pdf->SetLineWidth(0.7);
    $pdf->Line(10,43,203,43);
    
    $pdf->SetXY(9,50);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(90,5,utf8_decode('Datos Visitante'), 0, 1, 'L');

    $pdf->SetXY(110,50);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(90,5,utf8_decode('Datos Visita'), 0, 1, 'L');
    
    $pdf->SetXY(10,60);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Documento:'), 0, 1, 'L');
    $pdf->SetXY(45,60);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, $datos['identidad'], 0, 1, 'L');
    
    $pdf->SetXY(10,65);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Tipo Documento:'), 0, 1, 'L');
    
    $pdf->SetXY(45,65);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, utf8_decode($datos['tipo_identidad']), 0, 1, 'L');
    
    $pdf->SetXY(110,60);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Fecha:'), 0, 1, 'L');
    $pdf->SetXY(145,60);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, date('d-m-Y', strtotime($datos['fecha'])), 0, 1, 'L');
    
    $pdf->SetXY(110,65);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Hora Entrada:'), 0, 1, 'L');
    
    $pdf->SetXY(145,65);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, date("h:i:s A", strtotime($datos['hora_entrada'])), 0, 1, 'L');
    
    
    $pdf->SetXY(10,70);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Nombre:'), 0, 1, 'L');
    $pdf->SetXY(45,70);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, utf8_decode($datos['nombres'].' '.$datos['apellidos']), 0, 1, 'L');
    
    $pdf->SetXY(10,75);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Institución:'), 0, 1, 'L');
    
    $pdf->SetXY(45,75);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, utf8_decode($datos['nombre_institucion']), 0, 1, 'L');
    
    $pdf->SetXY(110,70);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, 'Hora Salida:' , 0, 1, 'L');
    $pdf->SetXY(145,70);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, date("h:i:s A", strtotime($datos['hora_salida'])), 0, 1, 'L');
    
    $pdf->SetXY(110,75);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Motivo Visita:'), 0, 1, 'L');
    
    $pdf->SetXY(145,75);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, utf8_decode($datos['motivo_visita']), 0, 1, 'L');
    
    $pdf->SetXY(10,80);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Pertenencias:'), 0, 1, 'L');
    
    $pdf->SetXY(45,80);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40,5, $datos['equipos'], 0, 1, 'L');

    $pdf->SetXY(10,85);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Foto:'), 0, 1, 'L');
    $pdf->SetXY(45,85);
    

    $foto = $datos['foto'];
    if ($foto) {
     $pdf->Image(base_url().'/'.$datos['foto'],45,85,30,30,'JPG');
    }
    else {

     $pdf->Image(base_url().'/dist/img/silueta.png',45,85,30,30,'PNG');    
    }
   

    $pdf->SetXY(110,80);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Status Visita:'), 0, 1, 'L');
    
    $pdf->SetXY(145,80);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, 'CONCLUIDA', 0, 1, 'L');

    $pdf->SetXY(110,85);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Total Visitantes:'), 0, 1, 'L');
    
    $pdf->SetXY(145,85);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, $datos['total_visitantes'], 0, 1, 'L');

    $pdf->SetXY(110,90);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5,utf8_decode('Número Gafete:'), 0, 1, 'L');
    
    $pdf->SetXY(145,90);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, $datos['no_gafete'], 0, 1, 'L');
    
    $pdf->SetXY(10,125);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(90,5,utf8_decode('Datos Persona Visitada'), 0, 1, 'L');
  
    $pdf->SetXY(10,135);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,utf8_decode('Persona Visitada:'), 0, 1, 'L');
    
    $pdf->SetXY(45,135);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, $datos['empleado'], 0, 1, 'L');

    $pdf->SetXY(10,140);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,utf8_decode('Departamento:'), 0, 1, 'L');
    
    $pdf->SetXY(45,140);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, utf8_decode($datos['departamento']), 0, 1, 'L');

    
    $pdf->SetXY(10,145);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,utf8_decode('Puesto:'), 0, 1, 'L');
    
    $pdf->SetXY(45,145);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, utf8_decode($datos['puesto']), 0, 1, 'L');

    
    $pdf->SetXY(10,150);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,utf8_decode('Extensión:'), 0, 1, 'L');
    
    $pdf->SetXY(45,150);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, $datos['extension'], 0, 1, 'L');

    
    $pdf->SetXY(10,155);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,utf8_decode('Email:'), 0, 1, 'L');
    
    $pdf->SetXY(45,155);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,5, utf8_decode($datos['email']), 0, 1, 'L');
    
    $this->response->setHeader('Content-Type', 'application/pdf');
    $pdf->Output('Reporte_Visita.pdf', 'I');
    
    }

    public function consulta_dinamica_visitas() {
    
        $fecha_desde = $this->request->getPost('fecha_desde');
       // $date = str_replace('/', '-', $fecha1);
       // $fecha_desde = date('Y-m-d', strtotime($date)); 

        $fecha_hasta = $this->request->getPost('fecha_hasta');  
       // $date2 = str_replace('/', '-', $fecha2);
       // $fecha_hasta = date('Y-m-d', strtotime($date2));
        
        $visitante = $this->request->getPost('visitante');  
        $departamento = $this->request->getPost('departamento');
        $empleado = $this->request->getPost('empleado'); 
        $motivos = $this->request->getPost('motivos');  
        $ordenar_por = $this->request->getPost('ordenar_por');
        $asc_desc = $this->request->getPost('asc_desc');    
    
        $datos = $this->tabla->where('fecha BETWEEN "'.date('Y-m-d', strtotime($fecha_desde)). '" and "'. date('Y-m-d', strtotime($fecha_hasta)).'"');
        $datos = $this->tabla->findAll();
        echo json_encode($datos);
    
    }


    } //End Function Construct
?>