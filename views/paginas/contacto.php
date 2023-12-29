    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <!-- Mensaje de exito! -->
        <?php if($mensaje) { ?>
            <?php if($exito) {?>
                <p class="alerta exito"><?php echo s($mensaje) ?></p>
            <?php } else { ?>
                <p class="alerta error"><?php echo s($mensaje) ?></p>
            <?php } ?>
        <?php } ?>

        <picture>
            <source srcset='build/img/destacada3.webp' type='image/webp'>
            <source srcset='build/img/destacada3.jpg' type='image/jpeg'>
            <img src='build/img/destacada3.jpg' alt='Anuncio' loading='lazy' width='200' heigth='300'>
        </picture>

        <h2>Llena el formulario de contacto</h2>
        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Datos personales</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" placeholder="Tu nombre"
                name="contacto[nombre]" required>

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre Propiedad</legend>

                <label for="opciones">Vende o compra:</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto:</label>
                <input type="number" id="presupuesto" placeholder="Tu precio o presupuesto"
                name="contacto[precio]" required>
            </fieldset>
            <fieldset>
                <legend>Contacto</legend>

                <p>¿Cómo desea ser contactado?:</p>        
                <div class="forma-contacto">
                    <label for="forma-telefono">Teléfono:</label>
                    <input name="contacto[contacto]" type="radio" value="Telefono" 
                    id="forma-telefono" required>

                    <label for="forma-email">E-mail:</label>
                    <input name="contacto[contacto]" type="radio" value="Email" id="forma-email">
                </div>
                <div id="contacto"></div>
                
                
            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>