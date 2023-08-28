<script type="text/javascript">
$(document).ready(function() {
    $('#login').click(function(e) {
        let username = $('#login-username').val();
        let password = $('#login-password').val();
        if (!username || !password) {
            alerta('error', 'Oops...', 'Debes ingresar un usuario y contraseña');
            return false;
        }
        $.ajax({
            url: '<?= base_url('auth/Login/initSession') ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                'login-username': username,
                'login-password': password
            },
            success: function(data) {
                if (data == true || data == 'true'){
                    window.location.href = '<?= base_url('reportes') ?>';
                } else {
                    alerta('error', '¡Error!', 'Usuario o contraseña incorrectos');
                }
            }
        });
    });
});
</script>