<?php
include_once 'includes/header.php';
include_once 'includes/footer.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login-crud';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Erro na conexão com o BD: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Perfil</title>
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
			<h2>Perfil do usuário</h2>
			<div>
				<p>Detalhes da conta:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Senha:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>