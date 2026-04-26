document.addEventListener("DOMContentLoaded", () => {

        const table = document.getElementById("patientTable");

        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        const addModal  = new bootstrap.Modal(document.getElementById('addModal'));

        let currentRow = null;

        // INPUTS EDIT
        const editName      = document.getElementById("editName");
        const editCaregiver = document.getElementById("editCaregiver");
        const editStatus    = document.getElementById("editStatus");
        const saveEdit      = document.getElementById("saveEdit");

        // INPUTS ADD
        const addName      = document.getElementById("addName");
        const addCaregiver = document.getElementById("addCaregiver");
        const addStatus    = document.getElementById("addStatus");
        const saveAdd      = document.getElementById("saveAdd");
        const openAddModal = document.getElementById("openAddModal");

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

                editName.value      = cells[1].innerText.trim();
                editCaregiver.value = cells[2].innerText.trim();

                // FIX 3: ler o texto do <span> dentro da célula de status
                const badgeText = cells[3].querySelector("span").innerText.trim();
                editStatus.value = badgeText;

                editModal.show();
            }
        });

        // SAVE EDIT
        saveEdit.addEventListener("click", () => {
            if (!currentRow) return;

            const cells  = currentRow.children;
            const status = editStatus.value;

            cells[1].innerText = editName.value.trim();
            cells[2].innerText = editCaregiver.value.trim();

            cells[3].innerHTML = status === "Active"
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';

            cells[5].innerText = new Date().toISOString().split('T')[0];

            editModal.hide();
            currentRow = null;
        });

        // OPEN ADD MODAL
        openAddModal.addEventListener("click", () => {
            addModal.show();
        });

        // ADD NEW
        saveAdd.addEventListener("click", () => {
            const name      = addName.value.trim();
            const caregiver = addCaregiver.value.trim();
            const status    = addStatus.value;

            if (!name || !caregiver) {
                alert("Please fill all fields.");
                return;
            }

            const id     = Math.floor(Math.random() * 9000) + 1000;
            const today  = new Date().toISOString().split('T')[0];
            const badge  = status === "Active"
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';

            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${id}</td>
                <td>${name}</td>
                <td>${caregiver}</td>
                <td>${badge}</td>
                <td>${today}</td>
                <td>-</td>
                <td>
                    <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                </td>
            `;

            table.appendChild(newRow);

            // Limpar inputs e fechar modal
            addName.value      = "";
            addCaregiver.value = "";
            addStatus.value    = "Active";
            addModal.hide();
        });

    });