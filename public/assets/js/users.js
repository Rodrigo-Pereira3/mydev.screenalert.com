
    document.addEventListener("DOMContentLoaded", () => {

        const table       = document.getElementById("userTable");
        const editModal   = new bootstrap.Modal(document.getElementById("editModal"));
        const addModal    = new bootstrap.Modal(document.getElementById("addModal"));

        let currentRow = null;

        // EDIT inputs
        const editName   = document.getElementById("editName");
        const editEmail  = document.getElementById("editEmail");
        const editStatus = document.getElementById("editStatus");
        const saveEdit   = document.getElementById("saveEdit");

        // ADD inputs
        const addName   = document.getElementById("addName");
        const addEmail  = document.getElementById("addEmail");
        const addStatus = document.getElementById("addStatus");
        const saveAdd   = document.getElementById("saveAdd");

        // Open Add modal
        document.getElementById("openAddModal").addEventListener("click", () => {
            addModal.show();
        });

        // Event delegation: Edit + Delete
        table.addEventListener("click", (e) => {

            // DELETE
            if (e.target.classList.contains("delete-btn")) {
                if (confirm("Delete this user?")) {
                    e.target.closest("tr").remove();
                }
            }

            // EDIT
            if (e.target.classList.contains("edit-btn")) {
                currentRow = e.target.closest("tr");
                const cells = currentRow.children;

                editName.value   = cells[1].innerText.trim();
                editEmail.value  = cells[2].innerText.trim();
                editStatus.value = cells[3].querySelector("span").innerText.trim();

                editModal.show();
            }
        });

        // Save Edit
        saveEdit.addEventListener("click", () => {
            if (!currentRow) return;

            const cells  = currentRow.children;
            const status = editStatus.value;

            cells[1].innerText = editName.value.trim();
            cells[2].innerText = editEmail.value.trim();
            cells[3].innerHTML = status === "Active"
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Blocked</span>';

            editModal.hide();
            currentRow = null;
        });

        // Save Add
        saveAdd.addEventListener("click", () => {
            const name   = addName.value.trim();
            const email  = addEmail.value.trim();
            const status = addStatus.value;

            if (!name || !email) {
                alert("Please fill all fields.");
                return;
            }

            const id    = Math.floor(Math.random() * 9000) + 1000;
            const today = new Date().toISOString().split("T")[0];
            const badge = status === "Active"
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Blocked</span>';

            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${id}</td>
                <td>${name}</td>
                <td>${email}</td>
                <td>${badge}</td>
                <td>${today}</td>
                <td>-</td>
                <td>
                    <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                </td>
            `;

            table.appendChild(newRow);

            addName.value   = "";
            addEmail.value  = "";
            addStatus.value = "Active";
            addModal.hide();
        });

    });
