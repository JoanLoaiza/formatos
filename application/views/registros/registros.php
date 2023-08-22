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
                            <small class="form-text text-dark float-end">Presione <b>ENTER</b> para buscar</small>
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
                    <div class="btn-group m-2" role="group" aria-label="Basic example">
                        <button type="buttons" id="btnLimpiar" onclick="limpiarForm();"
                            class="btn btn-danger btn-block">Cancelar</button>
                        <button type="buttons" id="btnGuardar" onclick="guardarRegistro();"
                            class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card boder border-dark shadow">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title" style="font-size: 1.2rem;">Registros <?= date('d-m-Y'); ?>
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
<?php $this->load->view('registros/script/script_registro'); ?>