<fieldset>
    <legend>Información General</legend>
    <label for="tituloBlog">Título:</label>
    <input type="text" id="tituloBlog" name="entrada[titulo]" placeholder="Titulo del blog"
    value="<?php echo s( $entrada->titulo ); ?>">
    <p class="contador" id="contadorTitBlog"></p>

    <label for="descripcionBlog">Descripcion:</label>
    <textarea id="descripcionBlog" name="entrada[descripcion]"><?php echo s($entrada->descripcion); ?></textarea>
    <p class="contador" id="contadorDescBlog"></p>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/png, image/jpeg" name="entrada[imagen]">
    <?php if($entrada->imagen):?>
    <img src="/imagenes/<?php echo s($entrada->imagen); ?>" class="img-small">
    <?php endif?>
</fieldset>
<fieldset>
    <legend>Contenido del blog</legend>
    <label for="contenido">Contenido:</label>
    <textarea id="contenido" name="entrada[contenido]"><?php echo s($entrada->contenido); ?></textarea>
</fieldset>
<fieldset>
    <legend>Creador</legend>
    <label for="creador">Creador</label>
    <select name="entrada[vendedorid]" id="creador">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor): ?>
            <option
            <?php echo $entrada->vendedorid === $vendedor->id ? 'selected' : '' ?> 
            value="<?php echo s( $vendedor->id ) ?>">
                <?php echo s( $vendedor->nombre . " " . $vendedor->apellido ) ?>
            </option>
        <?php endforeach ?>
    </select>
</fieldset>