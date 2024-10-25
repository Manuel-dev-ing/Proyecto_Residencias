var edit = false;
var tabla;
var funcion;

$(document).ready(function() {
    LlenarSelectRol()
    LlenarSelectSucursal()
    validarSoloLetrasNombre()
    validarSoloLetrasApellidos()

    funcion = "listarUsuario";
    tabla=$('#usuario_data').dataTable({
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
            url: '../../controllers/UsuarioController.php',
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



    $('#usuario-form').on("submit", function(e) {
        let usuario_id = $('#usuario_id').val();
        let usuario_nombre =  $('#usuario_nombre').val();
        let usuario_apellidos =  $('#usuario_apellidos').val();
        let usuario_password =  $('#usuario_password').val();
        let usuario_correo =  $('#usuario_correo').val();
        let rol_id =  $('#roles').val();
        let sucursal =  $('#sucursal').val();

        if (edit == true) {
            funcion = "editar"
        } else {
            funcion = "crear"
        }

   
        $.post("../../controllers/UsuarioController.php", {funcion, usuario_id, usuario_nombre, usuario_apellidos, usuario_password, usuario_correo, rol_id, sucursal}, (response)=>{
            console.log("response: ", response);

            if (response == 'creado') {
                swal({
                    title: "Usuario Creado!",
                    text: "usuario creado correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }

            if (response == 'editado') {
                swal({
                    title: "Usuario Actualizado!",
                    text: "usuario actualizado correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }

            $('#usuario_data').DataTable().ajax.reload(); 
            $("#ModalNuevoUsuario").modal('hide');
           
        })
        e.preventDefault();
    

    })



    function validarSoloLetrasNombre(){
        $('#usuario_nombre').on("input", function() {
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
    
    function validarSoloLetrasApellidos(){
        $('#usuario_apellidos').on("input", function() {
            var input = $(this).val();
            var reges = /^[a-zA-Z\s]*$/;
            
    
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


function LlenarSelectRol() {
    funcion = "LlenarRoles"
    $.post('../../controllers/UsuarioController.php', {funcion}, (response)=>{
        // console.log(response);
        const roles = JSON.parse(response);
        let template='';
        roles.forEach(rol => {
            template+=`
                <option value="${rol.id}">${rol.rol}</option>
            `;
        });
        // console.log(template);
        $('#roles').html(template);
    })
}

function LlenarSelectSucursal() {
    funcion = "LlenarSelectSucursal"
    $.post('../../controllers/UsuarioController.php', {funcion}, (response)=>{
        // console.log("sucursales");
        // console.log(response);
        const sucursales = JSON.parse(response);
        let template='';
        sucursales.forEach(sucursal => {
            template+=`
                <option value="${sucursal.id}">${sucursal.nombre}</option>
            `;
        });
        // console.log(template);
        $('#sucursal').html(template);
    })
}


function Editar(usuario_id) {
    edit = true;
    
    $('#labelTitulo').html('Editar Registro');
    let funcion = "Obtener_Usuarios_x_id"
    $.post("../../controllers/UsuarioController.php", {funcion, usuario_id}, (response)=>{
        // console.log(response);
        
        response = JSON.parse(response);
        $('#usuario_nombre').val(response.usuario_nombre);
        $('#usuario_apellidos').val(response.usuario_apellido);
        $('#usuario_password').val(response.usuario_password);
        $('#usuario_correo').val(response.usuario_correo);
        $('#roles').val(response.rol_id);
        $('#sucursal').val(response.sucursal_id);
        $('#usuario_id').val(response.usuario_id);
        
    }); 
    $('#ModalNuevoUsuario').modal('show');
    
}

$(document).on("click", "#btnNuevoUsuario", function() {
    console.log("Nuevo usuario");
    edit = false;
    $('#labelTitulo').html('Nuevo Usuario');
    $('#usuario-form')[0].reset();

    $('#ModalNuevoUsuario').modal('show');

})



function Eliminar(usuario_id) {
    swal({
        title: "Soporte Tecnico",
        text: "Estas seguro de eliminar el usuario?",
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
            console.log(usuario_id);    
            $.post("../../controllers/UsuarioController.php", {funcion, usuario_id}, (response)=>{
                console.log(response);
                if (response.includes('delete')) {
                    $('#usuario_data').DataTable().ajax.reload();

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



