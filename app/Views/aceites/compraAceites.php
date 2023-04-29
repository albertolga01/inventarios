<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>
    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){
            datosAceites();

        });
        function datosAceites(){
            $idEstacion = $("#estacion").val();             
            var content = <?php echo json_encode($stockaceite); ?>;
            //console.log(content);
            var n = content.length;           
            let rows = document.getElementById("datosTable").getElementsByTagName("tr");
            rows = Array.from(rows);
            for(let elmt of rows){
                elmt.remove();
            }
            
            for(var i = 0;i<n;i++){
                if(content[i]['id_estacion'] == $idEstacion){                                                                                 
                    html = "<tr>"+
                                "<input type='hidden' id='id' name='id[]' value='"+content[i]['id']+"'>"+
                                "<input type='hidden' class='form-control' id='id_aceite' name='id_aceite[]' value='"+content[i]['id_aceite']+"' >"+                           
                                "<td><input type='text' class='form-control' id='producto' name='producto[]' value='"+content[i]['producto']+"' readonly></td>"+                                
                                "<td><input type='number' class='form-control' id='cantidad' name='cantidad[]' placeholder='Cantidad' value='"+content[i]['cantidad']+"'></td>"+
                                "<td><input type='number' class='form-control' id='dispensario1' name='dispensario1[]' placeholder='Dispensario 1' value='"+content[i]['dispensario_1']+"'></td>"+
                                "<td><input type='number' class='form-control' id='dispensario2' name='dispensario2[]' placeholder='Dispensario 1' value='"+content[i]['dispensario_2']+"'></td>"+
                                "<td><input type='number' class='form-control' id='bodega' name='bodega[]' placeholder='Bodega' value='"+content[i]['bodega']+"'></td>"+
                            "</tr>";
                    //$('#datosTable').html(html);
                    $("#datosTable").append(html);
                }
            }  
            
             
        }

    </script>

    <form action="<?= base_url('/guardarComprasAceite')?>" method="POST">
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aceites                                 
                        <button type="submit" name="registerbtn" class="btn btn-outline-success addUser"><i class="nav-icon fas fa-oil-can"></i> GUARDAR </button>      
                    </h6>
                </div>

                <div class="card-body">                
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEstacion">Estacion</label>
                            <select id="estacion" class="form-control"  name="estacion" required onchange="datosAceites()">
                                <?php foreach($estaciones as $estaciones): ?> 
                                    <option value=<?= $estaciones['id'];?>><?= $estaciones['nombre'];?></option>
                                <?php endforeach;?> 
                            </select>                
                        </div>    
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" required>   
                        </div>    
                    </div>
                     


                    <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaCompraAceites" width="100%" cellspacing="0">
                            <thead>
                                <tr>                                                                   
                                    <th style="width:30%;text-align:center">Producto</th>
                                    <th style="width:20%;text-align:center">Cantidad</th>
                                    <th style="width:15%;text-align:center">Dispensario 1</th>
                                    <th style="width:15%;text-align:center">Dispensario 2</th>
                                    <th style="width:15%;text-align:center">Bodega</th>                                                                                                                                               
                                </tr>
                            </thead>
                            <tbody id="datosTable">  
                              
                            </tbody>
                        </table>
                    </div>                
                </div>
            </div>
        </div>
    </form>

    
<?= 
    $this->endSection();
?>

