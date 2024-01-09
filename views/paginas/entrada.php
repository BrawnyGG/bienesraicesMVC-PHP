<?php 
use Model\Vendedor;
$creador = Vendedor::find($entrada->vendedorid); ?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo s($entrada->titulo) ?></h1>
        <img src='/imagenes/<?php echo s($entrada->imagen) ?>' 
        alt='Anuncio' loading='lazy' width='200' heigth='300'>
        <div class="contenido-anuncio">
            <p class="info-meta">Escrito el 
                <span><?php echo s($entrada->fecha) ?></span> por: 
                <span><?php echo s($creador->nombre . ' ' . $creador->apellido) ?></span></p>
            <p>   
                <?php echo s($entrada->contenido) ?>
            </p>
        </div>
        <a href="/blog" class="boton-verdeB">Volver</a>
    </main>