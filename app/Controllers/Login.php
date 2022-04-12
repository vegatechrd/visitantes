<?php 

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsuariosGralModel;

class Login extends BaseController {

      protected $usuario;

      public function __construct() {

            $this->session = session();

            $this->usuario = new UsuariosGralModel();
            
            $this->controlador  = 'Login';
            $this->url_opcion = '/'. $this->controlador;
            $this->privilegios_CRUD = $this->usuario->privs_opcion_menu_rol($this->url_opcion, $this->session->rol);

            $this->reglas_cambio_password = [
                  'txtContrasenaActual' => [ 
                          'rules' => 'required',
                          'errors' => [
                                'required' => 'El campo Contraseña Actual es obligatorio.'    
                          ]
                    ],
                  'txtContrasenaNueva' => [ 
                          'rules' => 'required',
                          'errors' => [
                                'required' => 'El campo Contraseña es obligatorio.'    
                          ]
                    ],
                    'txtConfirmeContrasena' => [ 
                          'rules' => 'required|matches[txtContrasenaNueva]',
                          'errors' => [
                                'required' => 'El campo Confirme Contraseña es obligatorio.',
                                'matches' => 'Las Contraseñas no coinciden.'   
                          ]
                    ]
            ];            
      } 

      public function login() {
            $datos_sesion = ['aplicacion' => APP_MODULO]; 

            $session = session();
            $session -> set($datos_sesion);

            if (isset($session->idUsuario)) {
                
                  return redirect()->to(base_url().'/dashboard');
            }     

            echo view('login');
      }

      public function autorizar_login(){
            if ($this->request->getMethod() == "post") {
                  $usuario = $this->request->getPost('txtUsuario');
                  $contrasena = $this->request->getPost('txtContrasena');
                  $datos_usuario = $this->usuario->verifica_permisos($usuario, APP_MODULO);
                  if($datos_usuario != null) {
                        if(password_verify($contrasena, $datos_usuario['clave'])) {
                              $opciones_menu = $this->usuario->opciones_menu($datos_usuario['id_aplicacion'], $datos_usuario['rol_usuario']);
                              $datos_sesion = [
                                    'idUsuario' => $datos_usuario['id_usuario'],
                                    'token' => $datos_usuario['clave'],
                                    'nombres' => $datos_usuario['nombres'],
                                    'apellidos' => $datos_usuario['apellidos'],
                                    'id_aplicacion' => $datos_usuario['id_aplicacion'],
                                    'aplicacion' => $datos_usuario['aplicacion'],
                                    'version' => $datos_usuario['version'],
                                    'rol' => $datos_usuario['rol_usuario'],
                                    'opciones_menu' => $opciones_menu,
                                    'authenticated' => 1
                              ]; 
                              
                              $session = session();
                              $session -> set($datos_sesion);
                              //echo view('dashboard');
                              return redirect()->to(base_url() . '/dashboard');
                        } else {
                              $data['error'] = "La Contraseña no coincide.";  
                              echo view('login', $data);
                        }
                  } else {
                        $data['error'] = "El Usuario no existe o no tiene permiso a esta aplicación.";  
                        echo view('login', $data);
                  }
            } else {
                  $data = ['validation' => $this->validator];
                  echo view('login', $data);
            }
      }

      public function logout(){
            $session = session();
            $session->destroy();
            return redirect()->to(base_url());
      }

      public function profile($id) {

            $this->session = session();

            // Validamos de que exista una sesión iniciada
            if (empty($this->session->idUsuario)) {
                
                  return redirect()->to(base_url().'/Dashboard');
                  die();
            } 
            
            // Consultamos a la base de datos para obtener los datos del usuarios que está logueado
            $usuario = $this->usuario->obtener($id);

            /* 
                  Esta validación sirve para cuando se digita un id de usuario o algo en la URL que no pertenece a un registro
                  o no es encontrado en la base de datos, además de, redireccionar a la misma página de profile, de esta manera evitamos
                  que se produzca un error.
            */
            if (empty($usuario['id_usuario'])) {
                  
                  return redirect()->to(base_url().'/Login/profile/'.$this->session->idUsuario);
            }

            /* 
                  Validamos de que el usuario que se digita en la URL sea el mismo que está logueado, de lo contrario 
                  redireccionamos a la misma página de profile perteneciente al usuario que inicio sesión, con esto,
                  evitamos de que nos digiten cualquier usuario en la URL.
            */
            if ($this->session->idUsuario <> $usuario['id_usuario']) {

                  return redirect()->to(base_url().'/Login/profile/'.$this->session->idUsuario);
            }else{

                  $datosRolUsuario = $this->usuario->rol_usuario_modulo($id, APP_MODULO);
                  $descripcion_rol_usuario = $datosRolUsuario['descripcionRolUsuario'];
                  $data = ['titulo' => 'Perfil Usuario',
                            'datos' => $usuario,
                            'descripcion_rol_usuario' =>  $descripcion_rol_usuario,
                            'controlador'=> $this->controlador,         
                            'privs' => $this->privilegios_CRUD
                        ];
                  
                  echo view ('templates/header');
                  echo view ('templates/sidebar');
                  echo view('usuarios/profile', $data);   
                  echo view ('templates/footer');
            }  
      }
    
      public function update_password() {
            
            $sesion = session();
            $idUsuario = $sesion->idUsuario;
            $token = $sesion->token;

            $id = $sesion->idUsuario;
            $datosRolUsuario = $this->usuario->rol_usuario_modulo($id, APP_MODULO);
            $descripcion_rol_usuario = $datosRolUsuario['descripcionRolUsuario'];
            
            if ($this->request->getMethod() == "post" && $this->validate($this->reglas_cambio_password)) {

                  $cActual = $this->request->getPost('txtContrasenaActual');
                  $cNueva = $this->request->getPost('txtContrasenaNueva');
                  $ccNueva = $this->request->getPost('txtConfirmeContrasena');
            
                  if(password_verify($cActual, $token)) { 
                        $hash = password_hash($cNueva, PASSWORD_DEFAULT);
                        $this->usuario->update($idUsuario,[
                              'clave'=> $hash]);
                        return redirect()->to(base_url().'/Login/login');
            
                  } else {
                        $usuario = $this->usuario->obtener($idUsuario);
                        $data = ['titulo' => 'Perfil Usuario', 
                                 'datos' => $usuario,
                                 'descripcion_rol_usuario' =>  $descripcion_rol_usuario,
                                 'error' => "La contraseña actual no es correcta."];
                        
                        echo view ('templates/header');
                        echo view ('templates/sidebar');
                        echo view('usuarios/profile', $data);   // Aquí va pagina principal a mostrar al abrir app
                        echo view ('templates/footer');  
                  }            
            } else {
                  $usuario = $this->usuario->obtener($idUsuario);                                    
                  $data = ['titulo' => 'Perfil Usuario', 'datos' => $usuario,'descripcion_rol_usuario' =>  $descripcion_rol_usuario, 'validation' => $this->validator];
                  echo view ('templates/header');
                  echo view ('templates/sidebar');
                  echo view('usuarios/profile', $data);   // Aquí va pagina principal a mostrar al abrir app
                  echo view ('templates/footer');   
            } 
      } // fin función update_password      

}  //fin de la clase
?>