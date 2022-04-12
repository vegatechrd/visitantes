<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class VisitantesModel extends Model{

        protected $table      = 'visitantes';
        protected $primaryKey = 'id_visitante';
        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['nombres', 'apellidos','tipo_identidad', 'identidad', 'telefono', 'status'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = '';


        public function GetVisitanteById($id) {
            
          $response = $this->select('visitantes.*')->where('id_visitante', $id)->first();
         return $response;  

        }


        public function GetVisitanteByIdentidad($id) {
            
          $response = $this->select('visitantes.identidad')->where('identidad', $id)->first();
         return $response;  

        }

    } //End Function
?>