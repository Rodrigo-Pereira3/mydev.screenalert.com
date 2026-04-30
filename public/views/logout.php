<?php
session_start();

// Limpa e destrói a sessão
$_SESSION = [];
session_destroy();

// Vai para a home
header("Location: /home");
exit();