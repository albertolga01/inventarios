<?php 
namespace App\Models;

use CodeIgniter\Model;

class HistorialAceites extends Model{
    protected $table = 'historial_compra_venta';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'folio';
       protected $allowedFields =['folio','id_producto','id_estacion', 'stock', 'cantidad', 'fecha', 'fechacaptura', 'id_usuario', 'tipo'];  
}