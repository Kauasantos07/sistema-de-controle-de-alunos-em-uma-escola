  <?php

  if($_POST){ 

    $nome = $_POST['nome'];
    $data_de_nascimento = $_POST['data_de_nascimento'];
    $serie = $_POST['serie'];
    $turma = $_POST['turma'];

    try {
    //codigo
      $pdo = new PDO("mysql:host=localhost;dbname=area_de_salas", 'root', '');

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $prepare = $pdo->prepare("UPDATE `sala02` SET `nome`=:nome, `data_de_nascimento`=:data_de_nascimento, `serie`=:serie, `turma`=:turma WHERE id=:id");



      $id = $_GET["id"];
      
      $prepare->bindParam(':nome', $nome, PDO:: PARAM_STR);
      $prepare->bindParam(':data_de_nascimento', $data_de_nascimento, PDO::PARAM_STR);
      $prepare->bindParam(':serie', $serie, PDO::PARAM_STR);
      $prepare->bindParam(':turma', $turma, PDO::PARAM_STR);
      $prepare->bindParam(':id', $id);


      $prepare->execute();

      header("Location: sala02.php?mensagem=O aluno ". $nome ." foi atualizado com sucesso!");

      } catch(PDOException $e){
        //se eu não conseguir faço isso
        die("Erro na conexão: " . $e->getMessage());

      } finally {
        //excutar finalização da sessão
        $pdo = null;
      }
    } else {
      if($_GET && isset($_GET["id"])){
          try {
            //codigo
            $pdo = new PDO("mysql:host=localhost;dbname=area_de_salas", 'root', '');

            //$query = "SELECT * FROM";
            $id = $_GET["id"];
            $registros = $pdo->query("SELECT * FROM sala02 WHERE id='$id'");

          } catch(PDOException $e){
            //se eu não conseguir faço isso
            die("Erro na conexão: " . $e->getMessage());

          } finally {
            //excutar finalização da sessão
            $pdo = null;
          }
        }
    }

  
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="ico/globo.ico">
    <title>Editar Aluno</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css\estiloeditar.css">
  </head>
  <body>

    <div class="container">
      <div class="quadrado01"><h1>Escola Inova</h1></div>
      <div class="quadrado02"><h1>Dashboard ADMIN</h1></div>
    </div>

    <div class="main-table">
      
    <h1>Editar Aluno</h1>
    <br/>

      <?php while($linha = $registros->fetch(PDO::FETCH_ASSOC)): ?>
        <form method="post">
          <p class="textfield">
          <label>Nome do Aluno</label><br/>
          <input type="text" name="nome" id="nome" value="<?= $linha["nome"]; ?>"><br/>
          </p>

          <p class="textfield">
          <label>Data de Nascimento</label><br/>
          <input type="text" name="data_de_nascimento" id="data_de_nascimento" value="<?= $linha["data_de_nascimento"]; ?>"><br/>
          </p>

          <p class="textfield">
          <label>Série</label><br/>
          <input type="text" name="serie" id="serie" value="<?= $linha["serie"]; ?>"><br/>
          </p>

          <p class="textfield">
          <label>Turma</label><br/>
          <input type="text" name="turma" id="turma" value="<?= $linha["turma"]; ?>"><br/>
          </p>

          <p>
          <input class="btn-editar" type="submit" value="Atualizar">
          </p>
        </form> 
      <?php endwhile; ?>

    </div>

  </body>
</html>