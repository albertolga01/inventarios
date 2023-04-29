<?php 
namespace App\Models;

use CodeIgniter\Model;

class Aceite extends Model{
    protected $table = 'aceites';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['producto','identificador','marca'];  
}