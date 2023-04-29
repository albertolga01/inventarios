<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


   
    
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mantenimiento            
                    <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalMantenimiento">
                        <i class="nav-icon fas fa-broom"></i>     + AGREGAR 
                    </button>     
               
                </h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaMantenimiento" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>       
                                <th>Codigo</th>                         
                                <th>Responsable</th>   
                                <th>Departamento</th>                                                                                    
                                <th>Marca </th>
                                <th>Modelo</th>
                                <th>Serie </th>
                                <th>Color</th>
                                <th>Categoria</th>                                
                                <th>Fecha Asignación</th>    
                                <th>Descripcion</th> 
                                <th>Observaciones</th>                            
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>                               
                            </tr>
                        </thead>
                        <tbody>   
                            <?php foreach($mantenimiento as $mantenimiento): ?>    
                                <?php            
                                    $id=strlen($mantenimiento['id']);
                                    if($id == 1){
                                        $idcompuesto = "00".$mantenimiento['id'];
                                    }else{
                                        $idcompuesto = "0".$mantenimiento['id'];
                                    }                      
                                    $codigo = $idcompuesto .substr($mantenimiento['marca'],0,2) .substr($mantenimiento['responsable'],0,3) .substr($mantenimiento['serie'],0,4);
                                    $codigo = strtoupper($codigo);
                                ?>      
                                                                                          
                                    <tr>                                                                
                                        <td><?= $mantenimiento['id'];?></td>     
                                        <td><?= $codigo;?></td>                                     
                                        <td><?= $mantenimiento['responsable'];?></td>
                                        <td><?= $mantenimiento['departamento'];?></td>
                                        <td><?= $mantenimiento['marca'];?></td>
                                        <td><?= $mantenimiento['modelo'];?></td> 
                                        <td><?= $mantenimiento['serie'];?></td>
                                        <td><?= $mantenimiento['color'];?></td>                                       
                                        <td><?= $mantenimiento['categoria'];?></td>  
                                        <td><?= $mantenimiento['fechaAsignacion'];?></td>                                                                                                              
                                        <td><?= $mantenimiento['descripcion'];?></td>                                        
                                        <td><?= $mantenimiento['observaciones'];?></td>                                         
                                        <td><button type="button" class="btn btn-outline-info" 
                                                    onclick="editarMantenimiento(<?=$mantenimiento['id'];?>,'<?=$mantenimiento['responsable'];?>','<?=$mantenimiento['departamento'];?>',
                                                                '<?=$mantenimiento['marca'];?>','<?=$mantenimiento['modelo'];?>','<?=$mantenimiento['serie'];?>',
                                                                '<?=$mantenimiento['color'];?>','<?=$mantenimiento['categoria'];?>','<?=$mantenimiento['fechaAsignacion'];?>'
                                                                ,'<?=$mantenimiento['observaciones'];?>','<?=$mantenimiento['descripcion'];?>'
                                                                ,'<?=$mantenimiento['foto'];?>'
                                                    )">
                                        
                                                <i class="nav-icon fas fa-edit"></i> Editar
                                            </button> 
                                        </td>                                                                    
                                        <td><button onclick="mensajeBaja('<?= base_url('eliminarMantenimiento/'.$mantenimiento['id'])?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i>Eliminar</button></td>

                                    </tr>                           
                                <?php endforeach;?>  
                                                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <!--MODAL PARA AGREGAR MANTENIMIENTO-->
    <div class="modal fade" id="ModalMantenimiento" tabindex="-1" role="dialog" aria-labelledby="ModalMantenimiento" aria-hidden="true" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Mantenimiento <i class="nav-icon fas fa-broom"></i>  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/guardarMantenimiento')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                 
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Responsable</label>
                            <input type="text" class="form-control" name="responsable" id="responsable" placeholder="Responsable" maxlength="100" required>                           
                        </div> 

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6">
                                <label>Departamento</label> 
                                <select id="departamento" class="form-control"  name="departamento" required>
                                    <option selected value="Administrativo">Administrativo</option>
                                    <option value="Competro">Competro</option>
                                    <option value="Contabilidad">Contabilidad </option>
                                    <option value="Gas Unión">Gas Unión</option>
                                    <option value="Insurgentes">Insurgentes </option>
                                    <option value="La Caja">La Caja </option>
                                    <option value="Ley del Mar">Ley del Mar</option>
                                    <option value="Libramiento">Libramiento</option> 
                                    <option value="Logística">Logística </option>
                                    <option value="López Sáenz">López Sáenz </option>
                                    <option value="Múnich">Múnich</option>
                                    <option value="Operaciones">Operaciones </option>
                                    <option value="Recursos Humanos">Recursos Humanos </option>
                                    <option  value="Rio Presidio">Rio Presidio</option>
                                    <option value="Santa Fe">Santa Fe </option>
                                    <option value="Sistemas y Desarrollo">Sistemas y Desarrollo</option>
                                </select>   
                               
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Categorias</label>    
                                <select id="categoria" class="form-control"  name="categoria" required>
                                    <option selected value="Andamios">Andamios</option>
                                    <option  value="Escaleras">Escaleras</option>
                                    <option  value="Desarmadores">Desarmadores</option>  
                                    <option  value="Pinzas">Pinzas</option>
                                    <option  value="Arnes">Arnes</option>
                                    <option  value="Caja de Herramientas">Caja de Herramientas</option>                                                                
                                    <option  value="Porta Herramientas">Porta Herramientas</option> 
                                    <option  value="Herramientas Jardin">Herramientas Jardin</option>
                                    <option  value="Equipos Electricos">Equipos Electricos</option>
                                    <option  value="Equipos inalambricos">Equipos inalambricos</option>
                                    <option  value="Equipo Albañileria">Equipo Albañileria</option>
                                </select>                              
                                                     
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="output" width="100" height="100"/>
                                </div> 
                                <input type="file" name="fotoMantenimiento" style="margin-left: 10px;" id="fotoMantenimiento" onchange="loadFile(event)">                          
                            </div>
                        </div>




                                                          
                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6">
                                <label>Marca</label> 
                                <input type="text" class="form-control" name="marca" placeholder="Marca">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Modelo</label>  
                                <input type="text" class="form-control" name="modelo" placeholder="Modelo">
                            </div>
                                                                                                                         
                        </div>     
                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6">
                                <label>Serie</label> 
                                <input type="text" class="form-control" name="serie" placeholder="Serie">
                            </div>    
                            <div class="form-group col-md-6">
                                <label>Color</label> 
                                <input type="text" class="form-control" name="color" placeholder="Color">
                            </div>
                                                                                                             
                        </div>                                                        

                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Fecha Asignación</label> 
                            <input type="date" class="form-control" id="fechaAsignacion" name="fechaAsignacion" placeholder="Fecha de Asignación"  required>                
                        </div> 
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Descripción</label>       
                            <textarea id="descripcion" name="descripcion" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Observaciones</label>       
                            <textarea id="observaciones" name="observaciones" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                       
        
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('mantenimiento')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--MODAL PARA EDITAR MANTENIMIENTO-->
    <div class="modal fade" id="ModalMantenimientoUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalMantenimientoUpdate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLabel">Actuliazar Mantenimiento <i class="nav-icon fas fa-broom"></i>    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/editarMantenimiento')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                 
                        <input type="hidden" name="id" id="idUpdate">

                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Responsable</label>
                            <input type="text" class="form-control" name="responsable" id="responsableUpdate" placeholder="Responsable" maxlength="100" required>                         
                        </div> 

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6">
                                <label>Departamento</label> 
                                <select id="departamentoUpdate" class="form-control" name="departamento" required="">
                                    <option selected value="Administrativo">Administrativo</option>
                                    <option value="Competro">Competro</option>
                                    <option value="Contabilidad">Contabilidad </option>
                                    <option value="Gas Unión">Gas Unión</option>
                                    <option value="Insurgentes">Insurgentes </option>
                                    <option value="La Caja">La Caja </option>
                                    <option value="Ley del Mar">Ley del Mar</option>
                                    <option value="Libramiento">Libramiento</option> 
                                    <option value="Logística">Logística </option>
                                    <option value="López Sáenz">López Sáenz </option>
                                    <option value="Múnich">Múnich</option>
                                    <option value="Operaciones">Operaciones </option>
                                    <option value="Recursos Humanos">Recursos Humanos </option>
                                    <option  value="Rio Presidio">Rio Presidio</option>
                                    <option value="Santa Fe">Santa Fe </option>
                                    <option value="Sistemas y Desarrollo">Sistemas y Desarrollo</option>
                                </select>   
                               
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Categorias</label>    
                                <select id="categoriaUpdate" class="form-control"  name="categoria" required>
                                    <option selected value="Andamios">Andamios</option>
                                    <option  value="Escaleras">Escaleras</option>
                                    <option  value="Desarmadores">Desarmadores</option>  
                                    <option  value="Pinzas">Pinzas</option>
                                    <option  value="Arnes">Arnes</option>
                                    <option  value="Caja de Herramientas">Caja de Herramientas</option>                                                                
                                    <option  value="Porta Herramientas">Porta Herramientas</option> 
                                    <option  value="Herramientas Jardin">Herramientas Jardin</option>
                                    <option  value="Equipos Electricos">Equipos Electricos</option>
                                    <option  value="Equipos inalambricos">Equipos inalambricos</option>
                                    <option  value="Equipo Albañileria">Equipo Albañileria</option>
                                </select>                              
                                                     
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="outputUpdate" width="100" height="100"/>
                                </div> 
                                <input type="file" name="fotoMantenimiento" style="margin-left: 10px;" id="fotoMantenimientoUpdate" onchange="loadFileUpdate(event)">                          
                            </div>
                        </div>

                                     

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6">
                                <label>Marca</label> 
                                <input type="text" class="form-control" name="marca" id="marcaUpdate" placeholder="Marca">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Modelo</label>  
                                <input type="text" class="form-control" name="modelo" id="modeloUpdate" placeholder="Modelo">
                            </div>
                                                                                                                           
                        </div>    
                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6">
                                <label>Serie</label> 
                                <input type="text" class="form-control" name="serie" id="serieUpdate" placeholder="Serie">
                            </div>  
                            <div class="form-group col-md-6">
                                <label>Color</label> 
                                <input type="text" class="form-control" name="color" id="colorUpdate" placeholder="Color">
                            </div>
                 
                                                                                                                          
                        </div>                                                        

                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Fecha Asignación</label> 
                            <input type="date" class="form-control" id="fechaAsignacionUpdate" name="fechaAsignacion" placeholder="Fecha de Asignación"  required>                
                        </div> 
                             
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Descripción</label>       
                            <textarea id="descripcionUpdate" name="descripcion" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                       
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Observaciones</label>       
                            <textarea id="observacionesUpdate" name="observaciones" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                       
        
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('mantenimiento')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){        
            $("#tablaMantenimiento").DataTable({
            columnDefs:[{
                targets: "_all"        
            }],
            });
        });



        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR el Objeto?',
                text:'Se eliminara el Objeto!',
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
   


        function editarMantenimiento($id,$responsable,$departamento,$marca,$modelo,$serie,$color,$categoria,$fechaAsignacion,$observaciones,$descripcion,$foto) {
            // Set data to Form Edit   
            $('#idUpdate').val($id);
            $('#responsableUpdate').val($responsable); 
            $('#departamentoUpdate').val($departamento).trigger('change');                          
            $('#marcaUpdate').val($marca);
            $('#modeloUpdate').val($modelo);
            $('#serieUpdate').val($serie);
            $('#colorUpdate').val($color);
            $('#categoriaUpdate').val($categoria);
            $('#fechaAsignacionUpdate').val($fechaAsignacion).trigger('change');                      
            $('#observacionesUpdate').val($observaciones);
            $('#descripcionUpdate').val($descripcion);
            $src = '<?= base_url()?>/public/uploads/Mantenimiento/'+$foto;            
            document.getElementById("outputUpdate").src=$src;   
            // Call Modal Edit
            $('#ModalMantenimientoUpdate').modal('show');
        }

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        var loadFileUpdate = function(event) {
            var output = document.getElementById('outputUpdate');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>


<?= 
    $this->endSection();
?>

