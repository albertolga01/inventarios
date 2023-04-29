<?php 
namespace App\Models;

use CodeIgniter\Model;

class StockAceite extends Model{
    protected $table = 'stock_aceites';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['id_estacion','id_aceite','cantidad','dispensario_1','dispensario_2','bodega'];  
}