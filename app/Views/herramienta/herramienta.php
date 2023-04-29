<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


   
    
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Herramientas            
                    <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalHerramienta">
                        <i class="nav-icon 	fas fa-tools"></i>     + AGREGAR 
                    </button>     
               
                </h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaHerramienta" width="100%" cellspacing="0">
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
                            <?php foreach($herramienta as $herramienta): ?>    
                                <?php            
                                    $id=strlen($herramienta['id']);
                                    if($id == 1){
                                        $idcompuesto = "00".$herramienta['id'];
                                    }else{
                                        $idcompuesto = "0".$herramienta['id'];
                                    }                      
                                    $codigo = $idcompuesto .substr($herramienta['marca'],0,2) .substr($herramienta['responsable'],0,3) .substr($herramienta['serie'],0,4);
                                    $codigo = strtoupper($codigo);
                                ?>      
                                                                                          
                                    <tr>                                                                
                                        <td><?= $herramienta['id'];?></td>     
                                        <td><?= $codigo;?></td>                                     
                                        <td><?= $herramienta['responsable'];?></td>
                                        <td><?= $herramienta['departamento'];?></td>
                                        <td><?= $herramienta['marca'];?></td>
                                        <td><?= $herramienta['modelo'];?></td> 
                                        <td><?= $herramienta['serie'];?></td>
                                        <td><?= $herramienta['color'];?></td>                                       
                                        <td><?= $herramienta['categoria'];?></td>                                                                                                                
                                        <td><?= $herramienta['fechaAsignacion'];?></td>
                                        <td><?= $herramienta['descripcion'];?></td>
                                        <td><?= $herramienta['observaciones'];?></td>                                         
                                        <td><button type="button" class="btn btn-outline-info" 
                                                    onclick="editarHerramienta(<?=$herramienta['id'];?>,'<?=$herramienta['responsable'];?>','<?=$herramienta['departamento'];?>',
                                                                '<?=$herramienta['marca'];?>','<?=$herramienta['modelo'];?>','<?=$herramienta['serie'];?>',
                                                                '<?=$herramienta['color'];?>','<?=$herramienta['categoria'];?>','<?=$herramienta['fechaAsignacion'];?>'
                                                                ,'<?=$herramienta['observaciones'];?>','<?=$herramienta['descripcion'];?>'
                                                                ,'<?=$herramienta['foto'];?>','<?=$herramienta['ubicacion'];?>'
                                                    )">
                                        
                                                <i class="nav-icon fas fa-edit"></i> Editar
                                            </button> 
                                        </td>                                                                    
                                        <td><button onclick="mensajeBaja('<?= base_url('eliminarHerramienta/'.$herramienta['id'])?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i>Eliminar</button></td>

                                    </tr>                           
                                <?php endforeach;?>  
                                                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <!--MODAL PARA AGREGAR HERRAMIENTA-->
    <div class="modal fade" id="ModalHerramienta" tabindex="-1" role="dialog" aria-labelledby="ModalHerramienta" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Herramienta <i class="nav-icon 	fas fa-tools"></i>  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/guardarHerramienta')?>" method="POST" enctype="multipart/form-data">
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
                                    <option selected value="Mangueras">Mangueras</option>
                                    <option  value="Conos">Conos</option>
                                    <option  value="Escaleras">Escaleras</option>
                                    <option  value="Detectores Humo">Detectores Humo</option>
                                    <option  value="Alarmas Sonoras">Alarmas Sonoras</option>
                                    <option  value="Pararrayos">Pararrayos</option>
                                    <option  value="Contenedores">Contenedores</option>
                                    <option  value="Cuarto de Maquina">Cuarto de Maquina</option>
                                    <option  value="Monedero">Monedero</option>
                                    <option  value="Accesorios Baños">Accesorios Baños</option>                                    
                                </select>                            
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="output" width="100" height="100"/>
                                </div> 
                                <input type="file" name="fotoHerramienta" style="margin-left: 10px;" id="fotoHerramienta" onchange="loadFile(event)">                          
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
                            <label>Descripción</label>       
                            <textarea id="descripcion" name="descripcion" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                        <div class="form-group" style="margin-bottom:5px !important">
                            <label>Observaciones</label>       
                            <textarea id="observaciones" name="observaciones" rows="2" cols="50" class="form-control"></textarea>          
                        </div> 
                       
                       
        
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('herramienta')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--MODAL PARA EDITAR HERRAMIENTAS-->
    <div class="modal fade" id="ModalHerramientaUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalHerramientaUpdate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLabel">Actuliazar Herramienta <i class="nav-icon fas fa-tools"></i>  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/editarHerramienta')?>" method="POST" enctype="multipart/form-data">
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
                                    <option value="Administrativo">Administrativo</option>
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
                                    <option  value="Mangueras">Mangueras</option>
                                    <option  value="Conos">Conos</option>
                                    <option  value="Escaleras">Escaleras</option>
                                    <option  value="Detectores Humo">Detectores Humo</option>
                                    <option  value="Alarmas Sonoras">Alarmas Sonoras</option>
                                    <option  value="Pararrayos">Pararrayos</option>
                                    <option  value="Contenedores">Contenedores</option>
                                    <option  value="Cuarto de Maquina">Cuarto de Maquina</option>
                                    <option  value="Monedero">Monedero</option>
                                    <option  value="Accesorios Baños">Accesorios Baños</option>                                    
                                </select>                            
                            </div>                                                       
                        </div>

                        <div class="form-row" style="margin-bottom:5px !important">
                            <div class="form-group col-md-12" style="display:flex;align-items: center">                            
                                <div class='preview'>
                                    <img  class="center-block img-thumbnail" id="outputUpdate" width="100" height="100" src=""  />
                                </div> 
                                <input type="file" name="fotoHerramienta" style="margin-left: 10px;" id="fotoHerramientaUpdate" onchange="loadFileUpdate(event)">                          
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
                        <a href="<?=base_url('herramienta')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){        
            $("#tablaHerramienta").DataTable({
            columnDefs:[{
                targets: "_all"        
            }],
            });
        });



        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR la Herramienta?',
                text:'Se eliminara la Herramienta!',
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
   


        function editarHerramienta($id,$responsable,$departamento,$marca,$modelo,$serie,$color,$categoria,$fechaAsignacion,$observaciones,$descripcion,$foto,$ubicacion) {
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
            $('#ubicacionUpdate').val($ubicacion); 
            $src = '<?= base_url()?>/public/uploads/Herramientas/'+$foto;            
            document.getElementById("outputUpdate").src=$src;   
            // Call Modal Edit
            $('#ModalHerramientaUpdate').modal('show');
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

