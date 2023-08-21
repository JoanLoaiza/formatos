<div class="content-inner w-100">
    <!-- Page Header-->
    <header class="bg-white shadow-sm px-4 py-3 z-index-20">
        <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Configuración</h2>
        </div>
    </header>
    <div class="container-fluid">
        <!-- Pie Charts -->
        <div class="row mt-2">
            <div class="col-xl-4 col-lg-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header bg-dark py-3">
                        <h6 class="m-0 font-weight-bold text-white">Nuevo mensaje</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>NOTA: </strong> La siguiente palabra <strong>$USUARIO</strong> se reemplazará por el
                            nombre del usuario en el mensaje.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="form-outline">
                            <label class="form-label" for="asunto">Asunto</label>
                            <input type="text" id="asunto" class="form-control" />
                        </div>
                        <div class="form-outline">
                            <label class="form-label" for="mensaje">Mensaje</label>
                            <textarea class="form-control" id="mensaje" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="btn-group m-2" role="group">
                        <button type="button" class="btn btn-danger btn-block" id="btnCancelar">Cancelar</button>
                        <button type="button" class="btn btn-primary btn-block" id="btnGuardar"
                            onclick="guardarMensaje()">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header bg-dark py-3">
                        <h6 class="m-0 font-weight-bold text-white">Mensajes configurados </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive rounded">
                            <table class="table table-sm table-bordered table-hover" id="tablaMensajesConfigurados"
                                style="width: 100%;">
                                <thead class="bg-dark text-white text-center">
                                    <tr>
                                        <th>Asunto</th>
                                        <th>Mensaje</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpoTablaMensajesConfigurados">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    listarMensajesConfigurados();

    $('#btnCancelar').click(function() {
        $('#asunto').val('');
        $('#mensaje').val('');
        $('#btnGuardar').attr('onclick', 'guardarMensaje()').removeClass('btn-warning')
            .addClass('btn-primary').html('Guardar');
    })
});

function listarMensajesConfigurados() {
    $.ajax({
        url: '<?=base_url('confi/Configuracion/listarMensajesConfigurados')?>',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            $('#cuerpoTablaMensajesConfigurados').html(html);
            if (data.length > 0) {
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<tr>';
                    html += '<td class="text-center">' + data[i].asunto + '</td>';
                    html += '<td>' + data[i].mensaje + '</td>';
                    html += '<td class="text-center">';
                    html += '<div class="btn-group" role="group" aria-label="Basic example">';
                    html +=
                        '<button type="button" class="btn btn-warning btn-sm" title="Editar mensaje" onclick="getMensaje(' +
                        data[i].id + ')"><i class="fas fa-edit"></i></button>';
                    html +=
                        '<button type="button" class="btn btn-danger btn-sm" title="Eliminar mensaje" onclick="eliminarMensaje(' +
                        data[i].id + ')"><i class="fas fa-trash"></i></button>';
                    html +=
                        '<button type="button" class="btn btn-success btn-sm" title="Enviar mensaje masivo" onclick="enviarMensajeMasivo(' +
                        data[i].id + ')"><i class="fas fa-paper-plane"></i></button>';
                    html += '</div></td>';
                    html += '</tr>';
                }
                $('#cuerpoTablaMensajesConfigurados').html(html);
            } else {
                $('#cuerpoTablaMensajesConfigurados').html(
                    '<tr><td colspan="3" class="text-center">No hay mensajes configurados</td></tr>');
            }
        }
    });
}

function guardarMensaje() {
    let asunto = $('#asunto').val();
    let mensaje = $('#mensaje').val();
    if (asunto == '' || mensaje == '') {
        alerta('warning', 'Debe llenar todos los campos');
    } else {
        $.ajax({
            url: '<?=base_url('confi/Configuracion/guardarMensaje')?>',
            type: 'POST',
            dataType: 'json',
            data: {
                asunto: asunto,
                mensaje: mensaje
            },
            success: function(data) {
                if (data == true) {
                    alerta('success', 'Exito', 'Mensaje guardado correctamente');
                    listarMensajesConfigurados();
                    $('#asunto').val('');
                    $('#mensaje').val('');
                } else {
                    alerta('error', 'Error', 'Error al guardar el mensaje');
                }
            }
        });
    }
}

function getMensaje(id) {
    $.ajax({
        url: '<?=base_url('confi/Configuracion/getMensaje')?>',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id
        },
        success: function(data) {
            $('#asunto').val(data.asunto);
            $('#mensaje').val(data.mensaje);
            $('#btnGuardar').attr('onclick', 'editarMensaje(' + data.id + ')').removeClass('btn-primary')
                .addClass('btn-warning').html('Editar');
        }
    });
}

function editarMensaje(id) {
    let asunto = $('#asunto').val();
    let mensaje = $('#mensaje').val();
    if (asunto == '' || mensaje == '') {
        alerta('warning', 'Debe llenar todos los campos');
    } else {
        $.ajax({
            url: '<?=base_url('confi/Configuracion/editarMensaje')?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                asunto: asunto,
                mensaje: mensaje
            },
            success: function(data) {
                if (data == true) {
                    alerta('success', 'Exito', 'Mensaje editado correctamente');
                    listarMensajesConfigurados();
                    $('#asunto').val('');
                    $('#mensaje').val('');
                    $('#btnGuardar').attr('onclick', 'guardarMensaje()').removeClass('btn-warning')
                        .addClass('btn-primary').html('Guardar');
                } else {
                    alerta('error', 'Error', 'Error al editar el mensaje');
                }
            }
        });
    }
}

function eliminarMensaje(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este mensaje?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?=base_url('confi/Configuracion/eliminarMensaje')?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data == true) {
                        alerta('success', 'Exito', 'Mensaje eliminado correctamente');
                        listarMensajesConfigurados();
                    } else {
                        alerta('error', 'Error', 'Error al eliminar el mensaje');
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason
            .backdrop || result.dismiss === Swal.DismissReason.esc) {
            alerta('info', 'Información', 'No se ha eliminado el mensaje', 1000);
        }
    })
}

async function enviarMensajeMasivo() {
    alerta('warning', 'Información', 'Esta función se encuentra en desarrollo');
    return false;
    Swal.fire({
        title: '¿Está seguro de enviar este mensaje a todos los usuarios?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Si, enviar',
        cancelButtonText: 'No, cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('confi/Configuracion/enviarMensajeMasivo')?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data == true) {
                        alerta('success', 'Exito', 'Mensaje enviado correctamente');
                    } else {
                        alerta('error', 'Error', 'Error al enviar el mensaje');
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason
            .backdrop || result.dismiss === Swal.DismissReason.esc) {
            alerta('info', 'Información', 'No se ha enviado el mensaje', 1000);
        }
    })
}
</script>