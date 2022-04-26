<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\UsuariosGralModel;
    use App\Models\InstitucionesModel;
      
    class Instituciones extends BaseController{

        public function __construct(){
            
            $this->session = session();
            $this->usuario = new UsuariosGralModel();
            $this->tabla = new InstitucionesModel();
            $this->titulo  = 'Instituciones';
            $this->privilegios_CRUD = $this->usuario->privs_opcion_menu_rol('/Instituciones', $this->session->rol);

        }

        public function index(){
            
            if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {

         $datos = $this->tabla->orderBy('nombre_institucion', 'ASC')->findAll();       
                
                $data = ['titulo' => $this->titulo, 
                         'privs' => $this->privilegios_CRUD,
                         'datos' => $datos
                            ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('instituciones/instituciones', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }

      public function insert(){

      if ($this->privilegios_CRUD['C'] == "S") {
                    
                    $strNombre = ucfirst(strClean($this->request->getPost('nombre')));
                    $strTelefono = ucfirst(strClean($this->request->getPost('telefono')));
                    
      $requestExistencia = $this->tabla->where('nombre_institucion', $strNombre)->first();
                        
                        if (empty($requestExistencia)) {
                            
                       $requestData = $this->tabla->save(['nombre_institucion'=>$strNombre,
                                                          'telefono_institucion'=>$strTelefono,
                                                          'status_institucion'=> 1]);
                                
                            
                      if ($requestData > 0) {

                            $ultima_institucion = $this->tabla->insertID();
                                
                             $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.', "ultima_institucion" => $ultima_institucion);
                                } 


                            } // if request existencia
                            
                            else{
                                 $arrResponse = array("status" => false, "msg" => '¡Atención! este nombre de institución ya existe');   
                                }

                            } // if privilegios crud
                            
                        else{
                         $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción');         
                        }
               
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }


        public function edit(){

            $id = $this->request->getPost('id');
            if ($id > 0) {

                if ($this->privilegios_CRUD['U'] == "S") {
                    
                    $arrData = $this->tabla->where('id_institucion',$id)->first();
                    if (empty($arrData)) {
                        
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                    }else{
                        $arrResponse = array('status' => true, 'data' => $arrData);
                    }
                }else{
                    $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción');
                    return redirect()->to(base_url().'/Dashboard');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

 public function update(){

      if ($this->privilegios_CRUD['U'] == "S") {
                    
                    $intId = ucfirst(strClean($this->request->getPost('idInstitucion')));
                    $strNombre = ucfirst(strClean($this->request->getPost('nombre')));
                    $strTelefono = ucfirst(strClean($this->request->getPost('telefono')));
                    $intStatus = ucfirst(strClean($this->request->getPost('status')));
                    
      $requestExistencia = $this->tabla->where('nombre_institucion', $strNombre)->where('id_institucion !=', $intId)->findAll();
                        
                        if (empty($requestExistencia)) {
                            
                       $requestData = $this->tabla->update($intId,
                                                         ['nombre_institucion'=>$strNombre,
                                                          'telefono_institucion'=>$strTelefono,
                                                          'status_institucion'=> $intStatus]);
                                
                            
                      if ($requestData > 0) {
                                
                             $arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente.');
                                } 


                            } // if request existencia
                            
                            else{
                                 $arrResponse = array("status" => false, "msg" => '¡Atención! este nombre de institución ya existe');   
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

         $id = strClean(intval($this->request->getPost('id')));             
                                        
                         $requestDelete = $this->tabla->update($id,
                            ['status_institucion'=>intval(0)]);
                            
                            $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la institución.');
                        }else{

                    $arrResponse = array('status' => false, 'msg' => '¡Atención! no tienes permisos para realizar esta opción');
                    return redirect()->to(base_url().'/Dashboard');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         
            die();
        }

     

    }
?>