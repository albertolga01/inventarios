<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Mobiliario;

use CodeIgniter\I18n\Time;


class MobiliarioController extends Controller{

    public function index(){            
        $mobiliario = new Mobiliario();                              
        $data['pageTitle']= 'Mobiliario';      
        $data['mobiliario'] = $mobiliario->findAll();
        return view('mobiliario/mobiliario',$data);        
    }

    public function guardarMobiliario(){
        $mobiliario = new Mobiliario();
        $cantidad = $this->request->getVar('cantidad');

        for($i=0;$i<$cantidad;$i++){      
            $fotoMobiliario = $this->request->getFile('fotoMobiliario');
            if($fotoMobiliario->isValid()){
                
                $nuevoNombre= $fotoMobiliario->getRandomName();
                $fotoMobiliario->move(ROOTPATH.'public/uploads/Mobiliario', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR 
                
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
                    'foto'=>$nuevoNombre,
                    'ubicacion'=> $this->request->getVar('ubicacion')
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
                    'descripcion'=> $this->request->getVar('descripcion'),
                    'ubicacion'=> $this->request->getVar('ubicacion')               
                ];
            }
    
            //print_r($datos);
            $mobiliario->insert($datos);        
        }
 
        return $this->response->redirect(base_url('/mobiliario'));
    }

    public function editarMobiliario(){        
        
        $mobiliario = new Mobiliario();
        $id = $this->request->getVar('id');
        $fotoMobiliario = $this->request->getFile('fotoMobiliario');

        if($fotoMobiliario->isValid()){
            //entra cuando se va cambiar la imagen
            $datosMobiliario = $mobiliario->where('id',$id)->first();  
            if($datosMobiliario['foto'] == ""){

            }else{
                $ruta=(ROOTPATH.'public/uploads/Mobiliario/'.$datosMobiliario['foto']);                 
                unlink($ruta);
            }
            $fotoMobiliario = $this->request->getFile('fotoMobiliario');
            $nuevoNombre= $fotoMobiliario->getRandomName();
            $fotoMobiliario->move(ROOTPATH.'public/uploads/Mobiliario', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR   
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
                'foto'=>$nuevoNombre,
                'ubicacion'=> $this->request->getVar('ubicacion')
            ];
            $mobiliario->update($id,$datos);   
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
                'descripcion'=> $this->request->getVar('descripcion'),
                'ubicacion'=> $this->request->getVar('ubicacion')
            ];
            $mobiliario->update($id,$datos);   
        }

           
        return $this->response->redirect(base_url('/mobiliario'));
    }

    public function eliminarMobiliario($id=null){
        $mobiliario = new Mobiliario();
        $datosMobiliario = $mobiliario->where('id',$id)->first();  
        if($datosMobiliario['foto'] == ""){

        }else{
            $ruta=(ROOTPATH.'public/uploads/Mobiliario/'.$datosMobiliario['foto']);                 
            unlink($ruta);
        }

        $mobiliario->where('id',$id)->delete($id);
        return $this->response->redirect(base_url('/mobiliario'));
    }
 


}
?>
