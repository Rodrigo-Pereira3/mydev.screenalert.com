<?php include __DIR__ . "/../includes/header.php"; ?>

<main class="container mt-4">

    <h1 class="h3 mb-4">Caretaker <?= $user->getNameUser() ?> Management Painel</h1>


    <div class="col-6">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title"><?= $user->getNameUser() ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $user->getEmail() ?></h6>
                    <?php if ($user->getStatus() === 'Active'): ?>
                        <span class="badge bg-danger"><?= $user->getStatus() ?></span>
                    <?php else: ?>
                        <span class="badge bg-secondary"><?= $user->getStatus() ?></span>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if ($user->getIsAdmin()): ?>
                        <i class="fa-solid fa-user" style="font-size: 4rem"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-user" style="font-size: 4rem"></i>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
                <tbody id="pacienteTable">
                    <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                            <td><?= $paciente->getId() ?></td>
                            <td>
                                <?php if ($paciente->getIsAdmin()): ?>
                                    <i class="fa-solid fa-paciente"></i>
                                <?php else: ?>
                                    <i class="fa-regular fa-paciente"></i>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($paciente->getIdCuidador() === null && !$paciente->getIsAdmin()): ?>
                                    <a href="/pacientes/<?= $paciente->getId() ?>/pacientes">
                                        <i class="fa-solid fa-paciente-nurse"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?= $paciente->getNameUser() ?></td>
                            <td><?= $paciente->getEmail() ?></td>
                            <td>
                                <?php if ($paciente->getStatus() === 'Active'): ?>
                                    <span class="badge bg-danger"><?= $paciente->getStatus() ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= $paciente->getStatus() ?></span>
                                <?php endif; ?>

                            </td>
                            <td>2024-01-10</td>
                            <td>2024-02-20 14:32</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
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

<script src="/assets/js/patientss.js"></script>
<?php include __DIR__ . "/../includes/footer.php"; ?>