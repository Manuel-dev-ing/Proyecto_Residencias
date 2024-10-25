//
var tabla;

$(document).ready(function() {
    var usu_id = $('#user_idx').val();
    var rol_id = $('#rol_id').val();

    if (rol_id == 2) { // 
        //coultar elementos th de la tabla
        const thusuario = document.querySelector('#th-usuario'); 
        thusuario.remove();

        const thsucursal = document.querySelector('#th-sucursal');
        thsucursal.remove();

        let funcion = "listar_incidencia_x_usuario";
        tabla=$('#incidencia_data').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: false,
            colReorder: true,
            buttons: [		          
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                    ],
            "ajax":{
                url: '../../controllers/incidenciaController.php',
                type : "post",
                dataType : "json",	 
                data:{ funcion : funcion, usu_id: usu_id},						
                error: function(e){
                    console.log(e.responseText);	
                }
            },
            "bDestroy": true,
            "responsive": true,
            "bInfo":true,
            "iDisplayLength": 10,
            "autoWidth": false,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }     
        }).DataTable(); 
        
    } else {
        let funcion = "listar";
        tabla=$('#incidencia_data').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: false,
            colReorder: true,
            buttons: [		          
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                    ],
            "ajax":{
                url: '../../controllers/incidenciaController.php',
                type : "post",
                dataType : "json",	 
                data:{ funcion : funcion},						
                error: function(e){
                    console.log(e.responseText);	
                }
            },
            "bDestroy": true,
            "responsive": true,
            "bInfo":true,
            "iDisplayLength": 10,
            "autoWidth": false,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }     
        }).DataTable(); 
    }
})


function ver(incidencia_id) {
    console.log(incidencia_id);
    
    window.open('http://localhost/proyecto_residencias/views/DetalleTicket/?ID='+ incidencia_id +'');

}


function Asignar(incidencia_id){
    LlenarSelectSoporte();

    $("#labelTitulo").html('Asignar Usuario');
    $("#incidencia_id").val(incidencia_id);

    $("#ModalAsignar").modal('show');
    console.log("id: " + incidencia_id);
}

function LlenarSelectSoporte() {
    funcion = "LlenarSelectSoporte"
    $.post('../../controllers/UsuarioController.php', {funcion}, (response)=>{
        // console.log(response);
        const usuarios = JSON.parse(response);
        let template='';
        usuarios.forEach(usuario => {
            template+=`
                <option value="${usuario.usuario_id}">${usuario.usuario_nombre}</option>
            `;
        });
        // console.log(template);
        $('#usuario_asignar').html(template);
    })
}

$('#usuario-form').on("submit", function(e) {
    let funcion = "AsignarUsuarioTicket";
    let incidencia_id = $('#incidencia_id').val();
    let usuario_asignar =  $('#usuario_asignar').val();
    console.log("usuario Asignado: " + usuario_asignar);
    console.log("incidencia_id: " + incidencia_id);
    // console.log("incidencia_id: " + incidencia_id);

    $.post("../../controllers/incidenciaController.php", {funcion, incidencia_id, usuario_asignar}, (response)=>{
        console.log(response);
        if (response.includes(true)) {
            swal({
                title: "Agente Asignado",
                text: "Agente Asignado Correctamente",
                type: "success",
                confirmButtonClass: "btn-success"
            });

            $("#ModalAsignar").modal('hide');
            $('#incidencia_data').DataTable().ajax.reload();
           
        }
       

    })
    e.preventDefault();


})








