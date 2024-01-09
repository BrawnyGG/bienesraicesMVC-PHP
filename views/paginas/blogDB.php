<?php

use Model\Vendedor;

 foreach ($entradas as $entrada): 
    $creador = Vendedor::find($entrada->vendedorid);
 ?>
<article class="entrada-blog">
    <div class="imagen-blog">
        <img src='/imagenes/<?php echo s($entrada->imagen) ?>' 
        alt='Anuncio' loading='lazy' width='200' heigth='300'>
    </div>
    <div class="blog-info">
        <a href="/entrada?id=<?php echo s($entrada->id)?>">
            <h4 class="titulo-blog">
                <?php echo s($entrada->titulo) ?>
            </h4>
            <p class="info-meta">Escrito el 
                <span> <?php echo s($entrada->fecha) ?> </span> por: 
                <span> <?php echo s($creador->nombre . ' ' . $creador->apellido) ?> </span>
            </p>
            <p class="descripcion-blog">
                <?php echo s($entrada->descripcion) ?>
            </p>
        </a>
    </div>
</article><!--Entrada blog-->
<?php endforeach ?>