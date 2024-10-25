console.log("sucursales");
var edit = false;
var tabla;
var funcion;

$(document).ready(function () {
    validarSoloLetrasSucursal();
    validarSoloLetrasCiudad();
    validarSoloNumeros();


    funcion = "listarSucursal";
    tabla=$('#Sucursal_data').dataTable({
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
            url: '../../controllers/sucursal_controller.php',
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
    
    $('#sucursal-form').on("submit", function(e) {
        let nombre =  $('#nombre').val();
        let direccion =  $('#direccion').val();
        let ciudad =  $('#ciudad').val();
        let telefono =  $('#telefono').val();
        let id =  $('#id').val();

        if (edit == true) {
            funcion = "editar"
        } else {
            funcion = "crear"
        }
   
        $.post("../../controllers/sucursal_controller.php", {id, funcion, nombre, direccion, ciudad, telefono}, (response)=>{
            console.log(response);

            if (response == 'creado') {
                swal({
                    title: "Sucursal Creada!",
                    text: "sucursal creada correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }
            if (response == 'editado') {
                swal({
                    title: "Sucursal Actualizada!",
                    text: "sucursal actualizada correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }    

            $('#Sucursal_data').DataTable().ajax.reload();
            $('#ModalbtnNuevaSucursal').modal('hide');
        })
        e.preventDefault();
    })


    function validarSoloLetrasSucursal(){
        $('#sucursal_nombre').on("input", function() {
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
    function validarSoloNumeros(){
        $('#telefono').on("input", function() {
            var input = $(this).val();
            var reges = /^[0-9+]*$/;
            var isValid = false;
    
            if (!reges.test(input)) {
                swal({
                    icon: "error",
                    title: "No se aceptan Letras",
                   
                });
                $(this).val(input.replace(/[^0-9+]/g, ''));
                
            }
    
        })
    }

    function validarSoloLetrasCiudad(){
        $('#ciudad').on("input", function() {
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

})


$(document).on("click", "#btnNuevaSucursal", function() {
    console.log("Modal Nueva sucursal");
    edit = false;
    $('#labelTitulo').html('Nuevo Registro');
    $('#sucursal-form')[0].reset();

    $('#ModalbtnNuevaSucursal').modal('show');

})

function Eliminar(id){
    console.log("Eliminar prioridad id: " + id);

    swal({
        title: "Soporte Tecnico",
        text: "Estas seguro de eliminar la Sucursal",
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
            $.post("../../controllers/sucursal_controller.php", {funcion, id}, (response)=>{
                console.log(response);
                

                if (response.includes('delete')) {
                    $('#Sucursal_data').DataTable().ajax.reload();
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
    
    console.log("editar id: ", id );

    $('#labelTitulo').html('Editar Registro');
    let funcion = "obtenerSucursal_x_id"
    $.post("../../controllers/sucursal_controller.php", {funcion, id}, (response)=>{
        response = JSON.parse(response);
        console.log("response:");
        console.log(response);
        $('#id').val(response.id);
        $('#nombre').val(response.nombre);
        $('#direccion').val(response.direccion);
        $('#ciudad').val(response.ciudad);
        $('#telefono').val(response.telefono);
        
    }); 

    $('#ModalbtnNuevaSucursal').modal('show');

}

