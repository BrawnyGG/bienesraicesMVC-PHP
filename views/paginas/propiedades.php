    <main class="contenedor seccion">
        <h1>Casas y Depas en venta</h2>
        <?php include __DIR__ . "/propiedadesDB.php";?>
        <ul class="paginacion">
            <?php  if ($pagina > 1) { ?>
                <li>
                    <a href="?p=<?php echo $pagina - 1 ?>">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php } ?>
            
            <?php for ($i=1; $i<=$paginas; $i++): ?>
                <li>
                    <a
                    <?php if ($i == $pagina) :?>
                    class="seleccionado" 
                    <?php endif ?>
                    href="?p=<?php echo $i ?>">
                    <?php echo s($i) ?>
                    </a>
                </li>
            <?php endfor ?>

            <?php if ($pagina < $paginas) { ?>
            <li>
            <a href="?p=<?php echo $pagina + 1 ?>">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php } ?>
        </ul>
    </main>