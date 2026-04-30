<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- TOP BAR -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#adminSidebar">
                ☰
            </button>
            <span class="navbar-brand mb-0 h1">Screen Alert Admin</span>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="list-group list-group-flush">
                <a href="/views/dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="/views/users.php" class="list-group-item list-group-item-action">Users</a>
                <a href="/views/patients.php" class="list-group-item list-group-item-action">Patients</a>
                <a href="/views/messages.php" class="list-group-item list-group-item-action">Messages</a>
                <a href="/views/devices.php" class="list-group-item list-group-item-action">Devices</a>
                <a href="/views/logs.php" class="list-group-item list-group-item-action">Logs</a>
                <a href="/views/schedules.php" class="list-group-item list-group-item-action">Schedules</a>
                <form action="logout.php" method="post" style="display:inline;">
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>