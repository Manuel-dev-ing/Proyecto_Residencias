console.log("Gestion de prioridad");
var edit = false;
var tabla;
var funcion;
$(document).ready(function () {
    validarSoloLetras();
    funcion = "listarprioridad";
    tabla=$('#Prioridad_data').dataTable({
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
            url: '../../controllers/prioridadController.php',
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

    $('#Proridad-form').on("submit", function(e) {
        var nombre =  $('#nombre').val();
        var id =  $('#id').val();

        if (edit == true) {
            funcion = "editar"
        } else {
            funcion = "crear"
        }

   
        $.post("../../controllers/prioridadController.php", {funcion, nombre, id}, (response)=>{
            console.log(response);

            if (response == 'add') {
                swal({
                    title: "Prioridad Creada!",
                    text: "prioridad creada correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }
            if (response == 'editado') {
                swal({
                    title: "Prioridad Actualizada!",
                    text: "prioridad actualizada correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }
            
            $('#Prioridad_data').DataTable().ajax.reload();
            $('#ModalbtnNuevaPrioridad').modal('hide');



        })
        e.preventDefault();
    })

    

    $(document).on("click", "#btnNuevaPrioridad", function() {
        console.log("Modal Nueva categoria");
        edit = false;
        $('#labelTitulo').html('Nuevo Registro');
        $('#Proridad-form')[0].reset();
    
        $('#ModalbtnNuevaPrioridad').modal('show');
    
    })

    
    function validarSoloLetras(){
        $('#prioridad_nombre').on("input", function() {
            var input = $(this).val();
            var reges = /^[a-zA-Z\s]*$/;
            var isValid = false;
    
            if (!reges.test(input)) {
                swal({
                    icon: "error",
                    title: "No se aceptan numeros",
                   
                });
                $(this).val(input.replace(/[^a-zA-Z\s]/g, ''));
                
            }
    
        })
    }

});


function Eliminar(id){
    console.log("Eliminar prioridad id: " + id);

    swal({
        title: "Soporte Tecnico",
        text: "Estas seguro de eliminar la Prioridad?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
        
    },
    function(isConfirm) {
        if (isConfirm) {
            let funcion = "eliminar";
            //var usuario_id = usuario_id;
            $.post("../../controllers/prioridadController.php", {funcion, id}, (response)=>{
                console.log(response);

                if (response.includes('delete')) {
                    $('#Prioridad_data').DataTable().ajax.reload();

                }
            }); 
            

            swal({
                title: "Soporte Tecnico!",
                text: "Prioridad eliminada correctamente",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } 
    });

}

function Editar(id){
    edit = true;
    
    $('#labelTitulo').html('Editar Registro');
    let funcion = "obtenerPioridad_x_id"
    $.post("../../controllers/prioridadController.php", {funcion, id}, (response)=>{
        response = JSON.parse(response);
        console.log("response:");
        console.log(response);
        $('#nombre').val(response.nombre);
        $('#id').val(response.id);
 
        
    }); 
    $('#ModalbtnNuevaPrioridad').modal('show');

}




