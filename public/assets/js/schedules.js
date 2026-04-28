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