<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad): ?>
        
        <div class="anuncio">
            <img class="img-anuncio" src='/imagenes/<?php echo s($propiedad->imagen) ?>' alt='Anuncio' loading='lazy' width='200' heigth='300'>
            <div class="contenido-anuncio">
                <h3 class="titulo">
                    <?php echo s($propiedad->titulo) ?>
                </h3>
                <p class="descripcion">
                    <?php echo s($propiedad->descripcion) ?>
                </p>
                <p class="precio">$
                    <?php echo s($propiedad->precio) ?>
                </p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p>
                            <?php echo s($propiedad->wc) ?>
                        </p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p>
                            <?php echo s($propiedad->estacionamiento) ?> 
                        </p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p>
                            <?php echo s($propiedad->habitaciones) ?>
                        </p>
                    </li>
                </ul>
                <a class="boton boton-amarillo-block" href="/propiedad?id=<?php echo s($propiedad->id)?>">Ver propiedad</a>
            </div> <!-- Contenido de anuncio -->
        </div><!-- Anuncio -->
    <?php endforeach ?>
</div> <!-- Contenedor anuncios -->