<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Screen Alert</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ADICIONA ISTO -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center mb-3">Login</h3>

        <form action="/login" method="POST">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>

    <!-- Antes do </body> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const toast = <?= json_encode($_SESSION["toast"] ?? null) ?>;
        <?php unset($_SESSION['toast']); ?>
        if (toast) {
            toastr[toast.type](toast.message);
        }
    </script>

</body>

</html>