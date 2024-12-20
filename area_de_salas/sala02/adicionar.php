<?php  

if ($_POST) {
	$nome = $_POST['nome'];
	$data_de_nascimento = $_POST['data_de_nascimento'];
	$serie = $_POST['serie'];
  $turma = $_POST['turma'];

try {
  $pdo = new PDO("mysql:host=localhost;dbname=area_de_salas", 'root', '');

  $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $prepare = $pdo->prepare("insert into `sala02` (`nome`, `data_de_nascimento`, `serie`, `turma`) values (:nome, :data_de_nascimento, :serie, :turma)");

  $prepare->bindParam(':nome', $nome, PDO:: PARAM_STR);
  $prepare->bindParam(':data_de_nascimento', $data_de_nascimento, PDO::PARAM_STR);
  $prepare->bindParam(':serie', $serie, PDO::PARAM_STR);
  $prepare->bindParam(':turma', $turma, PDO::PARAM_STR);

          $prepare->execute();

          header("Location: sala02.php?mensagem=O aluno ". $nome ." foi inserido com sucesso!!");
  
 } catch (PDOException $e) {

  die("Erro na conexão: " . $e->getMessage());

 } finally{
  $pdo = null;
 }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="ico/globo.ico">
    <title>Adicionar Aluno</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css\estiloadicionar.css">
  </head>
  <body>

    <div class="container">
      <div class="quadrado01"><h1>Escola Inova</h1></div>
      <div class="quadrado02"><h1>Dashboard ADMIN</h1></div>
    </div>

    <div class="main-table">

    <h1>Adicionar Novo Aluno</h1>
    <br/>

    	<form method="post">
        <p class="textfield">
    		<label>Nome do Aluno(a)</label><br/>
    		<input type="text" name="nome" id="nome" value=""><br/>
        </p>

        <p class="textfield">
    		<label>Data de Nascimento</label><br/>
    		<input type="text" name="data_de_nascimento" id="data_de_nascimento" value=""><br/>
        </p>

        <p class="textfield">
    		<label>Série</label><br/>
    		<input type="text" name="serie" id="serie" value=""><br/>
        </p>

        <p class="textfield">
        <label>Turma</label><br/>
        <input type="text" name="turma" id="turma" value=""><br/>
        </p>

        <p>
    		<input class="btn-cadastrar" type="submit" name="Cadastrar">
        </p>
    	</form>

    </div>
  </body>
</html>