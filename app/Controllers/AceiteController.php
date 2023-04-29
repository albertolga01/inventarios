<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Aceite;

use App\Models\Estaciones;
use App\Models\StockAceite;
use App\Models\HistorialAceites;

use App\Models\HistorialCompraVenta;

use CodeIgniter\I18n\Time;


class AceiteController extends Controller{

    public function index(){            
        $aceites = new Aceite();                              
        $data['pageTitle']= 'Aceite';      
        $data['aceites'] = $aceites->findAll();        
        return view('aceites/aceites',$data);        
    }

    public function guardarAceite(){
        $aceites = new Aceite();
        $estaciones = new Estaciones();
        $stockaceite = new StockAceite();

        $datos=[  
            'producto'=> $this->request->getVar('producto'),
            'identificador' => $this->request->getVar('identificador'),
            'marca'=> $this->request->getVar('marca')        
        ];

        $aceites->insert($datos); 
        $data['aceites'] = $aceites->selectMax('id')->orderBy('id', 'DESC')->findAll();           
        $data['estaciones']= $estaciones->select('id')->findAll(); 
        $cantidad = 0;
        foreach($data['estaciones'] as $estaciones):
            $datos=[
                'id_estacion' => $estaciones['id'],
                'id_aceite' => $data['aceites']['0']['id'],
                'cantidad'=> $cantidad
            ];
            $stockaceite->insert($datos);
        endforeach;   
        return $this->response->redirect(base_url('/aceites'));
    }

    
    public function editarAceite(){
        $aceites = new Aceite();
        $id = $this->request->getVar('id');
        $datos=[  
            'producto'=> $this->request->getVar('producto'),
            'identificador' => $this->request->getVar('identificador'),
            'marca'=> $this->request->getVar('marca')        
        ];
        
        $aceites->update($id,$datos);
        return $this->response->redirect(base_url('/aceites'));
    }

    public function eliminarAceite($id=null){
        $aceites = new Aceite();
        $aceites->where('id',$id)->delete($id);
        return $this->response->redirect(base_url('/aceites'));
    }

    public function ventaAceites(){
        $estaciones = new Estaciones();
        $data['estaciones'] = $estaciones->findAll();        
        return view('aceites/reporteVentaAceites',$data);                       
    }

