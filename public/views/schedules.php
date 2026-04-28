<?php include __DIR__ . "/../includes/header.php"; ?>


    <!-- MAIN CONTENT -->
    <main class="container mt-4">

        <h1 class="h3 mb-4">Global Schedules</h1>

        <!-- Filtros -->
        <div class="row mb-3">
            <div class="col-md-4">
                <select id="filterCaregiver" class="form-select">
                    <option value="all" selected>Filter by Caregiver</option>
                    <option>Maria Silva</option>
                    <option>João Pereira</option>
                    <option>Ana Costa</option>
                </select>
            </div>

            <div class="col-md-4">
                <select id="filterPatient" class="form-select">
                    <option value="all" selected>Filter by Patient</option>
                    <option>Carlos Mendes</option>
                    <option>Joana Rocha</option>
                    <option>António Costa</option>
                </select>
            </div>

            <div class="col-md-4">
                <select id="filterStatus" class="form-select">
                    <option value="all" selected>Filter by Status</option>
                    <option>Active</option>
                    <option>Paused</option>
                </select>
            </div>
        </div>

        <!-- Agendamento 1 -->
        <div class="card mb-3 schedule-card" data-caregiver="Maria Silva" data-patient="Carlos Mendes"
            data-status="Active">
            <div class="card-body">
                <span class="badge bg-success">Active</span>
                <h5 class="mt-2">Morning Reminder</h5>
                <p class="mb-1"><strong>Patient:</strong> Carlos Mendes</p>
                <p class="mb-1"><strong>Caregiver:</strong> Maria Silva</p>
                <p class="mb-1"><strong>Time:</strong> Every day at 09:00</p>
                <p class="text-muted small">Last sent: 2024-02-22 09:00</p>

                <button class="btn btn-sm btn-warning">Edit</button>
                <button class="btn btn-sm btn-secondary">Pause</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </div>
        </div>

        <!-- Agendamento 2 -->
        <div class="card mb-3 schedule-card" data-caregiver="João Pereira" data-patient="Joana Rocha"
            data-status="Paused">
            <div class="card-body">
                <span class="badge bg-secondary">Paused</span>
                <h5 class="mt-2">Medication Alert</h5>
                <p class="mb-1"><strong>Patient:</strong> Joana Rocha</p>
                <p class="mb-1"><strong>Caregiver:</strong> João Pereira</p>
                <p class="mb-1"><strong>Time:</strong> Every day at 14:00</p>
                <p class="text-muted small">Last sent: 2024-02-20 14:00</p>

                <button class="btn btn-sm btn-warning">Edit</button>
                <button class="btn btn-sm btn-success">Resume</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </div>
        </div>

        <!-- Agendamento 3 -->
        <div class="card mb-3 schedule-card" data-caregiver="Ana Costa" data-patient="António Costa"
            data-status="Active">
            <div class="card-body">
                <span class="badge bg-success">Active</span>
                <h5 class="mt-2">Drink Water Reminder</h5>
                <p class="mb-1"><strong>Patient:</strong> António Costa</p>
                <p class="mb-1"><strong>Caregiver:</strong> Ana Costa</p>
                <p class="mb-1"><strong>Time:</strong> Every 2 hours</p>
                <p class="text-muted small">Last sent: 2024-02-22 11:00</p>

                <button class="btn btn-sm btn-warning">Edit</button>
                <button class="btn btn-sm btn-secondary">Pause</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </div>
        </div>

    </main>

    <!-- FILTER SCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const caregiverFilter = document.getElementById("filterCaregiver");
            const patientFilter = document.getElementById("filterPatient");
            const statusFilter = document.getElementById("filterStatus");

            const cards = document.querySelectorAll(".schedule-card");
            // EVENT DELEGATION (delete + edit)
            table.addEventListener("click", (e) => {

                // DELETE
                if (e.target.classList.contains("delete-btn")) {
                    if (confirm("Delete this patient?")) {
                        e.target.closest("tr").remove();
                    }
                }

                // EDIT
                if (e.target.classList.contains("edit-btn")) {
                    currentRow = e.target.closest("tr");
                    const cells = currentRow.children;

                    editName.value = cells[1].innerText.trim();
                    editCaregiver.value = cells[2].innerText.trim();

                    const badgeText = cells[3].querySelector("span").innerText.trim();
                    editStatus.value = badgeText;

                    editModal.show();
                }
            });
            function applyFilters() {
                const caregiver = caregiverFilter.value;
                const patient = patientFilter.value;
                const status = statusFilter.value;

                cards.forEach(card => {
                    const matchCaregiver = caregiver === "all" || card.dataset.caregiver === caregiver;
                    const matchPatient = patient === "all" || card.dataset.patient === patient;
                    const matchStatus = status === "all" || card.dataset.status === status;

                    card.style.display = (matchCaregiver && matchPatient && matchStatus)
                        ? "block"
                        : "none";
                });
            }

            caregiverFilter.addEventListener("change", applyFilters);
            patientFilter.addEventListener("change", applyFilters);
            statusFilter.addEventListener("change", applyFilters);

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include __DIR__ . "/../includes/footer.php"; ?>
    <script src="../js/schedules.js"></script>

</body>

</html>