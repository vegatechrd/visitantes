<?php 

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsuariosGralModel;

class Usuarios extends BaseController {

    protected $tabla;
    protected $reglas, $reglas_login, $reglas_cambio_password;
    protected $titulo;
    protected $controlador;   

    public function __construct() {

        $this->session = session();
        //$this->tabla = new UsuariosModel();
        $this->usuario = new UsuariosGralModel();        
        $this->titulo  = 'Gestión de usuarios';
        $this->controlador  = 'Usuarios';
        $this->javaScript = 'functions_'.$this->controlador.'.js';
        $this->url_opcion = '/'. $this->controlador;
        $this->privilegios_CRUD = $this->usuario->privs_opcion_menu_rol($this->url_opcion, $this->session->rol);

        $this->reglas = [
            'id_usuario' => [ 
                'rules' => 'required|is_unique[usuarios.id_usuario]',
                'errors' => [
                    'required' => 'El campo ID Usuario es obligatorio.',
                    'is_unique' => 'Ya existe un Usuario con el mismo ID, favor cambiar el ID de Usuario.'	
                ]
            ],
            'nombres' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Nombres es obligatorio.'	
                ]
            ],
            'apellidos' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Apellidos es obligatorio.'	
                ]
            ],            
            'email' => [ 
                'rules' => 'valid_email',
                'errors' => [
                    'valid_email' => 'Formato de email invalido.'
                ]
            ],
            'clave' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Contraseña es obligatorio.'
                ]
            ],
            'reClave' => [ 
                'rules' => 'required|matches[clave]',
                'errors' => [
                    'required' => 'El campo Repita Contraseña es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'	
                ]
            ]
        ];

        $this->reglas_edicion = [
            'nombres_update' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Nombres es obligatorio.'	
                ]
            ],
            'apellidos_update' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Apellidos es obligatorio.'	
                ]
            ],            
            'email_update' => [ 
                'rules' => 'valid_email',
                'errors' => [
                    'valid_email' => 'Formato de email invalido.'
                ]
            ],
            'activo_update' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Status es obligatorio.'
                ]
            ]            
        ];

        $this->reglas_login = [
            'txtUsuario' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Usuario es obligatorio.'    
                ]
            ],
            'txtContrasena' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Contraseña es obligatorio.'
                ]
            ]
        ];

        $this->reglas_cambio_password = [
            'clave' => [ 
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Contraseña es obligatorio.'    
                ]
            ],
            'reClave' => [ 
                'rules' => 'required|matches[clave]',
                'errors' => [
                    'required' => 'El campo Confirme Contraseña es obligatorio.',
                    'matches' => 'Las Contraseñas no coinciden.'
                ]
            ]
        ];
    } 

    public function index() {
       
        if (empty($this->session->idUsuario)) {

            return redirect()->to(base_url().'/Dashboard');
            die();
        }

        if ($this->privilegios_CRUD['R'] == "S") {

            $data = ['titulo' => $this->titulo, 
                     'controlador'=> $this->controlador,         
                     'privs' => $this->privilegios_CRUD,
                     'page_functions_js' => $this->javaScript
                    ];

            echo view ('templates/header');
            echo view ('templates/sidebar');
            echo view ('usuarios/usuarios', $data);   // Aquí va pagina principal a mostrar al abrir app
            echo view ('templates/footer');
        }else{
            return redirect()->to(base_url().'/Dashboard');
            die();
        }
    }

    public function getRecordSet(){

        if (empty($this->session->idUsuario)) {
            
            return redirect()->to(base_url().'/Dashboard');
            die();
        }

        if ($this->privilegios_CRUD['R'] != "S") {
            
            return redirect()->to(base_url().'/Dashboard');
            die();
        }

        $arrData = $this->tabla->obtener();

        for ($i = 0; $i < count($arrData); $i++) {

            // //Variables para los permisos, control de botones.
            $btnEdit = '';
            $btnDelete = '';
            $btnEditUser = '';
            $btnPermisosModulos = '';

            //Mediante este if le indicamos que si el array en el que estamos, en su 'status' es igual a 1, entonces,
            // Que cambie ese valor por el que le indicamos del badget, de lo contrario, que use el otro
            if ($arrData[$i]['activo'] == 1) {
                 $arrData[$i]['activo'] = '<span class="badge badge-success">Activo</span>';
            } else {
                if ($arrData[$i]['activo'] == 0){

                    $arrData[$i]['activo'] = '<span class="badge badge-danger">Inactivo</span>';
                }
            }
            
            //Validamos si existe el permido de editar
            if ($this->privilegios_CRUD['U'] <> "S") {
                
                
            }else{
                
                $btnEdit = '<button type="button" class="btn btn-sm color-secundario" onClick="fntEditPassword(\''. $arrData[$i]['id_usuario'] . '\')" title="Editar contraseña"><i class="fas fa-unlock-alt"></i></button>';

                $btnEditUser = '<button type="button" class="btn btn-update btn-sm color-primario" onClick="fntEdit(\''. $arrData[$i]['id_usuario'] . '\')" title="Editar usuario"><i class="fas fa-user-edit"></i></button>';
                
                $btnPermisosModulos = '<button type="button" class="btn btn-permisosModulos btn-sm btn-secondary" onClick="fntPermisosModulo(\''. $arrData[$i]['id_usuario'] . '\')" title="Permisos x Aplicacion"><i class="fas fa-list"></i></button>';

            }

            $arrData[$i]['options'] = '<div clas="text-center">' . $btnEdit . ' '. $btnEditUser . ' '. $btnPermisosModulos. '</div>';
        };
    
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function login() {
        echo view('login');
    }

    public function new() {
        
        if (empty($this->session->idUsuario)) {
                
            return redirect()->to(base_url().'/Dashboard');
            die();
        }

        if ($this->privilegios_CRUD['C'] == "S") {
        
        
            $data = ['titulo' => $this->titulo, 
                        'controlador'=> $this->controlador,         
                        'privs' => $this->privilegios_CRUD
                        ];       

            // NOTA: Gestion de la vista usando el esquema de partes ensamblables (Header/Sidebar/< PageBody >/Footer)
            // que extiende la vista basandose en el new_template.
            // Esto facilita el aplicar cambios generales cambiando solamente la data de los templates, aunque deficulta
            // un poco el seguimiento logico del programa como un todo.
            echo view ('templates/header');
            echo view ('templates/sidebar');
            echo view('usuarios/new', $data);   // Aquí va pagina principal a mostrar al abrir app
            echo view ('templates/footer');
        }else{
            return redirect()->to(base_url().'/Dashboard');
            die();
        }
    }

    public function insert() {

        if (empty($this->session->idUsuario)) {
                
            return redirect()->to(base_url().'/Dashboard');
            die();
        }

        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $hash = password_hash($this->request->getPost('clave'), PASSWORD_DEFAULT);
            $this->tabla->save([
                'id_usuario'=> strClean(strtolower($this->request->getPost('id_usuario'))),
                'nombres'=> strClean(ucwords($this->request->getPost('nombres'))),
                'apellidos'=> strClean(ucwords($this->request->getPost('apellidos'))),
                'email'=> strClean(strtolower($this->request->getPost('email'))),
                'activo' =>  intval(1),
                'clave'=> $hash
            ]);
            return redirect()->to(base_url().'/'. $this->controlador);
        } else {
            $data = ['titulo' => $this->titulo, 'controlador'=> $this->controlador, 'validation' => $this->validator];
            echo view ('templates/header');
            echo view ('templates/sidebar');
            echo view ('usuarios/new', $data);   // Muestra la misma pagina de insercion pero con los errores de valicacion
            echo view ('templates/footer'); 
        }
    }

    public function editPassword(string $idUsuario) {

        $id_usuario = strClean($idUsuario);

        if (!empty($id_usuario)) {

            if ($this->privilegios_CRUD['U'] == "S") {
                
                $arrData = $this->tabla->obtener($id_usuario);
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

    public function edit($id) {

        if (empty($this->session->idUsuario)) {
                
            return redirect()->to(base_url().'/Dashboard');
            die();
        }

        if ($this->privilegios_CRUD['U'] == "S") {        

            $usuario = $this->tabla->obtener($id);
            $data = ['titulo' => $this->titulo, 
                    'controlador'=> $this->controlador, 
                    'datos' => $usuario];

            // NOTA: Gestion de la vista usando el esquema de partes ensamblables (Header/Sidebar/< PageBody >/Footer)
            // que extiende la vista basandose en el edit_template.
            // Esto facilita el aplicar cambios generales cambiando solamente la data de los templates, aunque deficulta
            // un poco el seguimiento logico del programa como un todo.

            echo view ('templates/header');
            echo view ('templates/sidebar');
            echo view ('usuarios/edit', $data);   // Aquí va pagina principal a mostrar al abrir app
            echo view ('templates/footer'); 
        }else{
            return redirect()->to(base_url().'/Dashboard');
            die();
        }
    }

    public function update() {

        if ($this->request->getMethod() == "post" && $this->validate($this->reglas_edicion)) {

            $this->tabla->update(strClean(strtolower($this->request->getPost('id'))),
                ['nombres'=>strClean(ucwords($this->request->getPost('nombres_update'))),
                'apellidos'=>strClean(ucwords($this->request->getPost('apellidos_update'))),            
                'email'=>strClean(strtolower($this->request->getPost('email_update'))),
                'activo'=>strClean(intval($this->request->getPost('activo_update')))]);
            return redirect()->to(base_url().'/'.$this->controlador);
        } else {
            $dataEdicion = ['id_usuario' => $this->request->getPost('id'),
                'nombres'=>$this->request->getPost('nombres_update'),
                'apellidos'=>$this->request->getPost('apellidos_update'),            
                'email'=>$this->request->getPost('email_update'),
                'activo'=>$this->request->getPost('activo_update')];
            
            $data = ['titulo' => $this->titulo, 
                      'controlador'=> $this->controlador,
                      'datos' => $dataEdicion,
                      'validation' => $this->validator];
            echo view ('templates/header');
            echo view ('templates/sidebar');
            echo view ('usuarios/edit', $data);   // Muestra la misma pagina de edicion pero con los errores de valicacion
            echo view ('templates/footer'); 
        }            
    }
        
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }

    public function profile($id) {

        //$usuario = $this->getUserbyID($id); 
        $usuario = $this->data->obtener($id);
        $data = ['titulo' => 'Perfil Usuario', 
                  'controlador'=> $this->controlador,
                  'datos' => $usuario];
        
        echo view ('templates/header');
        echo view ('templates/sidebar');
        echo view('usuarios/profile', $data);   
        echo view ('templates/footer');
        
    }

    public function update_password() {     
        
        $idUsuario = strClean($this->request->getPost('id_usuario'));
        $cNueva = $this->request->getPost('clave');
        $cNuevaConfirmar = $this->request->getPost('reClave');

        if ($this->privilegios_CRUD['U'] == "S") {
        
            if ($cNueva != $cNuevaConfirmar) {

                $arrResponse = array("status" => false, "msg" => 'Las contraseñas no son iguales');
            }else{

                if (empty($idUsuario) || empty($cNueva)) {
                    
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
                }

                if ($this->privilegios_CRUD['U'] == "S") {
        
                    $hash = password_hash($cNueva, PASSWORD_DEFAULT);
                    $requestData = $this->tabla->update($idUsuario,[
                                        'clave'=> $hash]);
                }else{
                    $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción');
                }

                if ($requestData > 0){
                    
                    $arrResponse = array("status" => true, "msg" => 'Contraseña actualizada correctamente');
        
                }
            }
        }else{
            $arrResponse = array("status" => false, "msg" => '¡Atención! no tienes permisos para realizar esta opción');
        }

        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
    }    

    public function valida_login(){
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas_login)) {
            $usuario = $this->request->getPost('txtUsuario');
            $contrasena = $this->request->getPost('txtContrasena');
            $datos_usuario = $this->tabla->where('ID_USUARIO', $usuario)->where('INACTIVO_SN','N')->first();

            if($datos_usuario != null) {
                if(password_verify($contrasena, $datos_usuario['CLAVE'])) {
                    $datos_sesion = [
                        'idUsuario' => $datos_usuario['ID_USUARIO'],
                        'nombres' => $datos_usuario['NOMBRE'],
                        'rol' => $datos_usuario['ROLE']
                    ]; 
                    $session = session();
                    $session -> set($datos_sesion);
                    //echo view('dashboard');
                    return redirect()->to(base_url() . '/Dashboard');
                } else {
                    $data['error'] = "Las Contraseñas no coinciden.";  
                    echo view('login', $data);
                }
            } else {
                $data['error'] = "El Usuario no existe o está Inactivo. ";  
                echo view('login', $data);
            }
        } else {
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }

}  //fin de la clase

?>