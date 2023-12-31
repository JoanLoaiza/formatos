<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.6/dataTables.bootstrap5.min.js"
    integrity="sha512-5rbrNGcjwSM6QsgvTO4USzLW98mfdXKsM807ENaySDbgb4PCZkrf3pwZkcBo9wXpUC89XvJIwPN+FoT9TOFp9w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    listarRegistros();

    $('#documento').on('keyup', function(e) {
        if (e.keyCode == 13) { //
            validarPersona();
        }
    });

    //Validar si hay una reunión activa en el sessionStorage
    if (sessionStorage.getItem('id_reunion') != null) {
        $('#nombreReunion').val(sessionStorage.getItem('nombre_reunion'));
        $('#nombreReunion').prop('readonly', true);
        $('#btnGuardarReunion').removeClass('btn-primary').addClass('btn-danger').html(
            '<i class="fas fa-times"></i> Finalizar').attr('onclick', 'finalizarReunion()');
        $('#id_reunion').val(sessionStorage.getItem('id_reunion'));
    }
});

function guardarReunion(nombreReunion = null) {
    let nombre_reunion = $('#nombreReunion').val() ?? nombreReunion;
    if (nombre_reunion == '') {
        alerta('error', 'Error', 'El nombre de la reunión es obligatorio');
        return false;
    }

    $.ajax({
        url: '<?= base_url('registros/Registros/guardarReunion');?>',
        type: 'POST',
        dataType: 'json',
        data: {
            nombre_reunion: nombre_reunion
        },
        success: function(data) {
            if (data) {
                $('#id_reunion').val(data);
                $('#nombreReunion').prop('readonly', true);
                $('#btnGuardarReunion').removeClass('btn-primary').addClass('btn-danger').html(
                    '<i class="fas fa-times"></i> Finalizar').attr('onclick', 'finalizarReunion()');
                alerta('success', 'Info', 'Se guardo la reunión');
                
                sessionStorage.setItem('id_reunion', data);
                sessionStorage.setItem('nombre_reunion', nombre_reunion);
            } else {
                alerta('error', 'Error', 'No se pudo guardar la reunión');
            }
        }
    })
}

function finalizarReunion(){
    sessionStorage.removeItem('id_reunion');
    sessionStorage.removeItem('nombre_reunion');

    $('#nombreReunion').val('').prop('readonly', false);
    $('#btnGuardarReunion').removeClass('btn-danger').addClass('btn-primary').html(
        '<i class="fas fa-save"></i> Guardar').attr('onclick', 'guardarReunion()');
    $('#id_reunion').val('');
    alerta('success', 'Info', 'Se finalizó la reunión');
}

async function guardarRegistro() {
    let documento = $('#documento').val();
    let nombre_completo = $('#nomre_completo').val();
    let telefono = $('#telefono').val();
    let direccion = $('#direccion').val();
    let hoja = $('#hoja').is(':checked') ? 1 : 0;
    let fecha_modal = $('#fecha_modal').length ? $('#fecha_modal').val() : null;
    let id_reunion = $('#id_reunion').val();
    let nombre_reunion = $('#nombreReunion').val();

    if (id_reunion == '' && nombre_reunion != '') {
        await guardarReunion(nombreReunion);
        id_reunion = $('#id_reunion').val();
    }

    if (documento == '' || nomre_completo == '' || telefono == '' || direccion == '') {
        alerta('error', 'Error', 'Todos los campos son obligatorios')
    } else {
        $.ajax({
            url: '<?=		base_url('registros/Registros/guardarNuevoRegistro');?>',
            type: 'POST',
            dataType: 'json',
            data: {
                documento: documento,
                nombre_completo: nombre_completo,
                telefono: telefono,
                direccion: direccion,
                hoja: hoja,
                fecha_modal: fecha_modal,
                id_reunion: id_reunion
            },
            success: function(data) {
                if (data.error) {
                    alerta('warning', 'La persona se registró hoy.');
                    limpiarForm();
                    return false;
                }
                alerta('success', 'Registro guardado correctamente!');
                listarRegistros();
                if ($('#fecha_modal').length) {
                    $('#modalRegistro').modal('hide');
                    mostrarContenido();
                    $('#fecha_modal').val('');
                }
                $('#documento').val('');
                $('#nomre_completo').val('');
                $('#telefono').val('');
                $('#direccion').val('');
                $('#hoja').prop('checked', false);
            }
        })
    }
}

