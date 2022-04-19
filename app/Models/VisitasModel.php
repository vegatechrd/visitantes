<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class VisitasModel extends Model{

        protected $table      = 'visitas';
        protected $primaryKey = 'id_visita';
        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['visitante_id','no_gafete','motivo_id','institucion_id','empleado_id','fecha','fecha_programada','total_visitantes',
                                    'equipos', 'hora_entrada', 'hora_salida','foto','status','usuario_id'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = '';


         public function GetAllVisitas($id='TODOS') {
            
            $this->select('v.id_visita, vt.nombres, vt.apellidos, vt.identidad, v.no_gafete, v.empleado_id, ev.nombre as empleado, v.visitante_id,
            v.fecha, v.hora_entrada, v.status, v.equipos, v.motivo_id, v.institucion_id, v.total_visitantes, vt.identidad, vt.tipo_identidad,
            v.empleado_id, ev.nombre as empleado, ev.departamento, ev.extension, ev.puesto, v.foto, i.nombre_institucion, m.descripcion as motivo_visita, v.hora_salida, ev.email');
            $this->from('visitas v');
            $this->join('visitantes vt', 'v.visitante_id = vt.id_visitante', 'left');
            $this->join('empleados_visitados ev', 'v.empleado_id = ev.codigo', 'left');
            $this->join('instituciones i', 'v.institucion_id = i.id_institucion', 'left');
            $this->join('motivos m', 'v.motivo_id = m.id_motivo', 'left');
            $this->where('v.status', 1);
            $this->groupBy('v.id_visita');
            $this->orderBy('v.fecha', 'DESC');
            $this->orderBy('v.hora_entrada', 'DESC');
           
            
             if ($id == 'TODOS') {
                $response = $this->findAll(); 
            } else {
                // Si se consulta un registro en concreto
                $this->where('v.id_visita', $id);
                $response = $this->first();
            }                
            return $response;
        }

        public function GetAllHistory($id='TODOS') {
            
         
            $this->select('v.id_visita, vt.nombres, vt.apellidos, vt.identidad, v.no_gafete, v.empleado_id, ev.nombre as empleado, v.visitante_id,
            v.fecha, v.hora_entrada, v.status, v.equipos, v.motivo_id, v.institucion_id, v.total_visitantes, vt.identidad, vt.tipo_identidad,
            v.empleado_id, ev.nombre as empleado, ev.departamento, ev.extension, ev.puesto, v.foto, i.nombre_institucion, m.descripcion as motivo_visita, v.hora_salida, ev.email');
            $this->from('visitas v');
            $this->join('visitantes vt', 'v.visitante_id = vt.id_visitante', 'left');
            $this->join('empleados_visitados ev', 'v.empleado_id = ev.codigo', 'left');
            $this->join('instituciones i', 'v.institucion_id = i.id_institucion', 'left');
            $this->join('motivos m', 'v.motivo_id = m.id_motivo', 'left');
            $this->where('v.status', 3);
            $this->groupBy('v.id_visita');
            $this->orderBy('v.fecha', 'DESC');
               
            
             if ($id == 'TODOS') {
                $response = $this->findAll(); 
            } else {
                // Si se consulta un registro en concreto
                $this->where('v.id_visita', $id);
                $response = $this->first();
            }                
            return $response;
        }

         public function getAllVisitasbyDate($fecha_desde, $fecha_hasta) {
            
         
            $this->select('v.id_visita, vt.nombres, vt.apellidos, vt.identidad, v.no_gafete, v.empleado_id, ev.nombre as empleado, v.visitante_id,
            v.fecha, v.hora_entrada, v.status, v.equipos, v.motivo_id, v.institucion_id, v.total_visitantes, vt.identidad, vt.tipo_identidad,
            v.empleado_id, ev.nombre as empleado, ev.departamento, ev.extension, ev.puesto, v.foto, i.nombre_institucion, m.descripcion as motivo_visita, v.hora_salida, ev.email');
            $this->from('visitas v');
            $this->join('visitantes vt', 'v.visitante_id = vt.id_visitante', 'left');
            $this->join('empleados_visitados ev', 'v.empleado_id = ev.codigo', 'left');
            $this->join('instituciones i', 'v.institucion_id = i.id_institucion', 'left');
            $this->join('motivos m', 'v.motivo_id = m.id_motivo', 'left');
            $this->where('v.status', 3);
            $this->groupBy('v.id_visita');
            $this->orderBy('v.fecha', 'DESC');
            $response = $this->where("v.fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'")->where('v.status', 3)->findAll();    
            return $response;
        }



         public function GetVisitasbyIDVisitante($id) {
            
         
            $this->select('v.id_visita, vt.nombres, vt.apellidos, vt.identidad, v.no_gafete, v.empleado_id, ev.nombre as empleado, v.visitante_id,
            v.fecha, v.hora_entrada, v.status, v.equipos, v.motivo_id, v.institucion_id, v.total_visitantes, vt.identidad, vt.tipo_identidad,
            v.empleado_id, ev.nombre as empleado, ev.departamento, ev.extension, ev.puesto, v.foto, i.nombre_institucion, m.descripcion as motivo_visita, v.hora_salida, ev.email');
            $this->from('visitas v');
            $this->join('visitantes vt', 'v.visitante_id = vt.id_visitante', 'left');
            $this->join('empleados_visitados ev', 'v.empleado_id = ev.codigo', 'left');
            $this->join('instituciones i', 'v.institucion_id = i.id_institucion', 'left');
            $this->join('motivos m', 'v.motivo_id = m.id_motivo', 'left');
            $this->where('v.status', 3);
            $this->groupBy('v.id_visita');
            $this->orderBy('v.fecha', 'DESC');
            $response = $this->where('v.visitante_id', $id)->findAll(); 
            return $response;
        }

      

      
    } //End Function
?>