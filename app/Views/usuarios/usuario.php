<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/guardarUsuario')?>" method="POST">
                    <div class="modal-body">
                 
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>            
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                        </div>
        
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('usuario')?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
            
                    <button type="button" class="btn btn-primary addUser" data-toggle="modal" data-target="#addadminprofile">
                        Add Admin Profile 
                    </button>
               
                </h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> ID </th>                                
                                <th>Email </th>                                                                                        
                                <th>DELETE </th>
                            </tr>
                        </thead>
                        <tbody>                                
                            <?php foreach($usuarios as $usuarios): ?>              
                            <tr>
                                <td><?= $usuarios['id']; ?></td>                                
                                <td><?= $usuarios['email'];?></td>                                                                                  
                                <td>         
                                    <button onclick="mensajeError('<?= base_url('delete/'.$usuarios['id']);?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-danger delete_btn"> DELETE</button>                       
                                </td>
                            </tr>   
                            <?php endforeach;?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script language= javascript type= text/javascript>
        function mensajeError(url){
            Swal.fire({
                title:'Desea Eliminar el perfil?',
                text:'El perfil se eliminara permanentemente!',
                icon:'warning',
                showCancelButton:true,
                cancelButtonColor: '#d33',
                confirmButtonText:'Si, Eliminar'
            }).then((result) =>{
                if(result.isConfirmed){
                    window.location.href = url;
                
                }
            });   
        }
    </script>

<?= 
    $this->endSection();
?>


