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
                        <th>ID </th>
                        <th>Admin</th>
                        <th>Cuidador</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td>
                            <?php if ($user->getIsAdmin()): ?>
                                <i class="fa-solid fa-user"></i>
                            <?php else: ?>
                                <i class="fa-regular fa-user"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($user->getIdCuidador() === null && ! $user->getIsAdmin()): ?>
                                <a href="/cuidador/<?= $user->getId() ?>/pacientes" >
                                    <i class="fa-solid fa-user-nurse"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td><?= $user->getNameUser() ?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td>
                            <?php if ($user->getStatus() === 'Active'): ?>
                                <span class="badge bg-success"><?= $user->getStatus() ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?= $user->getStatus() ?></span>
                            <?php endif; ?>
                        
                        </td>
                        <td>2024-01-10</td>
                        <td>2024-02-20 14:32</td>
                        <td>
                            <a href="/users/<?= $user->getId() ?>/edit" class="btn btn-sm btn-warning edit-btn"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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
<script src="/assets/js/users.js"></script>
<?php include __DIR__ . "/../includes/footer.php"; ?>