<?php include __DIR__ . "/../includes/header.php"; ?>
    <!-- MAIN CONTENT -->
    <main class="container mt-4">

        <h1 class="h3 mb-4">Device Management</h1>

        <!-- Botão Criar Novo -->
        <div class="mb-3">
            <button class="btn btn-primary">
                + Register New Device
            </button>
        </div>

        <!-- Tabela -->
        <div class="card">
            <div class="card-body">

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Device ID</th>
                            <th>Patient ID</th>
                            <th>Token</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($devices as $device): ?>
                        <tr>
                            <td><?= $device->getId() ?></td>
                            <td><?= $device->getIdUser() ?></td>
                            <td><?= $device->getTokenDevice() ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning">Restart</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </main>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>
