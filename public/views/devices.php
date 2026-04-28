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
                            <th>Location</th>
                            <th>Patient</th>
                            <th>Status</th>
                            <th>Last Communication</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>DEV-001</td>
                            <td>Casa do Carlos</td>
                            <td>Carlos Mendes</td>
                            <td><span class="badge bg-success">Online</span></td>
                            <td>2024-02-22 14:10</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Restart</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>

                        <tr>
                            <td>DEV-002</td>
                            <td>Casa da Joana</td>
                            <td>Joana Rocha</td>
                            <td><span class="badge bg-danger">Offline</span></td>
                            <td>2024-02-20 09:55</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Restart</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>

                        <tr>
                            <td>DEV-003</td>
                            <td>Casa do António</td>
                            <td>António Costa</td>
                            <td><span class="badge bg-success">Online</span></td>
                            <td>2024-02-22 11:47</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Restart</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>
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
