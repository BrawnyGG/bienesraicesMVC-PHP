<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo propiedad"
    value="<?php echo s( $propiedad->titulo ); ?>">
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio propiedad" min="1000" max="99999999" 
    value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/png, image/jpeg" name="propiedad[imagen]">
    <?php if($propiedad->imagen):?>
    <img src="/imagenes/<?php echo s($propiedad->imagen); ?>" class="img-small">
    <?php endif?>
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>
<fieldset>
    <legend>Información Propiedad</legend>
    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" min="1" max="9" placeholder="ej: 3" 
    value="<?php echo s($propiedad->habitaciones); ?>">
    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" min="1" max="9" placeholder="ej: 3" 
    value="<?php echo s($propiedad->wc); ?>">
    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" min="1" max="9" placeholder="ej: 3" 
    value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[VENDEDORES_id]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor): ?>
            <option
            <?php echo $propiedad->VENDEDORES_id === $vendedor->id ? 'selected' : '' ?> 
            value="<?php echo s( $vendedor->id ) ?>">
                <?php echo s( $vendedor->nombre . " " . $vendedor->apellido ) ?>
            </option>
        <?php endforeach ?>
    </select>
</fieldset>