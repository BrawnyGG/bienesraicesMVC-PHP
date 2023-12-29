    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo s( $propiedad->titulo ); ?></h1>
            <img src='../imagenes/<?php echo s( $propiedad->imagen ); ?>' alt='Anuncio' loading='lazy' width='200' heigth='300'>
        <div class="contenido-anuncio">
            <p class="precio">$<?php echo s( $propiedad->precio ); ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="../build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo s( $propiedad->wc ); ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="../build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo s( $propiedad->estacionamiento ); ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="../build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo s( $propiedad->habitaciones ); ?></p>
                </li>
            </ul>
            <p>   
            <?php echo s( $propiedad->descripcion ); ?>
            </p>
            <a href="/propiedades" class="boton-verdeB">Volver</a>
        </div>
    </main>