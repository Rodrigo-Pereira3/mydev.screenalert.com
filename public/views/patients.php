<?php include __DIR__ . "/../includes/header.php"; ?>   

<!-- MAIN CONTENT -->
    <main class="container mt-4">

        <h1 class="h3 mb-4">Patient Management</h1>

        <div class="mb-3">
            <button class="btn btn-primary" id="openAddModal">+ Add New Patient</button>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Caregiver</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Last Update</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="patientTable">
                        <tr>
                            <td>101</td>
                            <td>Carlos Mendes</td>
                            <td>Maria Silva</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>2024-01-12</td>
                            <td>2024-02-20</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>Joana Rocha</td>
                            <td>João Pereira</td>
                            <td><span class="badge bg-danger">Inactive</span></td>
                            <td>2024-01-20</td>
                            <td>2024-02-18</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>103</td>
                            <td>António Costa</td>
                            <td>Ana Costa</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>2024-02-02</td>
                            <td>2024-02-22</td>
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

    <!-- FIX 1: Modal de Edit (duplicado removido, ficou apenas um) -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Patient</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input id="editName" class="form-control mb-2" placeholder="Name">
                    <input id="editCaregiver" class="form-control mb-2" placeholder="Caregiver">
                    <select id="editStatus" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="saveEdit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FIX 2: Modal de Add que estava completamente em falta -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Patient</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input id="addName" class="form-control mb-2" placeholder="Name">
                    <input id="addCaregiver" class="form-control mb-2" placeholder="Caregiver">
                    <select id="addStatus" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="saveAdd">Add Patient</button>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . "/../includes/footer.php"; ?>
    <script src="../js/patients.js"></script>   