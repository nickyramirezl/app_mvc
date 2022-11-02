<h1 class="nombre-pagina">Recuperar página</h1>
<div class="descripcion-pagina">Ingresa tu nueva contraseña</div>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<?php if($error) return; ?>

<form method="POST" class="formulario">

    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Selecciona una nueva contraseña"
        />
    </div>

    <input type="submit" class="boton" value="Restablecer contraseña">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Regístrate ahora</a>
</div>