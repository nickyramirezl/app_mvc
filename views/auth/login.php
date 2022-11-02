<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form method="POST" action="/" class="formulario">

    <div class="campo">
        <label for="email">Email</label>
        <input type="text"
            type="email"
            id="email"
            placeholder="Ingresa tu email"
            name="email"
            value="<?php echo s($auth->email); ?>"
        />
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password"
            type="password"
            id="password"
            placeholder="Ingresa tu contraseña"
            name="password"
            value="<?php echo s($auth->password); ?>"
        />
    </div>

    <input type="submit" class="boton" value="Iniciar sesión">

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una ahora</a>
    <a href="/olvide">¿Olvidaste tu contraseña? Recupérala</a>
</div>