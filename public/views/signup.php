<?php include __DIR__ . "/../includes/header.php"; ?>
<?php if(isset($_SESSION['flash_error'])): ?>
  <div class="alert alert-danger">
    <?php echo $_SESSION['flash_error']; ?>
  </div>
  <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-6 col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3">Sign up</h4>

          <form method="POST" action="/signup">
            <input name="username" value="Tan Tan" class="form-control mb-2" placeholder="Username" required>
            <input name="birth_date" value="2023-12-24" type="date" class="form-control mb-2" placeholder="Birth Date" required>
            <input name="email" value="tan.tan@gmail.com" type="email" class="form-control mb-2" placeholder="Email" required>
            <input name="password" value="1234" type="password" class="form-control mb-3" placeholder="Password" required>

            <button class="btn btn-primary w-100">Criar conta</button>
          </form>

        
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>