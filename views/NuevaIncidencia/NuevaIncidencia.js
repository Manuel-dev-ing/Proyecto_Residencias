$(document).ready(function() {
    LlenarComboPrioridad(); 
    LlenarComboCategorias();
    validarSoloLetras();
    
    $("#Form_CrearIncidencia").submit(function(e){
        e.preventDefault();
        var form = document.getElementById('Form_CrearIncidencia');
        var archivos = document.getElementById('archivo');
        var totalArchivos = archivos.files.length;
        var formData = new FormData(form);

        console.log("archivo: ");
        console.log(archivos.files);
        if ($('#incidencia_descripcion').summernote('isEmpty') || $("#incidencia_titulo").val() == '') {
            swal("Advertencia!","Campos Vacios", "warning");
            
       } else {
     
            for (let i = 0; i < totalArchivos; i++) {
                formData.append("files[]", archivos.files[i]);
                // console.log("archivos formdata");
                // console.log(archivos.files[i]);
            }
            
          
            $.ajax({
                url: "../../controllers/incidenciaArchivosController.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos){
                    alert("Se ha enviado satisfactoriamente");
                    console.log("datos: ");
                    console.log(datos);
                    $('#incidencia_titulo').val('');
                    $('#archivo').val('');
                    $('#incidencia_descripcion').summernote('reset');
                    swal({
                        title: "Guardado Correctamente!",
                        text: "Soporte Tecnico se pondra en contacto contigo",
                        type: "success",
                        confirmButtonClass: "btn-success"
                    });

                },
                error: function(error) {
                    alert("Tienes un error....");
                    console.log(error);
                }

            });

        }

    });

    function LlenarComboCategorias() {
        funcion = "LlenarComboCategorias";
        $.post('../../controllers/categoriaController.php',{funcion}, (response)=>{
            // console.log(response);
            const categorias = JSON.parse(response);
            let template='';
            categorias.forEach(categoria => {
                template+=`
                    <option value="${categoria.id}">${categoria.nombre}</option>
                `;
            });
            $('#categoria').html(template);
        })
    }
    function LlenarComboPrioridad() {
        funcion = "LlenarComboPrioridad";
        $.post('../../controllers/prioridadController.php',{funcion}, (response)=>{
            // console.log(response);
            const prioridad = JSON.parse(response);
            let template='';
            prioridad.forEach(priori => {
                template+=`
                    <option value="${priori.id}">${priori.nombre}</option>
                `;
            });
            $('#prioridad').html(template);
        })
    }
    
    $('#incidencia_descripcion').summernote({
        height: 200,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]

    });

    function validarSoloLetras(){
        $('#incidencia_titulo').on("input", function() {
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



        // var totalArchivos = $("#archivo").val().length;
        // let id_usuario = $("#usuario_id").val();
        // let categoria_id = $("#categoria").val();
        // let incidencia_titulo = $("#incidencia_titulo").val();
        // let incidencia_descripcion = $("#incidencia_descripcion").val();
        // const archi = archivos[0].files;
        // console.log(archivosArr);

          // for (let i = 0; i < archivos.length; i++) {
            //     formData.append("files", $("#archivo")[0].files[i]);
                
                
            // }
    
            // funcion = "crear";
            // $.post('../../controllers/incidenciaController.php',{id_usuario, categoria_id, incidencia_titulo, incidencia_descripcion, funcion, formData},(response)=>{
            //     // $('#incidencia_titulo').val('');
            //     // $('#incidencia_descripcion').summernote('reset');
            //     // swal("Correcto!","Registrado Correctamente", "success");
            //     console.log("Archivos: ");
            //     console.log(response);
            // })


