<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Equipo;

use CodeIgniter\I18n\Time;


class EquiposController extends Controller{

    public function index(){            
        $equipos = new Equipo();                              
        $data['pageTitle']= 'Equipos';      
        $data['equipos'] = $equipos->findAll();
        return view('equipos/equipos',$data);        
    }

    public function guardarEquipo(){
        $equipos = new Equipo();

        $fotoEquipo = $this->request->getFile('fotoEquipo');
        if($fotoEquipo->isValid()){
            $nuevoNombre= $fotoEquipo->getRandomName();
            $fotoEquipo->move(ROOTPATH.'public/uploads/Equipos', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR   
    
            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'equipo' => $this->request->getVar('equipo'),
                'serie'=> $this->request->getVar('serie'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),
                'departamento'=> $this->request->getVar('departamento'),
                'observaciones'=> $this->request->getVar('observaciones'),
                'foto'=>$nuevoNombre
            ];
            
        }else{
    
            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'equipo' => $this->request->getVar('equipo'),
                'serie'=> $this->request->getVar('serie'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),
                'departamento'=> $this->request->getVar('departamento'),
                'observaciones'=> $this->request->getVar('observaciones')                
            ];
        }

        //print_r($datos);
        $equipos->insert($datos);  
        return $this->response->redirect(base_url('/equipos'));
    }

    public function editarEquipo(){
        $equipos = new Equipo();
        $id = $this->request->getVar('id');
        $fotoEquipo = $this->request->getFile('fotoEquipo');

        if($fotoEquipo->isValid()){
            //entra cuando se va cambiar la imagen
            $datosEquipo = $equipos->where('id',$id)->first();  
            if($datosEquipo['foto'] == ""){

            }else{
                $ruta=(ROOTPATH.'public/uploads/Equipos/'.$datosEquipo['foto']);                 
                unlink($ruta);
            }

            $fotoEquipo = $this->request->getFile('fotoEquipo');
            $nuevoNombre= $fotoEquipo->getRandomName();
            $fotoEquipo->move(ROOTPATH.'public/uploads/Equipos', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR   

            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'equipo' => $this->request->getVar('equipo'),
                'serie'=> $this->request->getVar('serie'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),
                'departamento'=> $this->request->getVar('departamento'),
                'observaciones'=> $this->request->getVar('observaciones'),
                'foto'=> $nuevoNombre
            ];
            $equipos->update($id,$datos);  
           
        }else{
            $datos=[  
                'responsable'=> $this->request->getVar('responsable'),
                'equipo' => $this->request->getVar('equipo'),
                'serie'=> $this->request->getVar('serie'),
                'marca'=> $this->request->getVar('marca'),
                'modelo'=> $this->request->getVar('modelo'),
                'fechaAsignacion'=> $this->request->getVar('fechaAsignacion'),
                'departamento'=> $this->request->getVar('departamento'),
                'observaciones'=> $this->request->getVar('observaciones')                
            ];
            $equipos->update($id,$datos);  

        }
        
               
        return $this->response->redirect(base_url('/equipos'));
    }

    public function eliminarEquipo($id=null){
        $equipos = new Equipo();
        $datosEquipo = $equipos->where('id',$id)->first();  
        if($datosEquipo['foto'] == ""){

        }else{
            $ruta=(ROOTPATH.'public/uploads/Equipos/'.$datosEquipo['foto']);                 
            unlink($ruta);
        }

        $equipos->where('id',$id)->delete($id);
        return $this->response->redirect(base_url('/equipos'));
    }
 


}
?>
