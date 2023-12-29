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
                <input type="password" name="admin[password]" id="contrasena" placeholder="Tu contraseña"
                value="<?php echo s( $admin->password )?>">

            </fieldset>
            <input type="submit" value="Iniciar sesión" class="boton-verde-block">
        </form>
    </main>