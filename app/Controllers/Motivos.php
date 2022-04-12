<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\UsuariosGralModel;
    use App\Models\MotivosModel;


    
    class Motivos extends BaseController{

        public function __construct(){
            
            $this->session = session();
            $this->usuario = new UsuariosGralModel();
            $this->tabla = new MotivosModel();
            $this->titulo  = 'Motivos De La Visita';
            $this->privilegios_CRUD = $this->usuario->privs_opcion_menu_rol('/Motivos', $this->session->rol);

        }

        public function index(){
            
            if (empty($this->session->idUsuario)) {
                
                return redirect()->to(base_url().'/Dashboard');
                die();
            }

            if ($this->privilegios_CRUD['R'] == "S") {

     $datos = $this->tabla->where('status !=',2)->orderBy('descripcion', 'ASC')->findAll();           
                
                $data = ['titulo' => $this->titulo, 
                         'privs' => $this->privilegios_CRUD,
                         'datos' => $datos
                        ];
    
                echo view ('templates/header');
                echo view ('templates/sidebar');
                echo view ('motivos/motivos', $data);   // Aquí va pagina principal a mostrar al abrir app
                echo view ('templates/footer');
            }else{
                return redirect()->to(base_url().'/Dashboard');
                die();
           }
        }


      public function insert(){

      if ($this->privilegios_CRUD['C'] == "S") {
                    
                    $strDescripcion = ucfirst(strClean($this->request->getPost('descripcion')));
                    
                    $requestExistencia = $this->tabla->where('descripcion', $strDescripcion)->first();
                        
                        if (empty($requestExistencia)) {
                            
                       $requestData = $this->tabla->save(['descripcion'=>$strDescripcion,
                                                          'usuario_id' => $this->session->idUsuario,  
                                                          'status'=> 1]);
                                
                            
                      if ($requestData > 0) {

                        $ultimo_motivo = $this->tabla->insertID();
                                
                             $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.', "ultimo_id" => $ultimo_motivo);
                                } 


                            } // if request existencia
                            
                            else{
                                 $arrResponse = array("status" => false, "msg" => '¡Atención! este Motivo ya existe.');   
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
                    
                    $arrData = $this->tabla->where('id_motivo',$id)->first();
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

      if ($this->privilegios_CRUD['C'] == "S") {
                    
                    $intId = ucfirst(strClean($this->request->getPost('id')));
                    $strDescripcion = ucfirst(strClean($this->request->getPost('descripcion')));
                    $intStatus = ucfirst(strClean($this->request->getPost('status')));
                    
      $requestExistencia = $this->tabla->where('descripcion', $strDescripcion)->where('id_motivo !=', $intId)->findAll();
                        
                        if (empty($requestExistencia)) {
                            
                       $requestData = $this->tabla->update($intId,
                                                         ['descripcion'=>$strDescripcion,
                                                          'usuario_id' => $this->session->idUsuario,  
                                                          'status'=> $intStatus]);
                                
                            
                      if ($requestData > 0) {
                                
                             $arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente.');
                                } 


                            } // if request existencia
                            
                            else{
                                 $arrResponse = array("status" => false, "msg" => '¡Atención! este Motivo ya existe.');   
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
                            ['status'=>intval(2)]);
                            
                            $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Motivo.');
                        }else{

                    $arrResponse = array('status' => false, 'msg' => '¡Atención! no tienes permisos para realizar esta opción');
                    return redirect()->to(base_url().'/Dashboard');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         
            die();
        }


    }
?>