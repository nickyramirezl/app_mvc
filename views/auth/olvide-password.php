<h1 class="nombre-pagina">Recuperar contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña escribiendo el email registrado</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form action="/olvide" method="POST" class="formulario">

    <div class="campo">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="Correo electrónico"
        />
    </div>

    <input type="submit" class="boton" value="Validar">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Regístrate ahora</a>
</div>