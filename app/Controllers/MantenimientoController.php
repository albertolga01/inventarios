<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Mantenimiento;

use CodeIgniter\I18n\Time;


class MantenimientoController extends Controller{

    public function index(){            
        $mantenimiento = new Mantenimiento();                              
        $data['pageTitle']= 'Mantenimiento';      
        $data['mantenimiento'] = $mantenimiento->findAll();
        return view('mantenimiento/mantenimiento',$data);        
    }

    public function guardarMantenimiento(){
        $mantenimiento = new Mantenimiento(); 
        $fotoMantenimiento = $this->request->getFile('fotoMantenimiento');
        if($fotoMantenimiento->isValid()){ 
            $nuevoNombre= $fotoMantenimiento->getRandomName();
            $fotoMantenimiento->move(ROOTPATH.'public/uploads/Mantenimiento', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR   
    
            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'departamento'=> $this->request->getVar('departamento'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'serie'=> $this->request->getVar('serie'),
                'color' => $this->request->getVar('color'),
                'categoria' => $this->request->getVar('categoria'),                        
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),            
                'observaciones'=> $this->request->getVar('observaciones'),
                'descripcion'=> $this->request->getVar('descripcion'),
                'foto'=>$nuevoNombre
            ];

        }else{
            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'departamento'=> $this->request->getVar('departamento'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'serie'=> $this->request->getVar('serie'),
                'color' => $this->request->getVar('color'),
                'categoria' => $this->request->getVar('categoria'),                        
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),            
                'observaciones'=> $this->request->getVar('observaciones'),
                'descripcion'=> $this->request->getVar('descripcion')                
            ];

        }
    
        //print_r($datos);
        $mantenimiento->insert($datos);  
        return $this->response->redirect(base_url('/mantenimiento'));
    }

    public function editarMantenimiento(){        
        
        $mantenimiento = new Mantenimiento();  
        $id = $this->request->getVar('id');
        $fotoMantenimiento = $this->request->getFile('fotoMantenimiento');
        if($fotoMantenimiento->isValid()){
            //entra cuando se va cambiar la imagen
            $datosMantenimiento = $mantenimiento->where('id',$id)->first();  
            if($datosMantenimiento['foto'] == ""){

            }else{
                $ruta=(ROOTPATH.'public/uploads/Mantenimiento/'.$datosMantenimiento['foto']);                 
                unlink($ruta);
            }
            $fotoMantenimiento = $this->request->getFile('fotoMantenimiento');
            $nuevoNombre= $fotoMantenimiento->getRandomName();
            $fotoMantenimiento->move(ROOTPATH.'public/uploads/Mantenimiento', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR   
            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'departamento'=> $this->request->getVar('departamento'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'serie'=> $this->request->getVar('serie'),
                'color' => $this->request->getVar('color'),
                'categoria' => $this->request->getVar('categoria'),                        
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),            
                'observaciones'=> $this->request->getVar('observaciones'),
                'descripcion'=> $this->request->getVar('descripcion'),
                'foto'=>$nuevoNombre
            ];
            $mantenimiento->update($id,$datos);     
        }else{

            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'departamento'=> $this->request->getVar('departamento'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'serie'=> $this->request->getVar('serie'),
                'color' => $this->request->getVar('color'),
                'categoria' => $this->request->getVar('categoria'),                        
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),            
                'observaciones'=> $this->request->getVar('observaciones'),
                'descripcion'=> $this->request->getVar('descripcion')
            ];
            $mantenimiento->update($id,$datos);     
        }
     
        return $this->response->redirect(base_url('/mantenimiento'));
    }

    public function eliminarMantenimiento($id=null){
        $mantenimiento = new Mantenimiento(); 
        $datosMantenimiento = $mantenimiento->where('id',$id)->first();  
        if($datosMantenimiento['foto'] == ""){

        }else{
            $ruta=(ROOTPATH.'public/uploads/Mantenimiento/'.$datosMantenimiento['foto']);                 
            unlink($ruta);
        }
        $mantenimiento->where('id',$id)->delete($id);
        return $this->response->redirect(base_url('/mantenimiento'));
    }
 


}
?>
