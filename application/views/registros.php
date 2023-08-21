<div class="content-inner w-100">
    <!-- Page Header-->
    <header class="bg-white shadow-sm px-4 py-3 z-index-20">
        <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Inicio</h2>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="card border border-dark">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title" style="font-size: 1.2rem;">Nuevo registro</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-outline">
                            <label class="form-label" for="documento">N° documento</label>
                            <input type="text" id="documento" class="form-control" />
                        </div>
                        <div class="form-outline">
                            <label class="form-label" for="nomre_completo">Nombre completo</label>
                            <input type="text" id="nomre_completo" class="form-control" />
                        </div>
                        <div class="form-outline">
                            <label class="form-label" for="telefono">Telefono</label>
                            <input type="text" id="telefono" class="form-control" />
                        </div>
                        <label class="form-label" for="direccion">Dirección</label>
                        <div class="form-outline">
                            <input type="text" id="direccion" class="form-control" />
                        </div>
                        <div class="form-group">
                            Se le compartió hoja
                            <input type="checkbox" name="hoja" id="hoja"><br>
                        </div>
                    </div>
                    <button type="buttons" id="btnGuardar" onclick="guardarRegistro();"
                        class="m-2 btn btn-primary btn-block">Guardar</button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card boder border-dark shadow">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title" style="font-size: 1.2rem;">Registros
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <span id="cantidad"></span>
                                <span class="visually-hidden">Cantidad de registros</span>
                            </span>
                        </h3>
                    </div>
                    <div class="card-body border border-dark shadow" style="height: 80vh;">
                        <div class="table-responsive rounded">
                            <table class="table table-bordered table-hover table-sm table-striped" id="tableRegistros"
                                style="width: 100%; font-size: 0.8rem;">
                                <thead class="bg-dark text-white">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>N° doc.</th>
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Dirección</th>
                                        <th>Hoja</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaRegistros" class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="id">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.6/dataTables.bootstrap5.min.js"
    integrity="sha512-5rbrNGcjwSM6QsgvTO4USzLW98mfdXKsM807ENaySDbgb4PCZkrf3pwZkcBo9wXpUC89XvJIwPN+FoT9TOFp9w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
listarRegistros();

function guardarRegistro() {
    var documento = $('#documento').val();
    var nombre_completo = $('#nomre_completo').val();
    var telefono = $('#telefono').val();
    var direccion = $('#direccion').val();
    var hoja = $('#hoja').is(':checked') ? 1 : 0;
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
                hoja: hoja
            },
            success: function(data) {
                if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.error,
                    })
                    return false;
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: 'Registro guardado correctamente!',
                })
                listarRegistros();
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
    $('#tableRegistros').DataTable({
        destroy: true,
        responsive: true,
        info: false,
        paging: false,
        scrollY: '65vh',
        scrollX: true,
        searching: false,
        ajax: {
            url: '<?php echo base_url('registros/Registros/listarRegistros');?>',
            type: 'POST',
            dataType: 'json',
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.log("Response:", xhr.responseText);
            }
        },
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
}

function getRegistro(data) {
    $.ajax({
        url: '<?= base_url('registros/Registros/getRegistro');?>',
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(data) {
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
            $('#btnGuardar').attr('onclick', 'editarRegistro()').removeClass('btn-primary').addClass(
                'btn-warning').html('<i class="fas fa-edit"></i> Editar');
        }
    })
}

function editarRegistro() {
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
                    listarRegistros();
                    $('#documento').val('');
                    $('#nomre_completo').val('');
                    $('#telefono').val('');
                    $('#direccion').val('');
                    $('#hoja').prop('checked', false);
                    $('#btnGuardar').attr('onclick', 'guardarRegistro()').removeClass('btn-warning')
                        .addClass('btn-primary')
                        .html('Guardar');
                } else {
                    alerta('error', 'Error', 'No se pudo actualizar el registro')
                }
            }
        })
    }
}
</script>