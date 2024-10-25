
var id_usuario = document.getElementById('user_idx').value;
console.log("INFORMACION PERFIL");
obtenerDatosPerfil();


function obtenerDatosPerfil() {
    var funcion = "obtenerDatosPerfil";
    $.post("../../controllers/perfilController.php", {funcion, id_usuario}, (response)=>{
        var responses = JSON.parse(response);

        $('#nombrePerfil').html(responses.usuario_nombre + ' ' + responses.usuario_apellidos);
        $('#correoPerfil').html(responses.usuario_correo);
        
        $('#edadPerfil').html(responses.edad);
        $('#telefonoPerfil').html(responses.telefono);
        $('#direccionPerfil').html(responses.direccion);
        $('#generoPerfil').html(responses.genero);


    });
        
}    




