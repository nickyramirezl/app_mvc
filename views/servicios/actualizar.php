<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<h1 class="nombre-pagina">Actualizar servicio</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>

<form method="POST" class="formulario">

    <?php include_once 'formulario.php'; ?>
    <input type="submit" value="guardar servicio" class="boton">
    
</form>