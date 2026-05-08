<footer class="footer">
    <div class="footer-content">
        <div class="footer-links">
            <a href="#privacy" id="footer-privacy">Privacy Policy</a>
            <a href="#terms" id="footer-terms">Terms of Service</a>
            <a href="#careers" id="footer-careers">Careers</a>
        </div>
        <div class="footer-copyright" id="footer-copy">
            © 2025 StrategicPro. All rights reserved.
        </div>
        <div class="footer-design">
            Design: <a href="https://www.tooplate.com" target="_blank">Tooplate</a>
        </div>
    </div>
</footer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    const toast = <?= json_encode($_SESSION["toast"] ?? null) ?>;
    <?php unset($_SESSION['toast']); ?>
    if (toast) {
        toastr[toast.type](toast.message);
    }
</script>