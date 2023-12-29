<main class="contenedor seccion">
        <h1>Administrador de bienes raices</h1>
        
        <?php
            //Verifica que no sean  nulos los campos GET
            if ($resultado){
                if(!is_null($resultado) && !is_null($valor)){ 
                    $mensaje = mostrarMensajes(intval($resultado), $valor);
                    if($mensaje){ ?>
                    <p class="alerta exito"><?php echo s($mensaje) ?></p>
            <?php } } } ?>

        <a href="/propiedades/crear" class="boton-verde">Crear Propiedad</a>
        <a href="/vendedores/crear" class="boton-amarillo">Crear Vendedor</a>
        <h2>Propiedades</h2>
        <table class="tabla-propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($propiedades as $propiedad):?>
                <tr> 
                    <td><?php echo $propiedad->id ?></td>
                    <td><?php echo $propiedad->titulo ?></td>
                    <td> <img src="imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"> </td>
                    <td>$<?php echo $propiedad->precio ?></td>
                    <td class="acciones">
                        <a href="propiedades/actualizar?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                        <form class="w-100" method="POST" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad"> 
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="tabla-propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($vendedores as $vendedor):?>
                <tr> 
                    <td><?php echo $vendedor->id ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido ?></td>
                    <td><?php echo $vendedor->telefono ?></td>

                    <td class="acciones">
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                        <form class="w-100" method="POST"  action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">                            
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </main>