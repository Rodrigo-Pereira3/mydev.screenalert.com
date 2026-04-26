<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Screen Alert</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center mb-3">Login</h3>

        <form action="/dashboard" method="GET">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>

</body>
</html>
