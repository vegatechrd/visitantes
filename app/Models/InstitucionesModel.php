<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class InstitucionesModel extends Model{

        protected $table      = 'instituciones';
        protected $primaryKey = 'id_institucion';
        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['nombre_institucion', 'telefono_institucion','status_institucion'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = '';

        

    }
?>