function listarRegistros() {
    $.ajax({
        url: '<?php echo base_url('registros/Registros/listarRegistros');?>',
        type: 'POST',
        dataType: 'json',
        data: {
            fecha: '<?= date('Y-m-d');?>'
        },
        success: function(data) {
            if (data && data.length > 0) { // Verificar si hay datos válidos
                $('#tableRegistros').DataTable({
                    destroy: true,
                    responsive: true,
                    info: false,
                    paging: false,
                    scrollY: '65vh',
                    scrollX: true,
                    searching: false,
                    data: data,
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'documento'
                        },
                        {
                            data: 'nombre'
                        },
                        {
                            data: 'telefono'
                        },
                        {
                            data: 'direccion'
                        },
                        {
                            data: 'hoja',
                            render: function(data) {
                                if (data == 't') {
                                    return '<span class="badge bg-success">Si</span>';
                                } else {
                                    return '<span class="badge bg-danger">No</span>';
                                }
                            }
                        },
                        {
                            data: 'id',
                            render: function(data) {
                                return '<button type="button" class="btn btn-sm btn-warning" onclick="getRegistro(' +
                                    data + ')"><i class="fas fa-edit"></i></button>';
                            }
                        }
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    },
                    //contar la cantidad de registros de la base de datos
                    "footerCallback": function(row, data, start, end, display) {
                        $('#cantidad').html(data.length);
                    }
                });
            } else {
                //Añadir una fila a la tabla
                $('#tableRegistros tbody').html(
                    '<tr><td colspan="7" class="text-center">No hay registros</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.log("Response:", xhr.responseText);
        }
    })
}

function getRegistro(data, proviene = false) {
    $.ajax({
        url: '<?= base_url('registros/Registros/getRegistro');?>',
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(data) {
            if (proviene) $('#modalRegistro').modal('show');
            $('#documento').val(data.documento);
            $('#nomre_completo').val(data.nombre);
            $('#telefono').val(data.telefono);
            $('#direccion').val(data.direccion);
            $('#id').val(data.id);
            if (data.hoja == 't') {
                $('#hoja').prop('checked', true);
            } else {
                $('#hoja').prop('checked', false);
            }
            if (proviene) {
                $('#btnGuardar').attr('onclick', 'editarRegistro(true)').removeClass('btn-primary')
                    .addClass(
                        'btn-warning').html('<i class="fas fa-edit"></i> Editar');
            } else {
                $('#btnGuardar').attr('onclick', 'editarRegistro()').removeClass('btn-primary')
                    .addClass(
                        'btn-warning').html('<i class="fas fa-edit"></i> Editar');
            }
        }
    })
}

function editarRegistro(proviene = false) {
    let documento = $('#documento').val();
    let nombre_completo = $('#nomre_completo').val();
    let telefono = $('#telefono').val();
    let direccion = $('#direccion').val();
    let hoja = $('#hoja').is(':checked') ? true : false;
    let id = $('#id').val();
    if (documento == '' || nomre_completo == '' || telefono == '' || direccion == '') {
        alerta('error', 'Error', 'Todos los campos son obligatorios')
    } else {
        $.ajax({
            url: '<?= base_url('registros/Registros/editarRegistro');?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                documento: documento,
                nombre_completo: nombre_completo,
                telefono: telefono,
                direccion: direccion,
                hoja: hoja
            },
            success: function(data) {
                if (data == true) {
                    alerta('success', 'Exito', 'Registro actualizado correctamente')
                    if (proviene) {
                        $('#modalRegistro').modal('hide');
                        mostrarContenido();
                    } else {
                        listarRegistros();
                    }
                    $('#documento').val('');
                    $('#nomre_completo').val('');
                    $('#telefono').val('');
                    $('#direccion').val('');
                    $('#hoja').prop('checked', false);
                    $('#btnGuardar').attr('onclick', 'guardarRegistro()').removeClass(
                            'btn-warning')
                        .addClass('btn-primary')
                        .html('Guardar');
                } else {
                    alerta('error', 'Error', 'No se pudo actualizar el registro')
                }
            }
        })
    }
}

function validarPersona() {
    let documento = $('#documento').val();
    if (documento == '') {
        alerta('error', 'No hay datos para buscar');
        return false;
    }

    $.ajax({
        url: '<?= base_url('registros/Registros/getRegistro');?>',
        type: 'POST',
        dataType: 'json',
        data: {
            documento: documento
        },
        success: function(data) {
            if (data.documento) {
                $('#documento').val(data.documento);
                $('#nomre_completo').val(data.nombre);
                $('#telefono').val(data.telefono);
                $('#direccion').val(data.direccion);
                if (data.hoja == 't') {
                    $('#hoja').prop('checked', true);
                } else {
                    $('#hoja').prop('checked', false);
                }
            } else {
                $('#documento').addClass('is-valid');
            }
        }
    })
}

function limpiarForm() {
    $('#documento').val('');
    $('#nomre_completo').val('');
    $('#telefono').val('');
    $('#direccion').val('');
    $('#hoja').prop('checked', false);
    $('#btnGuardar').attr('onclick', 'guardarRegistro()').removeClass('btn-warning')
        .addClass('btn-primary')
        .html('Guardar');
}
</script>