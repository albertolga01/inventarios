<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


   
    
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aceites 
                    <a href="<?= base_url('ventaAceites')?>">                           
                        <button type="button" class="btn btn-info addUser">
                            <i class="nav-icon 	fas fa-oil-can"></i>REPORTE 
                        </button>
                    </a>           
                    <a href="<?= base_url('ComprasAceite') ?>" >
                            <button type="button" class="btn btn-primary addUser" style="margin-right: 15px;">
                                <i class="nav-icon 	fas fa-oil-can"></i>COMPRAS/VENTAS 
                            </button>
                    </a>        

                    <button type="button" class="btn btn-success addUser" style="margin-right: 15px;" data-toggle="modal" data-target="#ModalAceites">
                        <i class="nav-icon 	fas fa-oil-can"></i> + AGREGAR 
                    </button>    

                 
               
                </h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaAceites" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> Producto </th>                                
                                <th>Identificador </th>                                                                                        
                                <th>Marca </th>
                                <th>Editar</th>
                                <th>Eliminar </th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php foreach($aceites as $aceites): ?>                                                                       
                            <tr>                                                                
                                <td><?= $aceites['producto'];?></td>
                                <td><?= $aceites['identificador'];?></td>  
                                <td><?= $aceites['marca'];?></td> 
                                <td><button type="button" class="btn btn-outline-info" 
                                                    onclick="editarAceite(<?=$aceites['id'];?>,'<?=$aceites['producto'];?>','<?=$aceites['identificador'];?>',
                                                                '<?=$aceites['marca'];?>')">                                        
                                                <i class="nav-icon fas fa-edit"></i> Editar
                                        </button> 
                                </td>                                       
                                <td> 
                                    <button onclick="mensajeBaja('<?= base_url('eliminarAceite/'.$aceites['id'])?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i> Eliminar</button>                                        
                                </td>                           
                                                                                                                                                                      
                            </tr>                           
                            <?php endforeach;?>                                             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL PARA AGREGAR ACEITES-->
    <div class="modal fade" id="ModalAceites" tabindex="-1" role="dialog" aria-labelledby="ModalAceites" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Aceite</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    
                <form action="<?= base_url('/guardarAceite')?>" method="POST">
                    <div class="modal-body">             
                        <div class="form-group">
                            <label>Nombre Producto</label>
                            <input type="text" name="producto" class="form-control" placeholder="Nombre Producto" maxlength="100" required>
                        </div>            
                        <div class="form-group">
                            <label>Identificador</label>
                            <input type="text" name="identificador" class="form-control" placeholder="identificador del produto" maxlength="20" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputMarca">Marca</label>
                                <select id="marca" class="form-control"  name="marca" required>
                                    <option selected value="BARDHAL">BARDHAL</option>
                                    <option value="QUAKER">QUAKER</option>                   
                                </select>                
                            </div>    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('aceites')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--MODAL PARA EDITAR ACEITES-->
    <div class="modal fade" id="ModalAceitesUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalAceitesUpdate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Aceite</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    
                <form action="<?= base_url('/editarAceite')?>" method="POST">
                    <div class="modal-body">     
                        <input type="hidden" name="id" id="idUpdate">        
                        <div class="form-group">
                            <label>Nombre Producto</label>
                            <input type="text" id="productoUpdate" name="producto" class="form-control" placeholder="Nombre Producto" maxlength="100" required>
                        </div>            
                        <div class="form-group">
                            <label>Identificador</label>
                            <input type="text" id="identificadorUpdate"  name="identificador" class="form-control" placeholder="identificador del produto" maxlength="20" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputMarca">Marca</label>
                                <select id="marcaUpdate" class="form-control"  name="marca" required>
                                    <option selected value="BARDHAL">BARDHAL</option>
                                    <option value="QUAKER">QUAKER</option>                   
                                </select>                
                            </div>    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('aceites')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
 

    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){        
            $("#tablaAceites").DataTable({
            columnDefs:[{
                targets: "_all"        
            }],
            });
        });


        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR el Aceite?',
                text:'Se eliminara el Aceite!',
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

    <script>
  


        function editarAceite($id,$producto,$identificador,$marca) {
            $('#idUpdate').val($id);
            $('#productoUpdate').val($producto);
            $('#identificadorUpdate').val($identificador);
            $('#marcaUpdate').val($marca).trigger('change');                  
            // Call Modal Edit
            $('#ModalAceitesUpdate').modal('show');
        }
    </script>




<?= 
    $this->endSection();
?>

