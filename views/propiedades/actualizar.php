<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton-verde">Volver</a>
    
    <!-- Elementos de error -->
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error ?>
    </div>
    <?php endforeach ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php include __DIR__  . "/formulario.php"; ?>

        <input type="submit" class="boton-verde" value="Actualizar propiedad">
    </form>
</main>