<div class="login-page">
    <div class="container d-flex align-items-center position-relative py-5">
        <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
            <div class="card-body p-0">
                <div class="row gx-0 align-items-stretch">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6 d-none d-sm-block d-md-block d-lg-block bg-primary text-white">
                        <div class="info d-flex justify-content-center flex-column p-4 h-100">
                            <div class="py-5">
                                <h1 class="display-6 fw-bold">Registro de asistencia</h1>
                                <p class="fw-light mb-0">Sistema de registro de asistencias para la campaña
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6 bg-white">
                        <div class="d-flex align-items-center px-4 px-lg-5 h-100">
                            <div class="login-form py-5 w-100">
                                <div class="input-material-group mb-3">
                                    <input class="input-material" id="login-username" type="text" name="loginUsername"
                                        autocomplete="off" required data-validate-field="loginUsername">
                                    <label class="label-material" for="login-username">Usuario</label>
                                </div>
                                <div class="input-material-group mb-4">
                                    <input class="input-material" id="login-password" type="password"
                                        name="loginPassword" required data-validate-field="loginPassword">
                                    <label class="label-material" for="login-password">Contraseña</label>
                                </div>
                                <button class="btn btn-primary mb-3" id="login">Ingresar</button><br><a
                                    class="d-none text-sm text-paleBlue" href="#">Olvidaste la contraseña?</a><br><small
                                    class="d-none text-gray-500">No tienes una cuenta? </small><a
                                    class="d-none text-sm text-paleBlue" href="register.html">Registrate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('auth/script/script_login'); ?>