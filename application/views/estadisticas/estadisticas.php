<div class="content-inner w-100">
    <!-- Page Header-->
    <header class="bg-white shadow-sm px-4 py-3 z-index-20">
        <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Reportes</h2>
        </div>
    </header>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="btn-group btn-group-sm mt-1 position-relative" role="group" aria-label="Basic example">
                        <button class="btn btn-primary btn-block" id="v-pills-all-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-all" type="button" role="tab" aria-controls="v-pills-all"
                            aria-selected="true" onclick="mostrarContenido('')">Todas las
                            reuniones</button>
                        <button class="btn btn-success btn-block" title="Descargar registros en formato Excel"
                            onclick="descargarExcel('tabla-registros-')"><i class="fas fa-file-excel"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php $total = 0; foreach ($registros_reunion as $report) { $total += $report->cantidad_registros; } echo $total; ?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    </div>

                    <?php foreach ($registros_reunion as $report) :?>
                    <div class="btn-group btn-group-sm mt-1 position-relative" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning" title="Editar nombre registro"
                            onclick="editarNombreReunion(<?php echo $report->id_reunion; ?>)"><i
                                class="fas fa-edit"></i></button>
                        <button class="btn btn-primary btn-block"
                            id="v-pills-<?php echo $report->fecha_registro; ?>-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-<?php echo $report->fecha_registro; ?>" type="button" role="tab"
                            aria-controls="v-pills-<?php echo $report->fecha_registro; ?>" aria-selected="true"
                            onclick="mostrarContenido('<?php echo $report->fecha_registro; ?>')">
                            <?php echo $report->nombre_reunion . ' ' .$report->fecha_registro; ?>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $report->cantidad_registros; ?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="col">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="alert alert-warning d-none" role="alert">
                        No ha seleccionado una fecha para mostrar!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalRegistro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRegistroLabel">Nuevo registro para la fecha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodymodalRegistro">
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
                    <div class="form-outline">
                        <label class="form-label" for="direccion">Dirección</label>
                        <input type="text" id="direccion" class="form-control" />
                    </div>
                    <div class="form-group">
                        Se le compartió hoja
                        <input type="checkbox" name="hoja" id="hoja"><br>
                    </div>
                    <input type="hidden" id="fecha_modal">
                    <input type="hidden" id="id">
                </div>
                <div class="modal-body d-none" id="bodymodalRegistroReunion">
                    <div class="form-outline">
                        <label class="form-label" for="nombre_reunion">Nombre reunión</label>
                        <input type="text" id="nombre_reunion" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between align-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('registros/script/script_registro'); ?>
<?php $this->load->view('estadisticas/script/script_estadisticas'); ?>