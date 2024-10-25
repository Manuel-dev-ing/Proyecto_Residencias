console.log("Gestion de categorias");
var edit = false;
var tabla;
var funcion;

$(document).ready(function() {
    validarSoloLetras()
    funcion = "listarCategorias";
    tabla=$('#categoria_data').dataTable({
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
            url: '../../controllers/categoriaController.php',
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

    $('#categoria-form').on("submit", function(e) {
        let nombre =  $('#nombre').val();
        let id =  $('#id').val();

        if (edit == true) {
            funcion = "editar"
        } else {
            funcion = "crear"
        }

        $.post("../../controllers/categoriaController.php", {funcion, nombre, id}, (response)=>{

            console.log(response);

            if (response == 'add') {
                swal({
                    title: "Categoria Creada!",
                    text: "categoria creada correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }
            if (response == 'editado') {
                swal({
                    title: "Categoria Actualizada!",
                    text: "categoria actualizada correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }

            $('#categoria_data').DataTable().ajax.reload();
            $('#ModalNuevaCategoria').modal('hide');
        })
        e.preventDefault();
    })


    function validarSoloLetras(){
        $('#nombre').on("input", function() {
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


$(document).on("click", "#btnNuevaCategoria", function() {
    console.log("Modal Nueva categoria");
    edit = false;
    $('#labelTitulo').html('Nuevo Registro');
    $('#categoria-form')[0].reset();

    $('#ModalNuevaCategoria').modal('show');

})


function Editar(categoria_id){
    edit = true;
    
    $('#labelTitulo').html('Editar Registro');
    let funcion = "obtenerCategoria_x_id"
    $.post("../../controllers/categoriaController.php", {funcion, categoria_id}, (response)=>{
        response = JSON.parse(response);
        console.log("response:");
        console.log(response);
        $('#nombre').val(response.nombre);
        $('#id').val(response.id);
 
        
    }); 
    $('#ModalNuevaCategoria').modal('show');

}

function Eliminar(categoria_id){
    console.log("Eliminar categoria id: " + categoria_id);

    swal({
        title: "Soporte Tecnico",
        text: "Estas seguro de eliminar la categoria?",
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
            $.post("../../controllers/categoriaController.php", {funcion, categoria_id}, (response)=>{
                console.log(response);
                if (response.includes('delete')) {
                    $('#categoria_data').DataTable().ajax.reload();

                }
            }); 

            swal({
                title: "Soporte Tecnico!",
                text: "Usuario eliminada correctamente",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } 
    });

}




