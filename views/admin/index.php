<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<h1 class="nombre-pagina">Panel de administracion</h1>

<h2>Buscar citas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input
                type="date"
                name="fecha"
                id="fecha"
                value="<?php echo $fecha ?>"
            />
        </div>
    </form>
</div>

<?php 

    if(count($citas) === 0){
        echo "<h3> No hay ninguna cita </h3>";
    }

?>

<div id="citas-admin">
    <ul class="citas">
        <?php $idCita=0;foreach( $citas as $key => $cita ): ?>
            <?php if($idCita !== $cita->id): $total=0;?>
                <li>
                    <p>Hora: <span><?php echo $cita->hora; ?></span> </p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span> </p>
                    <p>Email: <span><?php echo $cita->email; ?></span> </p>
                    <p>Teléfono: <span><?php echo $cita->telefono; ?></span> </p>
                </li>
            <?php $idCita=$cita->id; endif;$total += $cita->precio ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>
                <?php
                    $actual = $cita->id;
                    $proximo = $citas[$key + 1]->id ?? 0;

                    if(es_ultimo($actual, $proximo)){
                        ?>
                            <p class="total">Total: <span><?php echo '$ ' . $total ?></span></p> 
                            <form action="/api/eliminar" method="POST">
                                <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                                <input type="submit" class="boton-eliminar" value="Eliminar">
                            </form>
                        <?php
                    }
                ?>
        <?php endforeach; ?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>";
?>