    public function guardarVentaAceite(){
        $aceites = new Aceite(); 
        $historial = new HistorialAceites(); 
        $stockaceite = new StockAceite();
        $dias = $_POST['dias'];
        $fecha = $_POST['fecha'];
        $fechaFinal = date( "Y-m-d", strtotime( "$fecha +".$dias." day" )); 
        $estaciones = new Estaciones();
        $data['estaciones'] = $estaciones->findAll();    
        $fecha1 = date( "Y-m-d", strtotime( "$fecha -7 day" ) );
        $a = $this->queryT($fecha, $dias); 
 
        $sql = "SELECT
        producto,
        ".$a."
        COUNT(folio) AS TOTAL
        FROM venta
        WHERE fecha >= '".$fecha."' 
        AND fecha  < '".$fechaFinal."'
        AND id_estacion = '".$_POST['estacion']."'
        AND producto != 'Pemex Magna'
        AND producto != 'Pemex Premium'
        AND producto != 'Pemex Diesel'
        GROUP BY producto
      ";
   

      $db2 = \Config\Database::connect('preciosBD');
      $query1 = $db2->query($sql); 
        
       
        $data["venta"] = $query1->getResultArray(); 

        $array = $data["venta"]; 
 /*
            $out = array();
            foreach ($data["venta"] as $row) {
                foreach ($row as $i => $val) {
                    $out[$i] = isset($out[$i]) && is_numeric($out[$i]) ? $out[$i] + $val : $val;
                }
            } 
            $remove = array_shift($out);
        $data['totales'] = $out;  

        array_unshift($array, null);
        $array = call_user_func_array('array_map', $array);
        $array = array_map('array_reverse', $array);
        var_dump($array);
        foreach($array as $r){
            if(is_numeric($r))

        }
         */
        $data['aceites'] = $aceites->select('*')->orderBy('id', 'ASC')->findAll();  
                 


        //Ultimo inventario registrado (1)
        $sql = "SELECT folio, id_producto, cantidad, dispensario_1, dispensario_2, bodega, id_aceite, producto, stock, DATE_FORMAT(fecha,'%d/%m/%Y') as fecha  FROM historial_compra_venta t1 inner join aceites t2 on t1.id_aceite = t2.id  WHERE tipo = '1' and id_estacion = '".$_POST['estacion']."' and  folio IN (SELECT MAX(folio) FROM historial_compra_venta where fecha < '".$fecha."' and tipo = '1'  GROUP BY id_producto)  ";
        $query = $aceites->query($sql); 
         
       
        $data["inventarioFisico"] = $query->getResultArray(); 
        //Compras de la ultima semana (0)
        $sql = "SELECT folio, id_producto, cantidad, dispensario_1, dispensario_2, bodega, id_aceite, producto FROM historial_compra_venta t1 inner join aceites t2 on t1.id_aceite = t2.id  WHERE tipo = '0' and id_estacion = '".$_POST['estacion']."' and  folio IN (SELECT MAX(folio) FROM historial_compra_venta where fecha < '".$fecha."' and fecha >= '".$fecha1."' and tipo = '0' GROUP BY id_producto)  ";
        $query = $aceites->query($sql);  

        $data["ultimasCompras"] = $query->getResultArray(); 
        $data["fechaInicial"] = $fecha; 
        $data["fechaFinal"] = date('Y-m-d', strtotime("$fecha +".$dias." day" )); 
       

        $b = $this->fechasArray($fecha, date('Y-m-d', strtotime("$fecha +".$dias." day" )));
        $data["fechasArray"] = $b; 
        $data["fechasArrayReversed"] = array_reverse($b); 
          
            return view('aceites/reporteVentaAceites', $data); 
        
    }

    public function fechasArray($startDate, $endDate){
        $rangArray = [];
 
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        $i = 0;
        for ($currentDate = $startDate; $currentDate < $endDate; $currentDate += (86400)) {
            $date = date('Y-m-d', $currentDate);
            $rangArray[$i]["fecha"] = $date;

            switch (date('D', strtotime($date))) {
                case "Mon":
                    $d = "L";
                    break;
                case "Tue":
                    $d = "M";
                    break;
                case "Wed":
                    $d = "MM";
                    break;
                case "Thu":
                    $d = "J";
                    break;
                case "Fri":
                    $d = "V";
                    break;
                case "Sat":
                    $d = "S";
                    break;
                case "Sun":
                    $d = "D";
                    break;
            }

            
            //$rangArray[$i]["dia"] = date('D', strtotime($date)); 
            $rangArray[$i]["dia"] = $d; 
            $rangArray[$i]["dian"] = date('d', strtotime($date)); 
            $i++;
        }
     
        return $rangArray;
    }

    public function queryT($fecha, $dias){
        $res = "";
        //echo $fecha;
        for($i = 0;$i<$dias;$i++){
            $dayofweek = date('w', strtotime($fecha));
            $day = date('d', strtotime($fecha));
            if($dayofweek == 0){
                $res = $res." COUNT(CASE WHEN WEEKDAY(fecha)=0 THEN fecha END) AS '".$day."',";
            }else if($dayofweek == 1){
                $res = $res." COUNT(CASE WHEN WEEKDAY(fecha)=1 THEN fecha END) AS '".$day."',";
            }else if($dayofweek == 2){
                $res = $res." COUNT(CASE WHEN WEEKDAY(fecha)=2 THEN fecha END) AS '".$day."',";
            }else if($dayofweek == 3){
                $res = $res." COUNT(CASE WHEN WEEKDAY(fecha)=3 THEN fecha END) AS '".$day."',";
            }else if($dayofweek == 4){
                $res = $res." COUNT(CASE WHEN WEEKDAY(fecha)=4 THEN fecha END) AS '".$day."',";
            }else if($dayofweek == 5){
                $res = $res." COUNT(CASE WHEN WEEKDAY(fecha)=5 THEN fecha END) AS '".$day."',";
            }else if($dayofweek == 6){
                $res = $res." COUNT(CASE WHEN WEEKDAY(fecha)=6 THEN fecha END) AS '".$day."',";    
            }
            
            $fecha = date( "Y-m-d", strtotime( "$fecha +1 day" ) );
            //$fecha = $fecha;//+1
        }

        return $res;
    }


