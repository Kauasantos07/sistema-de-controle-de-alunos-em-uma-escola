<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="ico/globo.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css\estilocalculonota.css">
    <title>Cálculo de Notas</title>
    <style>
        .alta {
            color: green; /* Cor verde para notas altas */
            font-weight: bold; /* Destaca em negrito */
        }
        .baixa {
            color: red; /* Cor vermelha para notas baixas */
            font-weight: bold; /* Destaca em negrito */
        }
    </style>
</head>
<body>

    <div class="container">
      <div class="quadrado01"><h1>Escola Inova</h1></div>
      <div class="quadrado02"><h1>Dashboard ADMIN</h1></div>
    </div>

    <div class="main-table">
      <h1>Cálculo de Notas dos Aluno</h1>

          <form method="POST">
            <p  class="textfield" >
            <label for="id">ID do Aluno:</label>
            <input type="number" name="id" required><br/>
            </p>

            <p  class="textfield" >
            <label for="nome">Nome do Aluno:</label> 
            <input type="text" name="nome" required><br/>
            </p>

            <p  class="textfield" >
            <label for="nota1">Nota 1:</label>
            <input type="number" name="nota1" step="0.01" required><br/>
            </p>

            <p  class="textfield" >
            <label for="nota2">Nota 2:</label>
            <input type="number" name="nota2" step="0.01" required><br/>
            </p>

            <p  class="textfield" >
            <label for="nota3">Nota 3:</label>
            <input type="number" name="nota3" step="0.01" required><br/>
            </p>

            <p>
            <button class="btn-calcular" type="submit">Calcular Média</button>
            </p>
    </form>

    <?php
    // Conectar ao banco de dados
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=area_de_salas", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $id = (int)$_POST['id'];
            $nome = $_POST['nome'];
            $nota1 = $_POST['nota1'];
            $nota2 = $_POST['nota2'];
            $nota3 = $_POST['nota3'];

            // Calcula a média 
            $nota = ($nota1 + $nota2 + $nota3) / 3;
            $recu = (6-$nota);
            $situacao = ($nota<6)? "<span style='color: red;'>REPROVADO</span> para ser aprovado e preciso de mais $recu pontos" : "<span style='color: green;'>APROVADO</span>";

            // Exibe o resultado
            echo "<h2>Resultados para $nome</h2>";
            echo "<p>Média: <span class='" . ($nota >= 6 ? "alta" : "baixa") . "'>" . number_format($nota, 2) . "</span></p>";
            echo "<p>$nome $situacao</p>";
            
            // Destaque as notas
            echo "<h3>Notas:</h3>";
            echo "<ul>";
            echo "Nota 1: <span class='" . ($nota1 >= 6 ? "alta" : "baixa") . "'>" . number_format($nota1, 2) . "</span>";
            echo "</br>";
            echo "Nota 2: <span class='" . ($nota2 >= 6 ? "alta" : "baixa") . "'>" . number_format($nota2, 2) . "</span>";
            echo "</br>";
            echo "Nota 3: <span class='" . ($nota3 >= 6 ? "alta" : "baixa") . "'>" . number_format($nota3, 2) . "</span>";
            echo "</br>";
            echo "</ul>";

            // Inserir os dados no banco de dados
           $stmt = $pdo->prepare("UPDATE sala02 SET nota = :nota WHERE id = :id");
           $stmt->bindParam(':id', $id, PDO::PARAM_INT);
           $stmt->bindParam(':nota', $nota, PDO::PARAM_STR);
            $stmt->execute();
 
            echo "<p>Notas registradas com sucesso!</p>";
        }
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }

    // Fecha a conexão
    $pdo = null;
    ?>
    </div>
  </body>
</html>
