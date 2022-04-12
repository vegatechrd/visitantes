<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class MotivosModel extends Model{

        protected $table      = 'motivos';
        protected $primaryKey = 'id_motivo';
        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['descripcion', 'usuario_id','status'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = '';


    }
?>