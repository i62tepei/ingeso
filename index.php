<?php include("config/db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Listado de Usuarios</h2>
    <input type="text" id="search" class="form-control mb-2" placeholder="Buscar usuario">
    <button class="btn btn-primary mb-3" onclick="newUser()">Nuevo Usuario</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="usuarios"></tbody>
    </table>

   <nav>
        <ul class="pagination" id="pagination"></ul>
    </nav>

    <!-- MODAL -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="userId">
                    <input type="text" id="dni" class="form-control mb-2" placeholder="DNI">
                    <input type="text" id="name" class="form-control mb-2" placeholder="Nombre Completo">
                    <input type="date" id="birthday" class="form-control mb-2">
                    <input type="text" id="phone" class="form-control mb-2" placeholder="Teléfono">
                    <input type="email" id="email" class="form-control mb-2" placeholder="Email">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="saveUser()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
