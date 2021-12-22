<?php
session_start();
session_destroy();
// Redireciona para login
header('Location: index.html');
?>