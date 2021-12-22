<?php
include_once 'includes/header.php';
include_once 'includes/footer.php';
session_start();
// Se o usuário não estiver logado será redirecionado para index.html
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sistema de cadastro - CRUD</title>
	</head>
	<body>
        <nav class="navbar navbar-expand-lg" style="background-color: #2F3947; color:#fff;">
            <div class="container-fluid">
                <span class="">Bem-vindo, <?=$_SESSION['name']?>!</span>
                <a href="home-crud.php" class="icon"><i class="fas fa-home"></i> Home</a>
				<a href="profile.php" class="icon"><i class="fas fa-user-circle"></i> Perfil</a>
				<a href="logout.php" class="icon"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
		</nav>

		<div class="content">
			<h2>Tabela</h2>
		</div>

      
	
	</body>
</html>

