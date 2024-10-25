console.log("index login");


function MostrarContrasena() {
    var pass = document.getElementById('usuario_pass');
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password"
    }

 

}
