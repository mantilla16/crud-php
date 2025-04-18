<?php
require_once __DIR__ . '/models/UserModel.php';
$usuarios = UserModel::getUser();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema CRUD</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="crud-container">
        <header class="crud-header">
            <h1>Tienda de música</h1>
            <p>Gestión para usuarios</p>
        </header>

        <div class="crud-navigation">
            
            <button class="btn btn-add" id="btn-add" onclick="openModalUser('create')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nuevo Usuario
            </button>

            <a href="planes.php" class="btn btn-plans">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
                Ver Planes
            </a>
            <a href="suscripciones.php" class="btn btn-subscriptions">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
                Ver Suscripciones
            </a>
        </div>

        <div class="message success" id="success-message"></div>
        <div class="message error" id="error-message"></div>

        <div class="table-responsive">
            <table id="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $usuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['id']) ?></td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td><?= htmlspecialchars($fila['correo']) ?></td>
                        <td><?= htmlspecialchars($fila['fecha_registro']) ?></td>
                        <td class="action-buttons">
                            <button class="btn btn-edit" onclick="openModalUser('edit', <?= $fila['id'] ?>, '<?= htmlspecialchars(addslashes($fila['nombre'])) ?>', '<?= htmlspecialchars(addslashes($fila['correo'])) ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Editar
                            </button>
                            <form method="post" action="../controllers/UserController.php" class="delete-form">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                <button type="button" class="btn btn-delete" onclick="confirmDelete(<?= $fila['id'] ?>)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para agregar/editar -->
    <div class="modal" id="crud-modal">
        <div class="modal-content">
            <h2 class="modal-title" id="modal-title">Nuevo Usuario</h2>
            <form id="crud-form" method="post" action="../controllers/UserController.php">
                <input type="hidden" id="record-id" name="id">
                <input type="hidden" name="accion" id="form-action" value="crear">
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="correo" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn btn-save">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal" id="confirm-modal">
        <div class="modal-content">
            <h2 class="modal-title">Confirmar eliminación</h2>
            <p>¿Estás seguro de que deseas eliminar este registro?</p>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeConfirmModal()">Cancelar</button>
                <form id="confirm-delete-form" method="post" action="../controllers/UserController.php">
                    <input type="hidden" name="accion" value="eliminar">
                    <input type="hidden" name="id" id="delete-id">
                    <button type="submit" class="btn btn-delete">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../public/script.js"></script>
</body>
</html>