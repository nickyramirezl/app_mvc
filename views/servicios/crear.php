<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<h1 class="nombre-pagina">Nuevo servicio</h1>
<p class="descripcion-pagina">Crea un nuevo servicio</p>

<form action="/servicios/crear" method="POST" class="formulario">

    <?php include_once 'formulario.php'; ?>
    <input type="submit" value="guardar servicio" class="boton">
</form>