<?php include __DIR__ . "/../includes/header.php"; ?>


<!-- MAIN CONTENT -->
<main class="container mt-4 flex-grow-1">

    <h1 class="h3 mb-4">Dashboard Overview</h1>

    <!-- STAT CARDS -->
    <!-- STAT CARDS -->
    <div class="row mb-4 justify-content-center g-3">

        <div class="col-md-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Caregivers</h5>
                    <h2 class="text-primary"><?= $userCount ?></h2>
                    <p class="text-muted small mb-0">Caregivers to take care of patients</p>
                </div>
            </div>
<<<<<<< HEAD
=======

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Patients</h5>
                        <h2 class="text-success"><?= $pacientesCount ?></h2>
                        <p class="text-muted small">Patients under care</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Devices</h5>
                        <h2 class="text-warning"><?= $devicesCount ?></h2>
                        <p class="text-muted small">Online devices</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Temperatures Today</h5>
                        <h2 class="text-danger"><?= $tempCount ?></h2>
                        <p class="text-muted small">Temperature readings</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- RECENT ACTIVITY -->
        <div class="card mb-4">
            <div class="card-header">
                <strong>Recent Activity</strong>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <span class="badge bg-primary">MESSAGE</span>
                    Message sent to <strong>Carlos Mendes</strong>
                    <div class="text-muted small">Today at 09:00</div>
                </div>

                <div class="mb-3">
                    <span class="badge bg-success">DEVICE</span>
                    Device <strong>DEV-003</strong> checked in (online)
                    <div class="text-muted small">Today at 08:45</div>
                </div>

                <div class="mb-3">
                    <span class="badge bg-danger">ERROR</span>
                    Device <strong>DEV-002</strong> failed to respond
                    <div class="text-muted small">Yesterday at 22:10</div>
                </div>

            </div>
>>>>>>> c5571d52661f4ddca9a93ec8701aeb53a5929716
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Patients</h5>
                    <h2 class="text-success"><?= $pacientesCount ?></h2>
                    <p class="text-muted small mb-0">Patients under care</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Devices</h5>
                    <h2 class="text-warning"><?= $devicesCount ?></h2>
                    <p class="text-muted small mb-0">Online devices</p>
                </div>
            </div>
        </div>

    </div>

    <!-- RECENT ACTIVITY -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Recent Activity</strong>
        </div>
        <div class="card-body">

            <div class="mb-3">
                <span class="badge bg-primary">MESSAGE</span>
                Message sent to <strong>Carlos Mendes</strong>
                <div class="text-muted small">Today at 09:00</div>
            </div>

            <div class="mb-3">
                <span class="badge bg-success">DEVICE</span>
                Device <strong>DEV-003</strong> checked in (online)
                <div class="text-muted small">Today at 08:45</div>
            </div>

            <div class="mb-3">
                <span class="badge bg-danger">ERROR</span>
                Device <strong>DEV-002</strong> failed to respond
                <div class="text-muted small">Yesterday at 22:10</div>
            </div>

        </div>
    </div>

</main>

<?php include __DIR__ . "/../includes/footer.php"; ?>