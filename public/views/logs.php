<?php include __DIR__ . "/../includes/header.php"; ?>

<!-- MAIN CONTENT -->
<main class="container mt-4">

    <h1 class="h3 mb-4">System Logs</h1>

    <!-- FILTERS -->
    <div class="row mb-3">
        <div class="col-md-6">
            <select id="filterType" class="form-select">
                <option value="all" selected>Filter by Type</option>
                <option value="MESSAGE">Messages</option>
                <option value="DEVICE">Devices</option>
                <option value="ERROR">Errors</option>
                <option value="SYSTEM">System</option>
            </select>
        </div>

        <div class="col-md-6">
            <select id="filterDate" class="form-select">
                <option value="all" selected>Filter by Date</option>
                <option value="today">Today</option>
                <option value="7days">Last 7 Days</option>
                <option value="30days">Last 30 Days</option>
            </select>
        </div>
    </div>

    <!-- LOG 1 -->
    <div class="card mb-3 log-card" data-type="MESSAGE" data-date="2024-02-22">
        <div class="card-body">
            <span class="badge bg-primary">MESSAGE</span>
            <strong>Message sent to Carlos Mendes</strong>
            <div class="text-muted small">2024-02-22 14:10</div>
        </div>
    </div>

    <!-- LOG 2 -->
    <div class="card mb-3 log-card" data-type="DEVICE" data-date="2024-02-22">
        <div class="card-body">
            <span class="badge bg-success">DEVICE</span>
            <strong>Device DEV-003 checked in (online)</strong>
            <div class="text-muted small">2024-02-22 11:47</div>
        </div>
    </div>

    <!-- LOG 3 -->
    <div class="card mb-3 log-card" data-type="ERROR" data-date="2024-02-20">
        <div class="card-body">
            <span class="badge bg-danger">ERROR</span>
            <strong>Device DEV-002 failed to respond</strong>
            <div class="text-muted small">2024-02-20 09:55</div>
        </div>
    </div>

    <!-- LOG 4 -->
    <div class="card mb-3 log-card" data-type="SYSTEM" data-date="2024-02-19">
        <div class="card-body">
            <span class="badge bg-secondary">SYSTEM</span>
            <strong>Admin panel accessed</strong>
            <div class="text-muted small">2024-02-19 18:22</div>
        </div>
    </div>

</main>

<!-- FILTER SCRIPT -->
<script>
    document.addEventListener("DOMContentLoaded", () => {

        const typeFilter = document.getElementById("filterType");
        const dateFilter = document.getElementById("filterDate");

        const cards = document.querySelectorAll(".log-card");

        function applyFilters() {
            const type = typeFilter.value;
            const date = dateFilter.value;
            const now = new Date();

            cards.forEach(card => {
                const logType = card.dataset.type;
                const logDate = new Date(card.dataset.date);

                const matchType = type === "all" || logType === type;

                let matchDate = true;
                if (date === "today") {
                    matchDate = logDate.toDateString() === now.toDateString();
                } else if (date === "7days") {
                    matchDate = (now - logDate) / (1000 * 60 * 60 * 24) <= 7;
                } else if (date === "30days") {
                    matchDate = (now - logDate) / (1000 * 60 * 60 * 24) <= 30;
                }

                card.style.display = (matchType && matchDate) ? "" : "none";
            });
        }

        typeFilter.addEventListener("change", applyFilters);
        dateFilter.addEventListener("change", applyFilters);

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>