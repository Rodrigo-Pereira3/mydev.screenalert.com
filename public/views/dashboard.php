<?php include __DIR__ . "/../includes/header.php"; ?>


<!-- MAIN CONTENT -->
    <main class="container mt-4 flex-grow-1">

        <h1 class="h3 mb-4">Dashboard Overview</h1>

        <!-- STAT CARDS -->
        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <h2 class="text-primary"><?= $users_count ?></h2>
                        <p class="text-muted small">Active caregivers</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Patients</h5>
                        <h2 class="text-success"><?= $patients_count ?></h2>
                        <p class="text-muted small">Monitored patients</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Devices</h5>
                        <h2 class="text-warning"><?= $devices_count ?></h2>
                        <p class="text-muted small">Online devices</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Alerts Today</h5>
                        <h2 class="text-danger"><?= $alerts_count ?></h2>
                        <p class="text-muted small">Triggered alerts</p>
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