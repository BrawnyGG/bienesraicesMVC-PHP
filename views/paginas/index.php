<main class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Quaerat id delectus amet nam minima cum architecto incidunt nostrum assumenda, 
                    quos voluptatum consequatur dolorem deserunt quia magnam quidem facere nobis in?
                </p>
            </div> <!-- icono -->
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Quaerat id delectus amet nam minima cum architecto incidunt nostrum assumenda, 
                    quos voluptatum consequatur dolorem deserunt quia magnam quidem facere nobis in?
                </p>
            </div> <!-- icono -->
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Quaerat id delectus amet nam minima cum architecto incidunt nostrum assumenda, 
                    quos voluptatum consequatur dolorem deserunt quia magnam quidem facere nobis in?
                </p>
            </div> <!-- icono -->
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en venta</h2>
        
        <?php include __DIR__ . "/propiedadesDB.php"; ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad.</p>
        <div class="btn-contacto">
            <a href="/contacto" class="boton-amarillo">Contáctanos</a>
        </div> 
    </section>

    <div class="contenedor seccion blog-test-contenedor">
        
        <section class="blog">
            <h3>Nuestro blog</h3>

            <?php include __DIR__ . "/blogDB.php"; ?>
            
        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me 
                    ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>-Braulio Gutiérrez</p>
            </div>
        </section>
    </div>