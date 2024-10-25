$(document).ready(function() {
    
    var incidencia_id = getUrlParameter('ID'); 

    let funcionn = "listarDocumentos";
    tabla=$('#documentos-data').dataTable({
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
            url: '../../controllers/documentosController.php',
            type : "post",
            dataType : "json",	 
            data:{ funcionn : funcionn, incidencia_id: incidencia_id},						
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



    ListarIncidenciaxId(incidencia_id)
    ListarIncidenciaDetalle(incidencia_id)

    $(document).on("click", "#btnEnviar", (e)=> {
        var funcion = "enviarIncidencia";
        var incidencia_id = getUrlParameter('ID'); 
        var usuario_id = $("#user_idx").val();
        var incidencia_descripcion = $("#Detalleincidencia_descripcion").val();
        
        

        if ($('#Detalleincidencia_descripcion').summernote('isEmpty')) {
            swal("Advertencia!","La descripcion esta vacia", "warning");
            
        } else {

            
            $.post("../../controllers/incidenciaController.php", {incidencia_id, funcion, usuario_id, incidencia_descripcion}, (response)=>{
                ListarIncidenciaDetalle(incidencia_id)
                if (response.includes('add')) {
                    $('#Detalleincidencia_descripcion').summernote('reset');
                    swal("Correcto!","Registrado Correctamente", "success");
                }
            });
        }
    })


    function ListarIncidenciaDetalle(incidencia_id) {
        console.log("Listar_incidenciaDetalle: ", incidencia_id);
        
        let funcion = "Listar_incidenciaDetalle";
        
        $.post("../../controllers/incidenciaController.php", {incidencia_id : incidencia_id, funcion: funcion}, function (data) {
    
            $('#lbldetalle').html(data);
        })
    }

    function ListarIncidenciaxId(incidencia_id) {
        let funcion = "mostrar";
        
        $.post("../../controllers/incidenciaController.php", {incidencia_id : incidencia_id, funcion: funcion}, function (data) {

            data = JSON.parse(data);
            
            $('#lblestado').html(data.incidencia_estado);
            // $('#lblsucursal').html("Sucursal " + data.sucursal);
            $('#lblnombreusuario').html(data.usuario_nombre + ' ' + data.usuario_apellido);
            $('#lblfecha').html(data.fecha_creacion);
            $('#lbldetalleIncidencia').html("Detalle de la Incidencia - " + "Nro. Incidencia - " + data.incidencia_id);
            
            $('#categoria_nombre').val(data.categoria_nombre)
            $('#incidencia_titulo').val(data.incidencia_titulo)
            $('#Usudescripcion').summernote('code', data.incidencia_descripcion)

            console.log("Estado: " + data.incidencia_estado_texto);

            if (data.incidencia_estado_texto == "Cerrado") {
                $('#panelDetalle').hide();
            }
            
        })

        $('#Usudescripcion').summernote({
            height: 400,
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

        $('#Usudescripcion').summernote('disable')
        
    }
    
    $('#Detalleincidencia_descripcion').summernote({
        height: 200

    });

    $(document).on("click", "#btnCerrar", function() {
        
        swal({
                title: "Soporte Tecnico",
                text: "Estas seguro de Cerrar?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-warning",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: false
                
            },
            function(isConfirm) {
                if (isConfirm) {
                    let funcion = "ActualizarEstadoIncidencia";
                    var usuario_id = $("#user_idx").val();

                    $.post("../../controllers/incidenciaController.php", {incidencia_id, funcion, usuario_id}, (response)=>{
                        console.log(response);
                        // if (response.includes('Cerrado')) {
                        //     $('#Detalleincidencia_descripcion').summernote('reset');
                        // }
                    }); 
                    ListarIncidenciaDetalle(incidencia_id)
                    ListarIncidenciaxId(incidencia_id)

                    swal({
                        title: "Incidencia Cerrada!",
                        text: "Incidencia eliminada correctamente",
                        type: "success",
                        confirmButtonClass: "btn-success"
                    });
                } 
            });


    })





    
});

    

   

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1]
            }
        }    
    };









