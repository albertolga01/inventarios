<?php 
namespace App\Models;

use CodeIgniter\Model;

class Estaciones extends Model{
    protected $table = 'estaciones';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['nombre'];  
}