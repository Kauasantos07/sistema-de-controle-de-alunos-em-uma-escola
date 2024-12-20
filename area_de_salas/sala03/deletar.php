<?php 

	if($_GET && isset($_GET["id"])){

		try {
			$pdo = new PDO("mysql:host=localhost;dbname=area_de_salas", 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$prepare = $pdo->prepare("DELETE FROM `sala03` WHERE id=:id");

			$id = $_GET["id"];
			$nome = $_GET["nome"];
			$prepare->bindParam(':id', $id);

			$prepare->execute();

			header("Location: sala03.php?mensagem=O Aluno com o nome ". $nome ." foi excluído da lista com sucesso! Essa ação não pode ser desfeite.");

	  } catch(PDOException $e){
	    die("Erro na conexão: " . $e->getMessage());

	  } finally {
	    $pdo = null;
	  }

	}


?>