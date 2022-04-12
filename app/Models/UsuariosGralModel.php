<?php

namespace App\Models;
use CodeIgniter\Model;
/*
-- ------------------------------------------------------------------------------------------ --
-- OJO: >>> Esta NO ES una clase GENERICA Para Gestion de Usuario <<<
-- Esta es la CLASE MAESTRA que permite crear y/o modificar Usuarios, EXCLUSIVA del Modulo GRAL.
-- Existe otra versión de este modelo PERO SOLO incluye opciones para gestion del propio usuario 
-- que intenta acceder a los sistemas.
--
-- NOTA: Está pendiente la funcion que actualiza el campo "ultimo_login"
-- RCruz, INESPRE Junio 2021 
-- ------------------------------------------------------------------------------------------ --
*/
class UsuariosGralModel extends Model
{   
    protected $DBGroup = 'graldb';
        
    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $useAutoIncrement = false;    

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_usuario', 'clave', 'nombres', 'apellidos','email','activo','ultimo_login'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_registro';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false; 

    public function obtener($idUsuario) {
        $this->select('usuarios.*');
        $this->where('usuarios.id_usuario', $idUsuario);            
        $datos = $this->first(); 
        return $datos;
    }

    public function lov_roles_usuario($rolUsuario='TODOS') {    
        $db = db_connect();
        if ($rolUsuario == 'TODOS') {
            $sql = "SELECT id ID, descripcion_corta DESCRIPCION FROM roles_usuario ORDER BY id";
            $query = $db->query($sql,[]);
        } else {
            $sql = "SELECT id ID, descripcion_corta DESCRIPCION FROM roles_usuario WHERE id < :rolUsuario: ORDER BY id";            
            $query = $db->query($sql, ['rolUsuario' => $rolUsuario]);
        }

        $results = $query->getResult();
        return $results;        
    }     

    /*
    -- Valida si el Usuario Existe y si tiene permiso al Modulo en Proceso 
    -- NOTA: Requiere la existencia de la vista: rol_usuarios_x_aplicacion_V
    */
    public function verifica_permisos($idUsuario, $modulo) {
        $this->select('usuarios.*, rol_usuario_x_aplicacion_v.rol_usuario, rol_usuario_x_aplicacion_v.id_aplicacion, rol_usuario_x_aplicacion_v.aplicacion, rol_usuario_x_aplicacion_v.version');
        $this->join('rol_usuario_x_aplicacion_v', 'rol_usuario_x_aplicacion_v.id_usuario = usuarios.id_usuario');
        $this->where('usuarios.id_usuario', $idUsuario);
        $this->where('usuarios.activo',1);
        $this->where('rol_usuario_x_aplicacion_v.aplicacion', $modulo);
        $this->where('rol_usuario_x_aplicacion_v.rol_activo',1);
        $datos = $this->first(); 
        return $datos;
    }

    /*
    -- Funcion que devuelve el rol de un usuario en un modulo 
    */
    public function rol_usuario_modulo($idUsuario, $modulo) {
        // ------------------------------------ --
        // Total Usuarios Activos
        // ------------------------------------ --  

        $sql   = "SELECT ruav.rol_usuario 
                    FROM rol_usuario_x_aplicacion_v ruav
                   WHERE ruav.id_usuario = :idUsuario: 
                     AND ruav.aplicacion = :siglasModulo: ";
        $query = $this->db->query($sql, ['idUsuario' => $idUsuario, 'siglasModulo' => $modulo]);
        // Trae el Primer (y unico) registro del query.
        $results = $query->getRow();
        if (isset($results)) {
            $datos = ['rolUsuario' => $results->rol_usuario,
                    'descripcionRolUsuario' => $results->rol_usuario];
        } else {
            // Si no trae Nada, asume el privilegio minimo (1 -> Solo Lectura)
            $datos = ['rolUsuario' => 1,
                    'descripcionRolUsuario' => 'Solo Lectura'];
        }
        return $datos;
    }

    /*
    -- Funcion que devuelve un arreglo con las opciones del menu a la que el role del usuario
    -- dentro de la aplicacion tiene privilegios para verlas.
    -- NOTA: Las opciones del menu raiz tienen como menu padre un cero (0).
    --       Dado que la idea es construir un menu en el Side-Bar, se hará un bucle de HASTA 3 niveles (n0, n1 y n2).
    */
    public function opciones_menu($idModulo,$rolUsuario) {
        $opciones = array();
        if (!empty($idModulo) & !empty($rolUsuario)) {
            /* Nivel 0 */
            $n0 =  $this->opciones_menu_padre($idModulo, $rolUsuario, 0);
            if (!empty($n0)) {
                $i = 0;
                foreach ($n0 as $r0) {
                    $opciones[$i]['nivel'] = 0;
                    $opciones[$i]['tipo_opcion'] = $r0->tipo_opcion;
                    $opciones[$i]['secuencia'] = $r0->secuencia;
                    $opciones[$i]['descripcion'] = $r0->descripcion;
                    $opciones[$i]['descripcion_corta'] = $r0->descripcion_corta;
                    $opciones[$i]['url_opcion'] = $r0->url_opcion;
                    $opciones[$i]['icono_opcion'] = $r0->icono_opcion;
                   $i++;
                    // Nivel 1 
                    if ($r0->tipo_opcion == 'MENU') {
                        $n1 =  $this->opciones_menu_padre($idModulo, $rolUsuario, $r0->id);
                        if (!empty($n1)) {
                            foreach ($n1 as $r1) {
                                $opciones[$i]['nivel'] = 1;
                                $opciones[$i]['tipo_opcion'] = $r1->tipo_opcion;
                                $opciones[$i]['secuencia'] = $r1->secuencia;
                                $opciones[$i]['descripcion'] = $r1->descripcion;
                                $opciones[$i]['descripcion_corta'] = $r1->descripcion_corta;
                                $opciones[$i]['url_opcion'] = $r1->url_opcion;
                                $opciones[$i]['icono_opcion'] = $r1->icono_opcion;
                                $i++;
                                // Nivel 2 
                                if ($r1->tipo_opcion == 'MENU') {
                                    $n2 =  $this->opciones_menu_padre($idModulo, $rolUsuario, $r1->id);
                                    if (!empty($n2)) {
                                        foreach ($n2 as $r2) {
                                            $opciones[$i]['nivel'] = 2;
                                            $opciones[$i]['tipo_opcion'] = $r2->tipo_opcion;
                                            $opciones[$i]['secuencia'] = $r2->secuencia;
                                            $opciones[$i]['descripcion'] = $r2->descripcion;
                                            $opciones[$i]['descripcion_corta'] = $r2->descripcion_corta;
                                            $opciones[$i]['url_opcion'] = $r2->url_opcion;
                                            $opciones[$i]['icono_opcion'] = $r2->icono_opcion;
                                            $i++;                                            
                                        }
                                    }         
                                } 
                            }
                        } 
                    } 
                }
            }
        }
        return $opciones;
    }

