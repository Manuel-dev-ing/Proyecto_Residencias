$(document).ready(function () {
    id_usuario = document.getElementById('user_idx').value;
    

    console.log("EDITAR PERFIL CON ID de usuario: ", id_usuario);

    
    var funcion = "obtenerDatosPerfil";
    $.post("../../controllers/perfilController.php", {funcion, id_usuario}, (response)=>{
        responses = JSON.parse(response);
        // console.log(response);

        $('#id_usuario').val(responses.usuario_id);
        $('#nombre_usuario').val(responses.usuario_nombre);
        $('#apellido_usuario').val(responses.usuario_apellidos);
        $('#correo_usuario').val(responses.usuario_correo);
        $('#edad_usuario').val(responses.edad);
        $('#telefono_usuario').val(responses.telefono);
        $('#direccion_usuario').val(responses.direccion);
        $('#genero_usuario').val(responses.genero);


    });        
    
    

    $(document).on("click", "#guardarCambios", function() {
        var id_user= $('#id_usuario').val();
        var nombre_usuario =  $('#nombre_usuario').val();
        var apellido_usuario =  $('#apellido_usuario').val();
        var correo_usuario = $('#correo_usuario').val();
        var edad_usuario = $('#edad_usuario').val();
        var telefono_usuario = $('#telefono_usuario').val();
        var direccion_usuario = $('#direccion_usuario').val();
        var genero_usuario = $('#genero_usuario').val();

        var funcion = "guardarCambios";
        $.post("../../controllers/perfilController.php", {funcion, id_user, nombre_usuario, apellido_usuario, correo_usuario, edad_usuario, telefono_usuario, direccion_usuario, genero_usuario}, (response)=>{
            console.log(response);

            if (response == 'editado') {
                obtenerDatosPerfil();
                swal({
                    title: "Usuario Actualizado!",
                    text: "usuario actualizado correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }

        })

    })





})