    public function ComprasAceite(){
        $stockaceite = new StockAceite();
        $estaciones = new Estaciones();                            
        $data['pageTitle']= 'Compra Aceite';      
        $data['stockaceite'] = $stockaceite->select('stock_aceites.*,aceites.producto')->join('aceites','aceites.id = stock_aceites.id_aceite')->findAll();
        $data['estaciones'] = $estaciones->findAll();      
        return view('aceites/compraAceites',$data); 
    }

    public function guardarComprasAceite(){
        $stockaceite = new StockAceite();
        $historialcompraventa = new HistorialCompraVenta();

        $data['stockaceite'] = $stockaceite->select('stock_aceites.*,aceites.producto')->join('aceites','aceites.id = stock_aceites.id_aceite')->where('stock_aceites.id_estacion',$_POST['estacion'])->findAll();
        //print_r($data['stockaceite']);
        $arreglo=sizeof($_POST['producto']); 
        $estacion = $_POST['estacion'][$i];        
        $hoy = $_POST['fecha'];
        
        $usuario =$_POST['Username'];   

        for($i = 0;$i<$arreglo;$i++){            
            if($data['stockaceite'][$i]['id'] == $_POST['id'][$i]){            
                if($data['stockaceite'][$i]['cantidad'] < $_POST['cantidad'][$i]){
                    //ES COMPRA   TIPO 0 
                    echo "Compra";     
                    $cantidadNueva = $_POST['cantidad'][$i] -$data['stockaceite'][$i]['cantidad'];                   
                    $tipo = 0;
                    $datosHistorial=[
                        'id_producto' =>$_POST['id'][$i],
                        'id_estacion'=> $estacion,
                        'stock' => $data['stockaceite'][$i]['cantidad'],
                        'cantidad' => $cantidadNueva,
                        'fecha' => $hoy,
                        'id_usuario'=>$usuario,
                        'tipo'=> $tipo,
                        'dispensario_1'=> $_POST['dispensario1'][$i],
                        'dispensario_2'=> $_POST['dispensario2'][$i],
                        'bodega'=> $_POST['bodega'][$i],
                        'id_aceite'=> $_POST['id_aceite'][$i]
                    ];    
                    $historialcompraventa->insert($datosHistorial);
               // }else if($data['stockaceite'][$i]['cantidad'] > $_POST['cantidad'][$i]){
                }else {
                    //ES VENTA   TIPO 1 //INVENTARIO
                    $cantidadNueva = $data['stockaceite'][$i]['cantidad'] - $_POST['cantidad'][$i];                   
                    $tipo = 1;
                    $datosHistorial=[
                        'id_producto' =>$_POST['id'][$i],
                        'id_estacion'=> $estacion,
                        'stock' => $data['stockaceite'][$i]['cantidad'],
                        'cantidad' => $cantidadNueva,
                        'fecha' => $hoy,
                        'id_usuario'=>$usuario,
                        'tipo'=> $tipo,
                        'dispensario_1'=> $_POST['dispensario1'][$i],
                        'dispensario_2'=> $_POST['dispensario2'][$i],
                        'bodega'=> $_POST['bodega'][$i],
                        'id_aceite'=> $_POST['id_aceite'][$i]
                    ];           
                    $historialcompraventa->insert($datosHistorial);                          
                }
            }

            $datos=[
                'cantidad' => $_POST['cantidad'][$i],
                'dispensario_1' => $_POST['dispensario1'][$i],
                'dispensario_2' => $_POST['dispensario2'][$i],
                'bodega' => $_POST['bodega'][$i]

            ];
            $id = $_POST['id'][$i];
            $stockaceite->update($id,$datos);
           
        }
        return $this->response->redirect(base_url('/ComprasAceite'));
        
   
    }


}
?>
