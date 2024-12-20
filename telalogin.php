<?php
include('conexão.php');

//Verificando se existe usuario e senha
if(isset($_POST['Usuário']) || isset($_POST['Senha'])) {

//Verificando se os campos foram preenchidos
    if(strlen($_POST['Usuário']) == 0) {
        echo "Preencha o nome do Usuário";
    } else if(strlen($_POST['Senha']) == 0) {
        echo "Preencha sua Senha";
    } else {
//Codigo do login
        $Usuário = $mysqli->real_escape_string($_POST['Usuário']);
        $Senha = $mysqli->real_escape_string($_POST['Senha']);

        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$Usuário' AND senha = '$Senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
//Se existir usuario faça isso            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
//Se nao faça isso
        } else {
            echo "Falha ao logar! Usuário ou senha incorretos";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="ico\globo.ico">
    <title>Login</title>
    <link rel="stylesheet" href="css\estilotelalogin.css">
</head>
<body>
    <div class="logo-marca">
    <h1>Escola Inova</h1>
    </div>
</br>
  <div class="main-login">
    <h1>Login</h1>
    <form action="" method="POST">
        <p class="textfield">
            <label>Usuário</label>
            <input type="text" name="Usuário">
        </p>
        <p class="textfield">
            <label>Senha</label>
            <input type="password" name="Senha">
        </p>
        <p>
            <button class="btn-login" type="submit">Entrar</button>
        </p>
    </form>
  </div>
</body>
</html>