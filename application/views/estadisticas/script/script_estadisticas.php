<script>
$(document).ready(function() {
    mostrarContenido();
});

function mostrarContenido(fecha = null) {
    $.ajax({
        url: '<?= base_url('registros/Registros/listarRegistros');?>',
        type: 'POST',
        dataType: 'json',
        data: {
            fecha: fecha,
            todos: fecha == '' || fecha == null ? true : false
        },
        success: function(data) {
            // Crear el contenido de la tabla
            var tableContent = '';
            for (var i = 0; i < data.length; i++) {
                tableContent += `
                    <tr class="text-center">
                        <td>${i+1}</td>
                        <td>${data[i].documento}</td>
                        <td>${data[i].nombre}</td>
                        <td>${data[i].telefono}</td>
                        <td>${data[i].direccion}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm btn-default" title="Editar"
                            onclick="getRegistro(${data[i].id}, ${true})">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                    </tr>`;
            }
            let fecha_registro = data[0].fecha_registro;

            // Crear el contenido del tab
            var tabContent = `
                <div class="tab-pane fade show active shadow" id="v-pills-${fecha || ''}" role="tabpanel" aria-labelledby="v-pills-${fecha ||''}-tab">
                    <div class="table-responsive rounded" style="overflow-y: auto; max-height: 100vh; background-color: #fff;">
                        <table class="table table-striped table-hover table-sm" style="width: 100%;" id="tabla-registros-${fecha || ''}">
                                <thead class="table-dark sticky-header">
                                    <tr class="${fecha || 'd-none'}">
                                        <th colspan="6">Reunión ${fecha || ''} <button class="btn btn-sm btn-success" title="Descargar registros en formato Excel" onclick="descargarExcel('tabla-registros-${fecha || ''}')"><i class="fas fa-file-excel"></i></button>
                                            <button class="btn btn-primary btn-sm btn-default float-end" title="Añadir una persona a la fecha" onclick="loadModal('${fecha_registro}')">
                                                <i class="fa-solid fa-user-plus fa-xs"></i>
                                            </button>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col">Editar</th>
                                    </tr>
                                </thead>
                                <tbody>${tableContent}</tbody>
                        </table>
                    </div>
                </div>`;

            // Limpiar el contenido actual del tab y luego agregar el nuevo contenido
            $('#v-pills-tabContent').empty().append(tabContent);
        },
        error: function(error) {
            console.log(error);
        }
    });
}
function descargarExcel(nombreTabla) {
    var table = document.getElementById(nombreTabla);
    // Elimina la última columna de la tabla antes de generar el libro Excel
    var rows = table.rows;
    for (var i = 0; i < rows.length; i++) {
        rows[i].deleteCell(-1); // Elimina la última celda de cada fila
    }
    var wb = XLSX.utils.table_to_book(table, {
        sheet: "Sheet JS"
    });
    XLSX.writeFile(wb, "Registros.xlsx");
}


function loadModal(fecha) {
    $('#btnGuardar').attr('onclick', 'guardarRegistro()').removeClass(
            'btn-warning')
        .addClass('btn-primary')
        .html('Guardar');
    $('#modalRegistro').modal('show');
    $('#fecha_modal').val(fecha);
}
</script>