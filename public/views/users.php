<?php include __DIR__ . "/../includes/header.php"; ?>

<main class="container mt-4">

        <h1 class="h3 mb-4">User Management</h1>

        <div class="mb-3">
            <button class="btn btn-primary" id="openAddModal">+ Add New Caregiver</button>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        <tr>
                            <td>1</td>
                            <td>Maria Silva</td>
                            <td>maria@example.com</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>2024-01-10</td>
                            <td>2024-02-20 14:32</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>João Pereira</td>
                            <td>joao@example.com</td>
                            <td><span class="badge bg-danger">Blocked</span></td>
                            <td>2024-01-15</td>
                            <td>2024-02-18 09:10</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ana Costa</td>
                            <td>ana@example.com</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>2024-02-01</td>
                            <td>2024-02-22 11:05</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Caregiver</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input id="editName" class="form-control mb-2" placeholder="Name">
                    <input id="editEmail" class="form-control mb-2" placeholder="Email" type="email">
                    <select id="editStatus" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Blocked">Blocked</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="saveEdit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Caregiver</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input id="addName" class="form-control mb-2" placeholder="Name">
                    <input id="addEmail" class="form-control mb-2" placeholder="Email" type="email">
                    <select id="addStatus" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Blocked">Blocked</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="saveAdd">Add Caregiver</button>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
 
<script src="../js/users.js"></script>