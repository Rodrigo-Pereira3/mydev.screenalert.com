<?php include __DIR__ . "/../includes/header.php"; ?>

<main class="container mt-4">

    <h1 class="h3 mb-4">Sent by</h1>

    <div class="card" style="max-width: 500px;">
        <div class="card-body">
            <?php if ($cuidador): ?>
                <p><strong>Name:</strong> <?= htmlspecialchars($cuidador->getNameUser()) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($cuidador->getEmail()) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($cuidador->getStatus()) ?></p>
            <?php else: ?>
                <p class="text-muted">No caregiver found for this patient.</p>
            <?php endif; ?>

            <a href="/messages" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>

</main>

<?php include __DIR__ . "/../includes/footer.php"; ?>