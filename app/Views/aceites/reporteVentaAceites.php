<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>
    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){
            datosAceites();

        });

        function getValue(currentProduct, content, dia){
            let val = 0; 
            let ncontent = content.length;
            for(k = 0; k<ncontent; k++){
                if(currentProduct == content[k]['producto']){
                    val = content[k][dia];
                }
            }  
            return val;
        }

        function datosAceites(){        
            $idEstacion = $("#estacion").val();             
            var content = <?php echo json_encode($venta); ?>;
            var aceites = <?php echo json_encode($aceites); ?>;          
            var ultimasCompras = <?php echo json_encode($ultimasCompras); ?>;
            var inventarioFisico = <?php echo json_encode($inventarioFisico); ?>;
            var fechaInicial = <?php echo json_encode($fechaInicial); ?>;
            var fechaFinal = <?php echo json_encode($fechaFinal); ?>;            
            
            var fechas = <?php echo json_encode($fechasArray); ?>;     
            var fechasr = <?php echo json_encode($fechasArrayReversed); ?>;        
            var n = content.length;           
            var nn = ultimasCompras.length;           
            var nfechas = fechas.length;            
            var ninventario = inventarioFisico.length;            
            var naceites = aceites.length;   

            var totales = <?php echo json_encode($totales); ?>;
            
            
            var totalDD  = [];
                
            document.getElementById('fechaInventario').innerHTML = "Fecha del último inventario: " + inventarioFisico[0]['fecha']; 

            for(var i=0;i<nfechas;i++){
                var x= 4;
                var tr = document.getElementById('tablaCompraAceites').tHead.children[0];
                tr.insertCell(x).outerHTML = "<th style='width:5%'>"+fechasr[i]['dia']+"</th>" 
                x++;
            }
        
            
            for(var i = 0;i<naceites;i++){
                let compra = 0;                 
                for(var x = 0;x<nn;x++){                     
                    if(ultimasCompras[x]['producto'] == aceites[i]['producto']){ 
                        compra = ultimasCompras[x]['cantidad'];
                    }
                } 

                let inv = 0;
                let totalDispensariosBodega = 0;
                for(var x = 0;x<ninventario;x++){                     
                    if(inventarioFisico[x]['producto'] == aceites[i]['producto']){ 
                        inv = inventarioFisico[x]['stock'];
                        dis1 = inventarioFisico[x]['dispensario_1'];
                        dis2 =inventarioFisico[x]['dispensario_2'];
                        bodega =inventarioFisico[x]['bodega'];
                        totalDispensariosBodega =  parseFloat(dis1) + parseFloat(dis1) + parseFloat(bodega);
                    }
                }

                let inventario = (parseFloat(inv) + parseFloat(compra));
                    
                let ventasF = "";
                let total = 0;
                var totalD  = [];   
                for(z=0; z<nfechas; z++){
                    let f = fechas[z]['dian'];
                    let value = 0;
                    value = getValue(aceites[i]['producto'], content, f);
                    totalD.push(parseFloat(value));
                   
                    ventasF = ventasF + "<td>" + value + "</td>";   
                    total = total + parseFloat(value);                        
                }
                totalDD[i] = totalD;
                
                
                                                                                                  
                html = "<tr>"+
                            "<input type='hidden' id='id' name='id[]' value='"+aceites[i]['producto']+"'>"+                              
                            "<td>"+aceites[i]['producto']+"</td>"+ 
                            "<td>"+inv+"</td>"+ 
                            "<td>"+(compra)+"</td>"+
                            "<td>"+inventario+"</td>"+
                            ventasF + 
                            "<td>"+total+"</td>"+
                            "<td>"+ (inventario - parseFloat(total))+"</td>"+
                            "<td>"+dis1+"</td>"+
                            "<td>"+dis2+"</td>"+
                            "<td>"+bodega+"</td>"+ 
                            "<td>"+totalDispensariosBodega+"</td>"+ 
                            "<td>"+(totalDispensariosBodega - (inventario - parseFloat(total)))+"</td>"+ 
                        "</tr>"; 
                    $("#datosTable").append(html); 
            }
            
                var colSum = totalDD.reduce((a, b) => a.map((x, i) => x + parseFloat(b[i])));
                 
                let totalesTD = "";
                for(z=0; z<colSum.length; z++){ 
                    totalesTD = totalesTD + "<td>" + colSum[z] + "</td>";                         
                }
                html = "<tr>"+
                            "<td></td>"+ 
                            "<td></td>"+ 
                            "<td></td>"+
                            "<td></td>"+
                            totalesTD +  
                        "</tr>"; 
                    $("#datosTable").append(html); 
              
        }
 

        
      

                    
       

    </script>

    
   
        <div class="container-fluid"> 
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aceites                                                                          
                        <button  class="btn btn-outline-warning addUser"  style="margin-left:5px;" onclick="exportTableToExcel('tablaCompraAceites','members-data')"><i class="nav-icon fas fa-file-alt"></i> Exportar</button>                               
                    </h6>
                </div>
                
                <form action="<?= base_url('/guardarVentaAceite')?>" method="POST">
            
                    <div class="form-row">
                        <div class=" col-md-12">
                            <button type="submit" name="registerbtn" class="btn btn-outline-success addUser" style="margin-right:20px;margin-top: 10px;"><i class="nav-icon fas fa-oil-can"></i> BUSCAR </button>      
                        </div>    
                    </div>

                    <div class="card-body">
                    
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEstacion">Estacion</label>
                                <select id="estacion" class="form-control"  name="estacion" required >
                                    <?php foreach($estaciones as $estaciones): ?> 
                                        <option value=<?= $estaciones['id'];?>><?= $estaciones['nombre'];?></option>
                                    <?php endforeach;?> 
                                </select>                
                            </div>    
                        </div>
                        
                        <div class="col-md-12" style="display:flex;">
                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha:</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" >                                        
                            </div> 

                            <div class="form-group col-md-6">
                                <label for="inputDias">Dias</label>
                                <select id="dias" class="form-control"  name="dias" required >                                
                                        <option value="7">7 Dias</option>  
                                        <option value="15">15 Dias</option>  
                                        <option value="30">30 Dias</option>                                
                                </select>                                        
                            </div> 
                        </div>
                

                        <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  
                        <label id="fechaInventario"></label>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablaCompraAceites" width="100%" cellspacing="0">
                                <thead>
                                    <tr>                                                                   
                                        <th style="width:50%">Producto</th>
                                        <th style="width:5%">Inicial</th>                                                                                                                   
                                        <th style="width:5%">COMP.</th>                                                                                                                   
                                        <th style="width:5%">INV. TOTAL</th>                                                                                                                                                                                                                                                              
                                        <th style="width:5%">TOTAL VENTAS</th>                                                                                                                   
                                        <th style="width:5%">DIF</th>                                                                                                                   
                                        <th style="width:5%">DISP. 1</th>                                                                                                                   
                                        <th style="width:5%">DISP. 2</th>                                                                                                                   
                                        <th style="width:5%">BDGA.</th>                                                                                                                   
                                        <th style="width:5%">TOTAL</th>                                                                                                                   
                                        <th style="width:5%">DIF</th>                                                                                                                   
                                    </tr>
                                </thead>
                                <tbody id="datosTable">  
                                
                                </tbody>
                            </table>
                        </div>  

                    </div>
                </form>
            </div>
        </div>
    
    


    <script>
        function exportTableToExcel(tableID, filename = 'TABLA'){
            console.log("entro");
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';
    
            // Create download link element
            downloadLink = document.createElement("a");
    
            document.body.appendChild(downloadLink);
    
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
                // Setting the file name
                downloadLink.download = filename;
        
                //triggering the function
                downloadLink.click();
            }
        }
    </script>

<?= 
    $this->endSection();
?>