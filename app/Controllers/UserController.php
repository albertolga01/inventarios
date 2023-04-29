<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;

class UserController extends Controller{

    public function index(){        
        
        $usuario = new Usuario();
        $data['usuarios'] = $usuario->orderBy('id','ASC')->findAll();        
        $data['pageTitle']= 'Usuario';
        return view('usuarios/usuario',$data);
    }

    public function insertUsuario(){
        $usuario = new Usuario();   
        
        $validacion = $this->validate([            
            'email'=>'required',
            'password' =>'required'            
        ]);
        if(!$validacion){
            
            $session = session();
            $session->setFlashdata('mensaje','Revisa la información');

            return redirect()->back()->withInput();
            //return $this->response->redirect(site_url('/usuario'));
        }
        
        if($email=$this->request->getVar('email')){
            $password = $this->request->getVar('password');
            $encrypter = \Config\Services::encrypter();
            $password = bin2hex($encrypter->encrypt($password));

            $data=[                
                'email'=> $this->request->getVar('email'),
                'password'=> $password                
            ];
            $usuario->insert($data);           
        }        
        return $this->response->redirect(base_url('/usuario'));
    }

    public function deleteUsuario($id=null){
        $usuario = new Usuario();
        $datosUsuario = $usuario->where('id',$id)->first();

        //DELETE DEL ELEMENTO EN BASE DE DATOS
       $usuario->where('id',$id)->delete($id);
            

        return $this->response->redirect(base_url('/usuario'));
    }

}
?>
