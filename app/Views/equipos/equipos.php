<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


   
    
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Equipos            
                    <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalEquipos">
                        <i class="nav-icon 	fas fa-laptop"></i>   + AGREGAR 
                    </button>     
               
                </h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaEquipos" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>       
                                <th>Codigo</th>                         
                                <th>Responsable</th>   
                                <th>Departamento</th>                                                                                    
                                <th>Equipo </th>
                                <th>Marca</th>
                                <th>Modelo </th>
                                <th>Serie</th>
                                <th>Fecha Asignación</th>                               
                                <th>Observaciones</th>                                
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>                               
                            </tr>
                        </thead>
                        <tbody>   
                            <?php foreach($equipos as $equipos): ?>    
                                    <?php            
                                        $id=strlen($equipos['id']);
                                        if($id == 1){
                                            $idcompuesto = "00".$equipos['id'];
                                        }else{
                                            $idcompuesto = "0".$equipos['id'];
                                        }                      
                                        $codigo = $idcompuesto .substr($equipos['marca'],0,2) .substr($equipos['responsable'],0,3) .substr($equipos['serie'],0,4);
                                        $codigo = strtoupper($codigo);
                                    ?>      
                                                                                          
                                    <tr>                                                                
                                        <td><?= $equipos['id'];?></td>     
                                        <td><?= $codigo;?></td>                                     
                                        <td><?= $equipos['responsable'];?></td>
                                        <td><?= $equipos['departamento'];?></td>
                                        <td><?= $equipos['equipo'];?></td>                                           
                                        <td><?= $equipos['marca'];?></td>
                                        <td><?= $equipos['modelo'];?></td>  
                                        <td><?= $equipos['serie'];?></td>                               
                                        <td><?= $equipos['fechaAsignacion'];?></td>
                                        <td><?= $equipos['observaciones'];?></td>                                         
                                        <td><button type="button" class="btn btn-outline-info" 
                                                    onclick="editarEquipo(<?=$equipos['id'];?>,'<?=$equipos['responsable'];?>','<?=$equipos['equipo'];?>',
                                                                '<?=$equipos['serie'];?>','<?=$equipos['marca'];?>','<?=$equipos['modelo'];?>',
                                                                '<?=$equipos['fechaAsignacion'];?>','<?=$equipos['departamento'];?>','<?=$equipos['observaciones'];?>',
                                                                '<?=$equipos['foto'];?>'
                                                    )">
                                        
                                                <i class="nav-icon fas fa-edit"></i> Editar
                                            </button> 
                                        </td>                                                                    
                                        <td><button onclick="mensajeBaja('<?= base_url('eliminarEquipo/'.$equipos['id'])?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i>Eliminar</button></td>

                                    </tr>                           
                                <?php endforeach;?>                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <!--MODAL PARA AGREGAR EQUIPO-->
    <div class="modal fade" id="ModalEquipos" tabindex="-1" role="dialog" aria-labelledby="ModalEquipos" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Equipo <i class="nav-icon 	fas fa-laptop"></i> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/guardarEquipo')?>" method="POST" enctype="multipart/form-data">
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
                                <label>Equipo</label>
                                <select id="equipo" class="form-control"  name="equipo" required>
                                    <option selected value="Laptop">Laptop</option>
                                    <option value="Celular">Celular</option>  
                                    <option value="Tablet">Tablet</option>  
                                    <option value="Telefono fijo">Telefono fijo</option>  
                                    <option value="Computadora de escritorio">Computadora de escritorio</option>                   
                                    <option value="Impresora">Impresora</option>
                                    <option value="Proyector">Proyector</option>
                                    <option value="Pantalla">Pantalla</option> 
                                    <option value="Router">Router</option>                         
                                </select>  
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="output" width="100" height="100"/>
                                </div> 
                                <input type="file" name="fotoEquipo" style="margin-left: 10px;" id="fotoEquipo" onchange="loadFile(event)" >                          
                            </div>
                        </div>

          

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-4">
                                <label>Marca</label> 
                                <input type="text" class="form-control" name="marca" placeholder="Marca">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Modelo</label>  
                                <input type="text" class="form-control" name="modelo" placeholder="Modelo">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Serie</label> 
                                <input type="text" class="form-control" name="serie" placeholder="Serie">
                            </div>                                                                                                    
                        </div>                                                           

                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Fecha Asignación</label> 
                            <input type="date" class="form-control" id="fechaAsignacion" name="fechaAsignacion" placeholder="Fecha de Asignación"  required>                
                        </div> 
                       
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Observaciones</label>       
                            <textarea id="observaciones" name="observaciones" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                       
        
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('equipos')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--MODAL PARA EDITAR EQUIPO-->
    <div class="modal fade" id="ModalEquiposUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalEquiposUpdate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLabel">Actuliazar Equipo <i class="nav-icon 	fas fa-laptop"></i> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/editarEquipo')?>" method="POST" enctype="multipart/form-data">
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
                                <label>Equipo</label>
                                <select id="equipoUpdate" class="form-control"  name="equipo" required>
                                    <option selected value="Laptop">Laptop</option>
                                    <option value="Celular">Celular</option>  
                                    <option value="Tablet">Tablet</option>  
                                    <option value="Telefono fijo">Telefono fijo</option>  
                                    <option value="Computadora de escritorio">Computadora de escritorio</option>                   
                                    <option value="Impresora">Impresora</option>    
                                    <option value="Proyector">Proyector</option>
                                    <option value="Pantalla">Pantalla</option>  
                                    <option value="Router">Router</option>                               
                                </select> 
                               
                            </div>
                        </div>

                        
                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="outputUpdate" width="100" height="100" src=""  />
                                </div> 
                                <input type="file" name="fotoEquipo" style="margin-left: 10px;" id="fotoEquipoUpdate" onchange="loadFileUpdate(event)">                          
                            </div>
                        </div>

                  

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-4">
                                <label>Marca</label> 
                                <input type="text" class="form-control" name="marca" id="marcaUpdate" placeholder="Marca">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Modelo</label>  
                                <input type="text" class="form-control" name="modelo" id="modeloUpdate" placeholder="Modelo">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Serie</label> 
                                <input type="text" class="form-control" name="serie" id="serieUpdate" placeholder="Serie">
                            </div>                                                                                                    
                        </div>                                                           

                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Fecha Asignación</label> 
                            <input type="date" class="form-control" id="fechaAsignacionUpdate" name="fechaAsignacion" placeholder="Fecha de Asignación"  required>                
                        </div> 
                       
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Observaciones</label>       
                            <textarea id="observacionesUpdate" name="observaciones" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                       
        
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('equipos')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){        
            $("#tablaEquipos").DataTable({
            columnDefs:[{
                targets: "_all"        
            }],
            });
        });



        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR el Equipo?',
                text:'Se eliminara el Equipo!',
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
   


        function editarEquipo($id,$responsable,$equipo,$serie,$marca,$modelo,$fechaAsignacion,$departamento,$observaciones,$foto) {
            // Set data to Form Edit   
            $('#idUpdate').val($id);
            $('#responsableUpdate').val($responsable);  
            $('#equipoUpdate').val($equipo).trigger('change');  
            $('#serieUpdate').val($serie);
            $('#marcaUpdate').val($marca);
            $('#modeloUpdate').val($modelo);
            $('#fechaAsignacionUpdate').val($fechaAsignacion).trigger('change');
            $('#departamentoUpdate').val($departamento).trigger('change');            
            $('#observacionesUpdate').val($observaciones);            
            $src = '<?= base_url()?>/public/uploads/Equipos/'+$foto;            
            document.getElementById("outputUpdate").src=$src;            
            // Call Modal Edit,
            $('#ModalEquiposUpdate').modal('show');
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

