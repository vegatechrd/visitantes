<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\UsuariosGralModel;
    use App\Models\VisitasModel;
    use App\Models\VisitantesModel;
    
    class Visitantes extends BaseController{

        public function __construct(){
            
            $this->session = session();
            $this->usuario = new UsuariosGralModel();
            $this->tablaVisitas = new VisitasModel();
            $this->tabla = new VisitantesModel;
            $this->privilegios_CRUD = $this->usuario->privs_opcion_menu_rol('/Visitantes', $this->session->rol);
          
        }


          public function insert(){

      if ($this->privilegios_CRUD['C'] == "S") {

                    $strTipoDocumento = ucfirst(strClean($this->request->getPost('tipo_documento')));
                    $strDocumento = ucfirst(strClean($this->request->getPost('documento')));
                    $strNombres = ucfirst(strClean($this->request->getPost('nombres')));
                    $strApellidos = ucfirst(strClean($this->request->getPost('apellidos')));
                    $strTelefono = ucfirst(strClean($this->request->getPost('telefono')));
                    
      $requestExistencia = $this->tabla->GetVisitanteByIdentidad($strDocumento);
                        
                        if (empty($requestExistencia)) {
                            
                       $requestData = $this->tabla->save(['tipo_identidad' => $strTipoDocumento,
                                                          'identidad' => $strDocumento,  
                                                          'nombres' => $strNombres,
                                                          'apellidos' => $strApellidos,
                                                          'telefono'=>$strTelefono,
                                                          'status'=> 1]);
                                
                            
                      if ($requestData > 0) {

                            $id_ultimo_visitante = $this->tabla->insertID();
                                
                             $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.', "id_ultimo_visitante" => $id_ultimo_visitante);
                                } 


                            } // if request existencia
                            
                            else{
                                 $arrResponse = array("status" => false, "msg" => '¡Atención! este Visitante ya está registrado, favor seleccionar de la lista.');   
                                }

                            } // if privilegios crud
                            
                        else{
                         $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción');         
                        }
               
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function update(){

            if ($this->privilegios_CRUD['U'] == "S") {
      
                          $idVisitante = $this->request->getPost('id_visitante');
                          $strTipoDocumento = ucfirst(strClean($this->request->getPost('tipo_documento')));
                          $strDocumento = ucfirst(strClean($this->request->getPost('documento')));
                          $strNombres = ucfirst(strClean($this->request->getPost('nombres')));
                          $strApellidos = ucfirst(strClean($this->request->getPost('apellidos')));
                          $strTelefono = ucfirst(strClean($this->request->getPost('telefono')));
                          $status = $this->request->getPost('status');
                          
                $requestExistencia = $this->tabla->where('identidad', $strDocumento)->where('id_visitante !=', $idVisitante)->findAll();
                              
                              if (empty($requestExistencia)) {
                                  
                             $requestData = $this->tabla->update($idVisitante, ['tipo_identidad' => $strTipoDocumento,
                                                                'identidad' => $strDocumento,  
                                                                'nombres' => $strNombres,
                                                                'apellidos' => $strApellidos,
                                                                'telefono'=>$strTelefono,
                                                                'status'=> $status]);
                                      
                                  
                            if ($requestData > 0) {
      
                                                                     
                                   $arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente.');
                                      } 
      
      
                                  } // if request existencia
                                  
                                  else{
                                       $arrResponse = array("status" => false, "msg" => '¡Atención! el Visitante que desea ingresar ya está registrado.');   
                                      }
      
                                  } // if privilegios crud
                                  
                              else{
                               $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción');         
                              }
                     
                  echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                  die();
              }

              public function delete(){

                if ($this->privilegios_CRUD['D'] == "S") {
          
                              $idVisitante = $this->request->getPost('id_visitante');
                             
                         
                   
                                 $requestData = $this->tabla->update($idVisitante, ['status' => 0]);
                                          
                                      
                                if ($requestData > 0) {
          
                                                                         
                                       $arrResponse = array("status" => true, "msg" => 'Visitante inactivado correctamente.');
                                          } 
          
                                        
                                        else{
                                           $arrResponse = array("status" => false, "msg" => '¡Atención! el Visitante que desea ingresar ya está registrado.');   
                                          }
          
                                      } // if privilegios crud
                                      
                                  else{
                                   $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción');         
                                  }
                         
                      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                      die();
                  }
    
       public function consulta_visitantes(){
           
        if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {

        $datos = $this->tabla->findAll();


                $data = ['titulo' => "Consulta de Visitantes",
                         'datos' => $datos,    
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitantes/consulta', $data);   // Aquí va pagina principal a mostrar al abrir app
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


        $datos_visitante =  $this->tabla->GetVisitanteById($id);         
        $datos_visita = $this->tablaVisitas->GetVisitasbyIDVisitante($id);

                $data = ['titulo' => "Detalles de Visitante",
                         'datos_visitante' => $datos_visitante, 
                         'datos_visita' => $datos_visita,    
                         'privs' => $this->privilegios_CRUD
                         ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('visitantes/view', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }    


public function GetVisitanteByID(){

$id = $this->request->getPost('id_visitante');

$datos = $this->tabla->GetVisitanteById($id);
echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



    } //End Function Construct
?>