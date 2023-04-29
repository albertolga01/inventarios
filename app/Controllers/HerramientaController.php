<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Herramienta;

use CodeIgniter\I18n\Time;


class HerramientaController extends Controller{

    public function index(){            
        $herramienta = new Herramienta();                              
        $data['pageTitle']= 'Herramientas';      
        $data['herramienta'] = $herramienta->findAll();
        return view('herramienta/herramienta',$data);        
    }

    public function guardarHerramienta(){
        $herramienta = new Herramienta(); 
        $fotoHerramienta = $this->request->getFile('fotoHerramienta');
        if($fotoHerramienta->isValid()){
            $nuevoNombre= $fotoHerramienta->getRandomName();
            $fotoHerramienta->move(ROOTPATH.'public/uploads/Herramientas', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR   
    
    
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

        
        $herramienta->insert($datos);  
        return $this->response->redirect(base_url('/herramienta'));
    }

    public function editarHerramienta(){        
        
        $herramienta = new Herramienta(); 
        $id = $this->request->getVar('id');
        $fotoHerramienta = $this->request->getFile('fotoHerramienta');
        if($fotoHerramienta->isValid()){
            //entra cuando se va cambiar la imagen
            $datosHerramienta = $herramienta->where('id',$id)->first();  
            if($datosHerramienta['foto'] == ""){

            }else{
                $ruta=(ROOTPATH.'public/uploads/Herramientas/'.$datosHerramienta['foto']);                 
                unlink($ruta);
            }
            $fotoHerramienta = $this->request->getFile('fotoHerramienta');
            $nuevoNombre= $fotoHerramienta->getRandomName();
            $fotoHerramienta->move(ROOTPATH.'public/uploads/Herramientas', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR   
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
            $herramienta->update($id,$datos); 
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
            $herramienta->update($id,$datos); 
        }


              
        return $this->response->redirect(base_url('/herramienta'));
    }

    public function eliminarHerramienta($id=null){
        $herramienta = new Herramienta(); 
        $datosHerramienta = $herramienta->where('id',$id)->first();  
        if($datosHerramienta['foto'] == ""){

        }else{
            $ruta=(ROOTPATH.'public/uploads/Herramientas/'.$datosHerramienta['foto']);                 
            unlink($ruta);
        }
        $herramienta->where('id',$id)->delete($id);
        return $this->response->redirect(base_url('/herramienta'));
    }
 


}
?>
