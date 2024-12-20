<?php

include('protect.php');


include('conexao.php');

// SQL para buscar todos os registros da tabela
$sql = "SELECT * FROM sala01";

$result = $mysqli->query($sql);// Inicializa um array para armazenar os registros

//Metodo de pesquisa 
if($_POST && isset($_POST["search"])){
    $search = $_POST["search"];

// Estabelece a conexão com o banco de dados
    try {
      // Cria uma nova instância do PDO para conexão ao banco de dados      
      $pdo = new PDO("mysql:host=localhost;dbname=area_de_salas", 'root', '');

      // Prepara uma declaração SQL com parâmetros nomeados
      $registros = $pdo->query("SELECT * FROM sala01 WHERE id LIKE '%$search%' OR nome LIKE '%$search%' OR data_de_nascimento LIKE '%$search%' OR serie LIKE '%$search%' OR turma LIKE '%$search%' OR nota LIKE '%$search%' ORDER BY id,nome,nota DESC");

    } catch(PDOException $e){

          // Caso ocorra um erro na conexão, encerra o script e exibe a mensagem de erro
      die("Erro na conexão: " . $e->getMessage());

// Fecha a conexão com o banco de dados
    } finally {
      $pdo = null;
    }

//Faça isso se nao funcionar

  } else {
     try {
      // Cria uma nova instância do PDO para conexão ao banco de dados 
      $pdo = new PDO("mysql:host=localhost;dbname=area_de_salas", 'root', '');

      // Prepara uma declaração SQL
      $registros = $pdo->query("SELECT * FROM sala01");

    } catch(PDOException $e){

          // Caso ocorra um erro na conexão, encerra o script e exibe a mensagem de erro
      die("Erro na conexão: " . $e->getMessage());

// Fecha a conexão com o banco de dados
    } finally {
      $pdo = null;
    }
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="ico/globo.ico">
    <title>Sala 01</title>
    <link rel="stylesheet" href="css\estilosala01.css">
    <meta charset="utf-8">
    <style>
      /* Estilos para as cores das notas */
      .nota-alta {
            color: green; /* Verde claro */
        }
      .nota-baixa {
            color: red; /* Vermelho claro */
        }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="quadrado01"><h1>Escola Inova</h1></div>
      <div class="quadrado02"><h1>Dashboard ADMIN</h1></div>
    </div>

      <div class="main-table">
          <h1 style="text-align: center">Alunos da sala 01</h1>
          <hr class="linha-estilizada01" />
          <h3 style="text-align: centro;">Lista de alunos</h3>         
  
          <div class="container02">
                <div><a href="adicionar.php" class="adicionaraluno">Adicionar Aluno</a></div>
                <div><a href="calculonota.php" class="calculonota">Calcular Nota dos Alunos</a></div>
          </div> 

          <p> 
            <div class="search">
             <form method="post">
              <input type="search" name="search" class="searchinput"> 
              <input type="submit" value="Pesquisar" class="searchinput02">
             </form>
            </div> 
          </p>

        </br>
          <table width="100%">
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Data de Nascimento</th>
              <th>Série</th>
              <th>Turma</th>
              <th>Notas</th>
              <th>Ações</th>
            </tr>

            <?php while($linha = $registros->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
              <td><?= $linha["id"]; ?></td>
              <td><?= $linha["nome"]; ?></td>
              <td><?= $linha["data_de_nascimento"]; ?></td>
              <td><?= $linha["serie"]; ?></td>
              <td><?= $linha["turma"]; ?></td>
              <?php
                    $nota = $linha["nota"];
                    if ($nota >= 6) {
                        $classeNota = "nota-alta"; // Para notas altas
                    } 
                    else {
                        $classeNota = "nota-baixa"; // Para notas baixas
                    }
              ?>
              <td class="<?= $classeNota; ?>"><?= $nota; ?></td>

          <td>
            <a  href='editar.php?id=<?= $linha["id"]; ?>'>
              <svg class='button-edit' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
              </svg>
            </a>
  
                  <a  href='#' onclick="confirmarExclusao(<?= $linha['id']; ?>)">
                    <svg class='button-trash' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                 </a>
                </td>
            </tr>
            <?php endwhile; ?>
          </table>
      </div>

      <script>
        function confirmarExclusao(id) {
          var confirmacao = confirm("Tem certeza que deseja excluir este aluno?");
          
          if (confirmacao) {
            // Redireciona para a página de exclusão
            window.location.href = "deletar.php?id=" + id;
          }
          // Caso o usuário cancele, não faz nada.
        }
      </script>
  </body>
</html>