<?php
include "conexion.php";
include "header.php";   

$id = $_GET['id'];

// Obtener donantes
$donantes = $conn->query("SELECT * FROM donante");

// Obtener proyecto (con validación básica)
$proyecto = $conn->query("SELECT nombre FROM proyecto WHERE id_proyecto=$id")->fetch_assoc();
?>

<div class="container mt-5">
    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4>Realizar Donación</h4>
        </div>

        <div class="card-body">

            <h5>Proyecto: <?= htmlspecialchars($proyecto['nombre']) ?></h5>

            <!-- Mensaje informativo -->
            <div class="alert alert-info">
                Complete el formulario para realizar una donación segura.
            </div>

            <form action="guardar_donacion.php" method="POST">

                <input type="hidden" name="id_proyecto" value="<?= $id ?>">

                <label>Seleccionar Donante</label>
                <select name="id_donante" class="form-control mb-3" required>
                    <option value="">-- Seleccionar --</option>

                    <?php while($d = $donantes->fetch_assoc()){ ?>
                        <option value="<?= $d['id_donante'] ?>">
                            <?= htmlspecialchars($d['nombre']) ?> (<?= $d['email'] ?>)
                        </option>
                    <?php } ?>

                </select>

                <a href="registrar_donante.php" class="btn btn-sm btn-warning mb-3">
                    + Nuevo Donante
                </a>

                <!-- Campo mejorado -->
                <input name="monto" type="number" class="form-control mb-3" placeholder="Monto" min="1" required>

                <small class="text-muted">El monto debe ser mayor a 0</small>

                <button class="btn btn-primary w-100 mt-3">Donar</button>

            </form>

        </div>
    </div>
</div>

<!-- Validación con JavaScript -->
<script>
document.querySelector("form").addEventListener("submit", function(e){
    const monto = document.querySelector("input[name='monto']").value;

    if(monto <= 0){
        alert("El monto debe ser mayor a 0");
        e.preventDefault();
    }
});
</script>

                <input name="monto" type="number" class="form-control mb-3" placeholder="Monto" required>

                <button class="btn btn-primary w-100">Donar</button>

            </form>
        </div>
    </div>
</div>