    private function opciones_menu_padre($idModulo, $rolUsuario, $idMenuPadre) {
        
        // $sql   = "SELECT * FROM opciones_menu WHERE id_aplicacion = :idModulo: AND id_opcion_padre = :idMenuPadre: AND rol_minimo <= :rolUsuario: AND activo = 1 ORDER BY secuencia";
        // $query = $this->db->query($sql, 
        //     ['idModulo' => $idModulo,
        //      'idMenuPadre' => $idMenuPadre,
        //      'rolUsuario' => $rolUsuario
        //     ]
        // );
        // $results = $query->getResult();
        // return $results; 
        
        // ------------------------------------------------------------------------------------------------------ --
        // Modificación al Query
        // -> Realizada por (nombre de usuario): mechavarria
        // -> Fecha: 30-12-2021 
        // ------------------------------------------------------------------------------------------------------ --

        $rol_usuario = $rolUsuario;

        if ($rol_usuario == 9) {
            $sql   = "SELECT * FROM opciones_menu WHERE id_aplicacion = :idModulo: AND id_opcion_padre = :idMenuPadre: AND rol_minimo <= :rolUsuario: AND activo = 1 ORDER BY secuencia";
            $query = $this->db->query($sql, 
                ['idModulo' => $idModulo,
                'idMenuPadre' => $idMenuPadre,
                'rolUsuario' => $rolUsuario
                ]
            );
            $results = $query->getResult();
            return $results; 
        }else{

            $sql   = "SELECT * FROM opciones_menu WHERE id_aplicacion = :idModulo: AND id_opcion_padre = :idMenuPadre:  AND activo = 1 AND url_opcion IN(SELECT url_opcion FROM privs_opcion_menu_rol WHERE  id_rol = :rolUsuario: AND puede_seleccionar_sn = 'S') ORDER BY secuencia ";
            $query = $this->db->query($sql, 
                ['idModulo' => $idModulo,
                 'idMenuPadre' => $idMenuPadre,
                 'rolUsuario' => $rolUsuario
                ]
            );
            $results = $query->getResult();
        }

        return $results;
    }    

    // Funcion que devuelve un arreglo con los privilegios de un Rol dado a una opcion de Menu dada
    // Si no tiene solo se le permitirá el privilegio de VER los datos (no podra Insertar, ni Modificar ni Borrar)
    public function privs_opcion_menu_rol($urlOpcion, $rolUsuario) {    
        $sql   = "SELECT privs.puede_seleccionar_sn as ver, privs.puede_insertar_sn as insertar, privs.puede_modificar_sn as modificar,	privs.puede_borrar_sn as borrar FROM privs_opcion_menu_rol privs WHERE privs.url_opcion = :urlOpcion: AND privs.id_rol = :rolUsuario:";
        $query = $this->db->query($sql, 
            ['urlOpcion' => $urlOpcion,
            'rolUsuario' => $rolUsuario
            ]
        );        
        $results = $query->getResult();
        // ------------------------------------------------------------------------------------------------------ --
        // Por Defecto, el super Usuario tiene SIEMPRE TODOS los privilegios
        // NOTA: El privilegio "Insertar" sera usado tambien cuando se evalue la opcion de "Ejecutar" (en caso de formas con opciones de "Procesar").
        // En caso de que una forma tenga mas de un boton para ejecutar diferentes procesos, TODOS seran evaluados con el mismo privilegio.
        // Si desea variar este comportamiento, debe crearse una opcion diferente por cada accion y así poder dar privilegios diferentes segun el rol.
        // RCruz, Junio 2021.
        // ------------------------------------------------------------------------------------------------------ --
        if ($rolUsuario >= 9) {
            $ver       = 'S';
            $insertar  = 'S';
            $modificar = 'S';
            $borrar    = 'S';
        } else {
            $ver       = 'N';
            $insertar  = 'N';
            $modificar = 'N';
            $borrar    = 'N';
        }

        // En teoria solo deberia venir UN solo registro; pero si viene mas de uno le dará los privilegios del ultimo registro
        if (!empty($results)) {
            foreach ($results as $r) {
                $ver = $r->ver;
                $insertar = $r->insertar;
                $modificar = $r->modificar;
                $borrar = $r->borrar;
            }
        } 
        $privilegios['C'] = $insertar;
        $privilegios['R'] = $ver;
        $privilegios['U'] = $modificar;
        $privilegios['D'] = $borrar;
        return $privilegios;
    }     
}