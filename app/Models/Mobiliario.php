<?php 
namespace App\Models;

use CodeIgniter\Model;

class Mobiliario extends Model{
    protected $table = 'mobiliario';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['responsable','departamento','marca','modelo','serie','color','categoria','fechaAsignacion','observaciones','descripcion','foto','ubicacion'];  
}