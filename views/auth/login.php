    <main class="contenedor seccion">
        <h1>Iniciar sesión</h1>
        <?php foreach ($errores as $error):?>
            <div class="alerta error">
            <?php echo $error ?>
            </div>
        <?php endforeach; ?>
        <form method="POST" class="formulario contenido-centrado" action="/login">
            <fieldset>
                <legend>Datos de inicio</legend>

                <label for="email">E-mail:</label>
                <input type="email" name="admin[email]" id="email" placeholder="Tu correo electrónico"
                value="<?php echo s( $admin->email )?>">

                <label for="contrasena">Contraseña:</label>
                <div class="contrasena-campo">
                    <input type="password" name="admin[password]" id="contrasena" placeholder="Tu contraseña"
                    value="<?php echo s( $admin->password )?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-filled" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6f32be" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22 .379l.045 .1l.03 .083l.014 .055l.014 .082l.011 .1v.11l-.014 .111a.992 .992 0 0 1 -.026 .11l-.039 .108l-.036 .075l-.016 .03c-2.764 4.836 -6.3 7.38 -10.555 7.499l-.313 .004c-4.396 0 -8.037 -2.549 -10.868 -7.504a1 1 0 0 1 0 -.992c2.831 -4.955 6.472 -7.504 10.868 -7.504zm0 5a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" stroke-width="0" fill="currentColor" />
                    </svg>
                </div>
            </fieldset>
            <input type="submit" value="Iniciar sesión" class="boton-verde-block">
        </form>
    </main>