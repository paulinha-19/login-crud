<?php
//Processa e valida os dados do formulário enviado do arquivo index.html

session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login-crud';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Erro na conexão com o BD: ' . mysqli_connect_error());
}
// Verifica se os inputs estão vazios. Se tiver o form não será enviado.
if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Por favor, preencha os campos de nome de usuário e senha!');
}
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if ($_POST['password'] === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: home-crud.php');
        } else {
            // Senha incorreta
            echo 'Usuário incorreto e/ou senha!';
        }
    } else {
        // Usuário incorreto
        echo 'Usuário incorreto e/ou senha!';
    }
	$stmt->close();
}
?>