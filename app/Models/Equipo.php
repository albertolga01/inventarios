<?php 
namespace App\Models;

use CodeIgniter\Model;

class Equipo extends Model{
    protected $table = 'equipos';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['responsable','equipo','serie','marca','modelo','fechaAsignacion','departamento','observaciones','foto'];  
}