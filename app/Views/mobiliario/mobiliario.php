<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


   
    
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mobiliario            
                    <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalMobiliario">
                        <i class="nav-icon 	fas fa-couch"></i>     + AGREGAR 
                    </button>     
               
                </h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaMobiliario" width="100%" cellspacing="0">
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
                            <?php foreach($mobiliario as $mobiliario): ?>    
                                <?php            
                                    $id=strlen($mobiliario['id']);
                                    if($id == 1){
                                        $idcompuesto = "00".$mobiliario['id'];
                                    }else{
                                        $idcompuesto = "0".$mobiliario['id'];
                                    }                      
                                    $codigo = $idcompuesto .substr($mobiliario['marca'],0,2) .substr($mobiliario['responsable'],0,3) .substr($mobiliario['serie'],0,4);
                                    $codigo = strtoupper($codigo);
                                ?>      
                                                                                          
                                    <tr>                                                                
                                        <td><?= $mobiliario['id'];?></td>     
                                        <td><?= $codigo;?></td>                                     
                                        <td><?= $mobiliario['responsable'];?></td>
                                        <td><?= $mobiliario['departamento'];?></td>
                                        <td><?= $mobiliario['marca'];?></td>
                                        <td><?= $mobiliario['modelo'];?></td> 
                                        <td><?= $mobiliario['serie'];?></td>
                                        <td><?= $mobiliario['color'];?></td>                                       
                                        <td><?= $mobiliario['categoria'];?></td>                                                                                                                
                                        <td><?= $mobiliario['fechaAsignacion'];?></td>
                                        <td><?= $mobiliario['descripcion'];?></td>
                                        <td><?= $mobiliario['observaciones'];?></td>                                         
                                        <td><button type="button" class="btn btn-outline-info" 
                                                    onclick="editarMobiliario(<?=$mobiliario['id'];?>,'<?=$mobiliario['responsable'];?>','<?=$mobiliario['departamento'];?>',
                                                                '<?=$mobiliario['marca'];?>','<?=$mobiliario['modelo'];?>','<?=$mobiliario['serie'];?>',
                                                                '<?=$mobiliario['color'];?>','<?=$mobiliario['categoria'];?>','<?=$mobiliario['fechaAsignacion'];?>'
                                                                ,'<?=$mobiliario['observaciones'];?>','<?=$mobiliario['descripcion'];?>'
                                                                ,'<?=$mobiliario['foto'];?>','<?=$mobiliario['ubicacion'];?>'
                                                    )">
                                        
                                                <i class="nav-icon fas fa-edit"></i> Editar
                                            </button> 
                                        </td>                                                                    
                                        <td><button onclick="mensajeBaja('<?= base_url('eliminarMobiliario/'.$mobiliario['id'])?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i>Eliminar</button></td>

                                    </tr>                           
                                <?php endforeach;?>  
                                                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <!--MODAL PARA AGREGAR Mobiliario-->
    <div class="modal fade" id="ModalMobiliario" tabindex="-1" role="dialog" aria-labelledby="ModalMobiliario" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Mobiliario <i class="nav-icon 	fas fa-couch"></i> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/guardarMobiliario')?>" method="POST" enctype="multipart/form-data">
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
                                <select id="categorias" class="form-control"  name="categoria" required>
                                    <option selected value="Escritorio">Escritorio</option>
                                    <option  value="Archivero">Archivero</option>
                                    <option  value="Gabinete">Gabinete</option>
                                    <option  value="Anaqueles">Anaqueles</option>
                                    <option  value="Silla">Silla</option>
                                    <option  value="Aire Acondicionado">Aire Acondicionado</option>
                                    <option  value="Microondas">Microondas</option>
                                    <option  value="Mesa">Mesa</option>
                                    <option  value="Portagarrafon">Portagarrafon</option>
                                    <option  value="Extintor">Extintor</option>
                                    <option  value="Cuadro Decorativo">Cuadro Decorativo</option>
                                    <option  value="Caja Fuerte">Caja Fuerte</option>
                                    <option  value="Baños">Baños</option>
                                    <option  value="Otros">Otros</option>
                                </select>                            
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="output" width="100" height="100"/>
                                </div> 
                                <input type="file" name="fotoMobiliario" style="margin-left: 10px;" id="fotoMobiliario" onchange="loadFile(event)" >                          
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

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6"> 
                                <label>Ubicacion</label> 
                                <select id="ubicacion" class="form-control"  name="ubicacion" required>
                                    <option selected value="N/A">N/A</option>
                                    <option  value="Oficina de corte">Oficina de corte</option>
                                    <option  value="Cuarto eléctrico">Cuarto eléctrico</option>
                                    <option  value="Baño de personal">Baño de personal</option>
                                    <option  value="Baño público hombres">Baño público hombres</option>
                                    <option  value="Baño público mujeres">Baño público mujeres</option>
                                    <option  value="Cuarto eléctrico"> Cuarto eléctrico</option>
                                    <option  value="Cuarto de máquinas">Cuarto de máquinas</option>
                                    <option  value="Oficina operativa">Oficina operativa</option>
                                    <option  value="Oficina de corte">Oficina de corte</option>
                                    <option  value="Exterior estación">Exterior estación</option>
                                </select>   
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Fecha Asignación</label> 
                                <input type="date" class="form-control" id="fechaAsignacion" name="fechaAsignacion" placeholder="Fecha de Asignación"  required>                
                            </div> 
                        </div> 

                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Cantidad</label>       
                            <input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required>        
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
                        <a href="<?=base_url('mobiliario')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--MODAL PARA EDITAR Mobiliario-->
    <div class="modal fade" id="ModalMobiliarioUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalMobiliarioUpdate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLabel">Actuliazar Mobiliario <i class="nav-icon fas fa-couch"></i> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/editarMobiliario')?>" method="POST" enctype="multipart/form-data">
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
                                <select id="categoriasUpdate" class="form-control"  name="categoria" required>
                                    <option selected value="Escritorio">Escritorio</option>
                                    <option  value="Archivero">Archivero</option>
                                    <option  value="Gabinete">Gabinete</option>
                                    <option  value="Anaqueles">Anaqueles</option>
                                    <option  value="Silla">Silla</option>
                                    <option  value="Aire Acondicionado">Aire Acondicionado</option>
                                    <option  value="Microondas">Microondas</option>
                                    <option  value="Mesa">Mesa</option>
                                    <option  value="Portagarrafon">Portagarrafon</option>
                                    <option  value="Extintor">Extintor</option>
                                    <option  value="Cuadro Decorativo">Cuadro Decorativo</option>
                                    <option  value="Caja Fuerte">Caja Fuerte</option>
                                    <option  value="Baños">Baños</option>
                                    <option  value="Otros">Otros</option>
                                </select>                            
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="outputUpdate" width="100" height="100" src=""  />
                                </div> 
                                <input type="file" name="fotoMobiliario" style="margin-left: 10px;" id="fotoMobiliarioUpdate" onchange="loadFileUpdate(event)">                          
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

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-6"> 
                                <label>Ubicacion</label> 
                                <select id="ubicacionUpdate" class="form-control"  name="ubicacion" required>
                                    <option  value="N/A">N/A</option>
                                    <option  value="Oficina de corte">Oficina de corte</option>
                                    <option  value="Cuarto eléctrico">Cuarto eléctrico</option>
                                    <option  value="Baño de personal">Baño de personal</option>
                                    <option  value="Baño público hombres">Baño público hombres</option>
                                    <option  value="Baño público mujeres">Baño público mujeres</option>
                                    <option  value="Cuarto eléctrico"> Cuarto eléctrico</option>
                                    <option  value="Cuarto de máquinas">Cuarto de máquinas</option>
                                    <option  value="Oficina operativa">Oficina operativa</option>
                                    <option  value="Oficina de corte">Oficina de corte</option>
                                    <option  value="Exterior estación">Exterior estación</option>
                                </select>   
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Fecha Asignación</label> 
                                <input type="date" class="form-control" id="fechaAsignacionUpdate" name="fechaAsignacion" placeholder="Fecha de Asignación"  required>                
                            </div>   
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
                        <a href="<?=base_url('mobiliario')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){        
            $("#tablaMobiliario").DataTable({
            columnDefs:[{
                targets: "_all"        
            }],
            });
        });



        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR el Mobiliario?',
                text:'Se eliminara el Mobiliario!',
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
   


        function editarMobiliario($id,$responsable,$departamento,$marca,$modelo,$serie,$color,$categoria,$fechaAsignacion,$observaciones,$descripcion,$foto,$ubicacion) {
            // Set data to Form Edit   
            $('#idUpdate').val($id);
            $('#responsableUpdate').val($responsable); 
            $('#departamentoUpdate').val($departamento).trigger('change');                          
            $('#marcaUpdate').val($marca);
            $('#modeloUpdate').val($modelo);
            $('#serieUpdate').val($serie);
            $('#colorUpdate').val($color);
            $('#categoriasUpdate').val($categoria);
            $('#fechaAsignacionUpdate').val($fechaAsignacion).trigger('change');                      
            $('#observacionesUpdate').val($observaciones);
            $('#descripcionUpdate').val($descripcion);            
            $('#ubicacionUpdate').val($ubicacion); 
            $src = '<?= base_url()?>/public/uploads/Mobiliario/'+$foto;            
            document.getElementById("outputUpdate").src=$src;   
            
            // Call Modal Edit
            $('#ModalMobiliarioUpdate').modal('show');
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

