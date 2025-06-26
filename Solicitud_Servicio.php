<!-- Se recomienda que el código PHP esté al inicio del archivo -->
<?php
$ordenes = [
    [
        'id' => 1,
        'cliente' => 'Carlos Pérez',
        'placa' => 'ABC123',
        'fecha_ingreso' => '2025-06-15',
        'tipo' => 'Mantenimiento',
        'pago' => 'Sí',
        'fecha_final' => '2025-06-20'
    ],
    [
        'id' => 2,
        'cliente' => 'Ana López',
        'placa' => 'XYZ456',
        'fecha_ingreso' => '2025-06-10',
        'tipo' => 'Reparación',
        'pago' => 'No',
        'fecha_final' => '2025-06-12'
    ],
    [
        'id' => 3,
        'cliente' => 'Juan Gómez',
        'placa' => 'JKL654',
        'fecha_ingreso' => '2025-06-05',
        'tipo' => 'Limpieza',
        'pago' => 'Sí',
        'fecha_final' => '2025-06-10'
    ],
    [
        'id' => 4,
        'cliente' => 'María Ruiz',
        'placa' => 'LMN987',
        'fecha_ingreso' => '2025-06-01',
        'tipo' => 'Mantenimiento',
        'pago' => 'No',
        'fecha_final' => '2025-06-08'
    ],
    [
        'id' => 5,
        'cliente' => 'Luis Fernández',
        'placa' => 'PQR321',
        'fecha_ingreso' => '2025-06-20',
        'tipo' => 'Reparación',
        'pago' => 'Sí',
        'fecha_final' => '2025-06-25'
    ],
];

function calcularClaseFila($orden)
{
    $clase = '';
    $hoy = new DateTime();
    $ingreso = DateTime::createFromFormat('Y-m-d', $orden['fecha_ingreso']);
    $final = $orden['fecha_final'];
    $pago = $orden['pago'];

    if ($ingreso !== false && $ingreso->diff($hoy)->days > 7) {
        $clase = 'table-warning';
    }

    if (!empty($final) && strtolower($pago) === 'no') {
        $clase = 'table-danger';
    }

    return $clase;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Solicitud de Servicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="#">Taller ABS S.A.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex justify-content-end collapse navbar-collapse" id="navbarNav">
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalFormularioCliente">
                    Agregar orden de servicio
                </button>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <table class="table table-bordered table-striped" id="tablaOrdenesServicio">
            <thead class="table-primary">
                <tr>
                    <th>Cliente</th>
                    <th>Placa</th>
                    <th>Fecha de Ingreso</th>
                    <th>Tipo de Servicio</th>
                    <th>Estado de Pago</th>
                    <th>Fecha de Finalización</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordenes as $orden): ?> <!-- Se asigna el php en las zonas donde se vera afectada para no escribir echo en cada linea -->
                    <tr class="<?= calcularClaseFila($orden) ?>">
                        <td><?= $orden['cliente'] ?></td>
                        <td><?= $orden['placa'] ?></td>
                        <td><?= $orden['fecha_ingreso'] ?></td>
                        <td><?= $orden['tipo'] ?></td>
                        <td><?= $orden['pago'] ?></td>
                        <td><?= $orden['fecha_final'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- El modal se agrega al final del documento HTML -->
    <div class="modal fade" id="modalFormularioCliente" tabindex="-1" aria-labelledby="modalFormularioClienteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalFormularioClienteLabel">Nueva orden de servicio</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioUsuario" novalidate>
                        <div class="mb-3">
                            <label for="nomCliente" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="nomCliente" placeholder="Pepe García" required />
                        </div>
                        <div class="mb-3">
                            <label for="placaCarro" class="form-label">Placa</label>
                            <input type="text" class="form-control" id="placaCarro" placeholder="ABC123" required />
                        </div>
                        <div class="mb-3">
                            <label for="fechaIngresoCarro" class="form-label">Fecha de ingreso</label>
                            <input type="date" class="form-control" id="fechaIngresoCarro" required />
                        </div>
                        <div class="mb-3">
                            <label for="tipoServicio" class="form-label">Tipo de Servicio</label>
                            <select class="form-select" id="tipoServicio" required>
                                <option value="" disabled selected>Seleccione un tipo de servicio</option>
                                <option>Mantenimiento</option>
                                <option>Reparación</option>
                                <option>Limpieza</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estadoServicioCarro" class="form-label">Estado del servicio</label>
                            <select class="form-select" id="estadoServicioCarro" required>
                                <option value="" disabled selected>Seleccione un estado</option>
                                <option>Pendiente</option>
                                <option>Finalizada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estadoPagoServicio" class="form-label">Pago</label>
                            <select class="form-select" id="estadoPagoServicio" required>
                                <option>Sí</option>
                                <option>No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fechaFinalizacion" class="form-label">Fecha de finalización</label>
                            <input type="date" class="form-control" id="fechaFinalizacion" required />
                        </div>
                        <button type="submit" class="btn btn-success">Guardar orden</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="scriptCasoEstudio1.js"></script>
</body>
</html>

