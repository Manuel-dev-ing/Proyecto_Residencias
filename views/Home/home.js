$(document).ready(function() {

    if ($("#rol_id").val() == 1) {
        grafica()

        var funcion = "TotalIncidencias";
        $.post("../../controllers/incidenciaController.php", {funcion}, (response)=>{
            const total = JSON.parse(response);
            // console.log(response);
            total.forEach(total => {
                // console.log(total.total);
                $('#lbltotal').html(total.total);
            });

        }); 

        funcion = "totalAbiertoIncidencias";
        $.post("../../controllers/incidenciaController.php", {funcion}, (response)=>{
            const total = JSON.parse(response);
            total.forEach(total => {
                // console.log("total Abierto: ");
                // console.log(total.total);
                $('#lbltotalAbierto').html(total.total);
            });

        }); 

        funcion = "totalCerradoIncidencias";
        $.post("../../controllers/incidenciaController.php", {funcion}, (response)=>{
            const total = JSON.parse(response);
            total.forEach(total => {
                // console.log("total Cerrado: ");
                // console.log(total.total);
                $('#lbltotalCerrado').html(total.total);
            });

        });




    } if ($("#rol_id").val() == 2) {
        
        $("#divGrafica").css("display", "none");
        
        var funcion = "Total";
        var usuario_id = $("#user_idx").val();

        console.log(usuario_id);

        $.post("../../controllers/UsuarioController.php", {funcion, usuario_id}, (response)=>{
            const total = JSON.parse(response);
            total.forEach(total => {
                // console.log(total.total);
                $('#lbltotal').html(total.total);
            });

        }); 

        funcion = "totalAbierto";
        $.post("../../controllers/UsuarioController.php", {funcion, usuario_id}, (response)=>{
            const total = JSON.parse(response);
            total.forEach(total => {
                // console.log("total Abierto: ");
                // console.log(total.total);
                $('#lbltotalAbierto').html(total.total);
            });

        }); 

        funcion = "totalCerrado";
        $.post("../../controllers/UsuarioController.php", {funcion, usuario_id}, (response)=>{
            const total = JSON.parse(response);
            total.forEach(total => {
                // console.log("total Cerrado: ");
                // console.log(total.total);
                $('#lbltotalCerrado').html(total.total);
            });

        });
   
    }

    function grafica() {
      

        var funcion = "grafica";
        $.post("../../controllers/incidenciaController.php", {funcion}, (response)=>{
            
            response = JSON.parse(response);

            var sucursalesX = new Array();
            var sucursalesY = new Array();    
          
            response.forEach(subArray => {
                sucursalesY.push(subArray[0]);                
                sucursalesX.push(subArray[1]);                
            })
            
            var divGrafica = document.getElementById('bar-chart');

            var data = [
                {
                  x: sucursalesX,
                  y: sucursalesY,
                  type: 'bar'
                }
              ];
              
            Plotly.newPlot(divGrafica, data);

        })

      
    }



    function buscar_incidencia(valor) {
        
        let funcion = "buscar";
        $.post("../../controllers/incidenciaController.php", {funcion, valor}, (response)=>{
            const incidencias = JSON.parse(response);
            console.log(response);
            let template='';
            incidencias.forEach(incidencia => {
                template +=`
                <a><li class="list-group-item rounded-3" onClick="ver(${incidencia.id});" id="${incidencia.id}">${incidencia.nombre_incidencia}</li></a>
                
                `;
            });
                $('#incidencias').html(template);
           
        })
        

    }

    


    $(document).on('keyup','#buscar', function() {
        let valor = $(this).val();
        // console.log(valor);
        
        if (valor != "") {
            $('#incidencias').css("display", "block");
            buscar_incidencia(valor);
        }if (valor == "") {
            $('#incidencias').css("display", "none");
            
        }else {
          console.log("no se en encontro nada");
            // buscar_incidencia()
        }
    
    })
})

function ver(id) {
    console.log("ID incidencia: " + id); 
    window.open('http://localhost/proyecto_residencias/views/DetalleTicket/?ID='+ id +'');

}