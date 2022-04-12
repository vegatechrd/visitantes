<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class EmpleadosVisitadosModel extends Model{

        protected $table      = 'empleados_visitados';
        protected $primaryKey = 'id_empleado_visitado';
        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['codigo','nombre', 'departamento','extension', 'puesto', 'email', 'status'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = '';


        public function VerificarEmpleadoVisitado($id) {
            
          $response = $this->select('empleados_visitados.codigo')->where('codigo', $id)->first();
         return $response;  

        }

       public function getDepartamentos() {

        $this->distinct();
        $this->select('departamento');
        $query = $this->findAll();
        return $query;
        }




    } //End Function
?>