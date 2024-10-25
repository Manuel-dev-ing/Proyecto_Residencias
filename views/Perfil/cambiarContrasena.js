$(document).ready(function () {
    
   

    $(document).on("click", "#btnCambiarContrasena", function() {
        var contrasenaActual = $("#contrasenaActual").val();
        var contrasenaNueva = $("#nuevaContrasena").val();
        var repetirNuevaContrasena = $("#repetirNuevaContrasena").val();
        var id_usuario = document.getElementById('user_idx').value; 

        var funcion = "existeContrasena";
        console.log('conttrasena Actual: ', contrasenaActual);
        console.log('id: ', id_usuario);
        
        if (contrasenaActual === '' || contrasenaNueva === '' || repetirNuevaContrasena === '') {
            
            swal({
                title: "Campos Vacios!",
                text: "los campos son requeridos ",
                type: "warning",
                confirmButtonClass: "btn-success"
            });
 
        }else{

            $.post("../../controllers/perfilController.php", {funcion, contrasenaActual, id_usuario}, (response)=>{
                var responses = JSON.parse(response);
                console.log("response: ", responses);
    
                if (responses == 'NotFound') {
                    $("#contrasenaActual").css('border-color', 'red');
    
                    $("#spanPassword").show();
    
                    setTimeout(() => {
                        $("#contrasenaActual").css('border-color', 'grey');
                        
                        $("#spanPassword").hide();         
                    }, 5000)    
                }      
    
                if (repetirNuevaContrasena != contrasenaNueva) {
                    $("#spanPassword-repeatpass").show();
                    $("#repetirNuevaContrasena").css('border-color', 'red');
                    setTimeout(() => {
                        $("#repetirNuevaContrasena").css('border-color', '');
                        
                        $("#spanPassword-repeatpass").hide();         
    
                    }, 5000);

                }else{
                    let funcion = "cambiarContrasena";
                    $.post("../../controllers/perfilController.php", {funcion, repetirNuevaContrasena, id_usuario}, (response)=>{
                        console.log("Cambiar Contrasena: ");
                        console.log(response);
                        if (response.includes('ContrasenaCambiada')) {
                            
                            $("#contrasenaActual").val("");
                            $("#nuevaContrasena").val("");
                            $("#repetirNuevaContrasena").val("");
                            console.log('ContrasenaCambiada');
                            
                        }    
                    });
                }
    
                console.log(responses);
                console.log(responses.usuario_password);
     
            }); 
        }

        console.log("contrasenaActual: ", contrasenaActual);
        console.log("contrasenaNueva: ", contrasenaNueva);
        console.log("repetirNuevaContrasena: ", repetirNuevaContrasena);
    
    
    })



})