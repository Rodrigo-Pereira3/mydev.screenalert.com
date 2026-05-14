<?php include __DIR__ . "/../includes/header.php"; ?>
    <!-- MAIN CONTENT -->
    <main class="container mt-4">

        <h1 class="h3 mb-4">Message Management</h1>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Receiver</th>
                            <th>status</th>
                            <th>Date</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td><?= $message->getId() ?></td>
                                <td><?= $message->getIdPaciente() ?></td>
                                <td><?php if ($message->getStatus() === 'Seen'): ?>
                                <span class="badge bg-success"><?= $message->getStatus() ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?= $message->getStatus() ?></span>
                            <?php endif; ?></td>
                                <td><?= $message->getSentAt() ?></td>
                                <td><?= $message->getTextMessage() ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>