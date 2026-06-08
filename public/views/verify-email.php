<?php
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start();
/** @var string $token */
?>
<!doctype html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verificar email</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #f4f4f0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .card {
      width: 100%;
      max-width: 440px;
      background: #fff;
      border: 0.5px solid rgba(0, 0, 0, 0.12);
      border-radius: 12px;
      padding: 2.5rem 2rem;
    }

    .icon-ring {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: #e6f1fb;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.25rem;
    }

    .icon-ring i {
      font-size: 24px;
      color: #185fa5;
    }

    h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 22px;
      font-weight: 400;
      color: #1a1a1a;
      margin-bottom: 6px;
    }

    .subtitle {
      font-size: 14px;
      color: #666;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    label {
      display: block;
      font-size: 13px;
      font-weight: 500;
      color: #555;
      margin-bottom: 6px;
      letter-spacing: 0.01em;
    }

    .input-wrap {
      position: relative;
      margin-bottom: 10px;
    }

    input[type="password"],
    input[type="text"] {
      width: 100%;
      padding: 10px 42px 10px 14px;
      font-size: 15px;
      font-family: 'DM Sans', sans-serif;
      background: #f8f8f6;
      border: 0.5px solid rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      color: #1a1a1a;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }

    input:focus {
      border-color: #185fa5;
      box-shadow: 0 0 0 3px rgba(24, 95, 165, 0.12);
    }

    .toggle-btn {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      color: #999;
      display: flex;
      align-items: center;
    }

    .toggle-btn i {
      font-size: 18px;
    }

    .strength-bars {
      display: flex;
      gap: 5px;
      margin-bottom: 8px;
    }

    .bar {
      flex: 1;
      height: 3px;
      border-radius: 2px;
      background: #e0e0e0;
      transition: background 0.3s;
    }

    .bar.weak {
      background: #e24b4a;
    }

    .bar.ok {
      background: #ef9f27;
    }

    .bar.good {
      background: #639922;
    }

    .strength-hint {
      font-size: 12px;
      color: #999;
      margin-bottom: 1.5rem;
    }

    .btn-submit {
      width: 100%;
      padding: 11px;
      font-family: 'DM Sans', sans-serif;
      font-size: 15px;
      font-weight: 500;
      border: none;
      border-radius: 8px;
      background: #185fa5;
      color: #fff;
      cursor: pointer;
      transition: opacity 0.15s, transform 0.1s;
    }

    .btn-submit:hover {
      opacity: 0.9;
    }

    .btn-submit:active {
      transform: scale(0.99);
    }

    .btn-submit:disabled {
      opacity: 0.45;
      cursor: not-allowed;
      transform: none;
    }

    .footer-note {
      margin-top: 1.25rem;
      display: flex;
      align-items: flex-start;
      gap: 8px;
      font-size: 13px;
      color: #aaa;
      line-height: 1.5;
    }

    .footer-note i {
      font-size: 15px;
      margin-top: 1px;
      flex-shrink: 0;
    }
  </style>
</head>

<body>
  <div class="card">
    <div class="icon-ring" aria-hidden="true">
      <i class="ti ti-mail-check"></i>
    </div>

    <h1>Definir password</h1>
    <p class="subtitle">Escolhe uma password segura para ativar a tua conta.</p>

    <?php require __DIR__ . '/partials/toasts.php'; ?>

    <form method="post" action="/verify-email">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

      <label for="pw">Nova password</label>
      <div class="input-wrap">
        <input id="pw" type="password" name="password" required autocomplete="new-password"
          placeholder="Mínimo 6 caracteres" oninput="updateStrength(this.value)">
        <button class="toggle-btn" type="button" onclick="togglePw()" aria-label="Mostrar password">
          <i class="ti ti-eye" id="eye-icon"></i>
        </button>
      </div>

      <div class="strength-bars">
        <div class="bar" id="b1"></div>
        <div class="bar" id="b2"></div>
        <div class="bar" id="b3"></div>
      </div>
      <p class="strength-hint" id="strength-hint">Introduz uma password para continuar</p>

      <button class="btn-submit" type="submit" id="submit-btn" disabled>Confirmar</button>
    </form>

    <div class="footer-note">
      <i class="ti ti-clock" aria-hidden="true"></i>
      <span>O link expira em 5 minutos. Se expirar, solicita um novo.</span>
    </div>
  </div>

  <script>
    function updateStrength(val) {
      const b1 = document.getElementById('b1');
      const b2 = document.getElementById('b2');
      const b3 = document.getElementById('b3');
      const hint = document.getElementById('strength-hint');
      const btn = document.getElementById('submit-btn');

      [b1, b2, b3].forEach(b => b.className = 'bar');

      if (val.length === 0) {
        hint.textContent = 'Introduz uma password para continuar';
        btn.disabled = true;
        return;
      }
      if (val.length < 6) {
        b1.classList.add('weak');
        hint.textContent = 'Muito curta — mínimo 6 caracteres';
        btn.disabled = true;
        return;
      }

      let score = 0;
      if (val.length >= 8) score++;
      if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;

      if (score === 0) {
        b1.classList.add('ok');
        hint.textContent = 'Fraca — tenta adicionar números ou maiúsculas';
      } else if (score === 1) {
        b1.classList.add('good'); b2.classList.add('good');
        hint.textContent = 'Razoável';
      } else {
        b1.classList.add('good'); b2.classList.add('good'); b3.classList.add('good');
        hint.textContent = 'Forte!';
      }
      btn.disabled = false;
    }

    function togglePw() {
      const input = document.getElementById('pw');
      const icon = document.getElementById('eye-icon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'ti ti-eye-off';
      } else {
        input.type = 'password';
        icon.className = 'ti ti-eye';
      }
    }
  </script>
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