<?php

include('protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="ico\globo.ico">
    <title>Painel de Salas</title>
    <link rel="stylesheet" href="css\estilopainel.css">
</head>
<body>

    <div class="container">
      <div class="quadrado01"><h1>Escola Inova</h1></div>
      <div class="quadrado02"><h1>Dashboard ADMIN</h1></div>
    </div>

      <br/>

      <div class="main-table">

       <p style="color: #c1e8ff">Bem-Vindo a Área de Salas, <?php echo $_SESSION['nome']; ?>.</p>

      <h1>Área de salas</h1>
      <hr class="linha-estilizada01" />
      <h3>Escolha uma sala para acessar</h3>
      <hr class="linha-estilizada02" />

      <table>
         <tr>
           <td style="width: 35%">
        </td>
          <td style="text-align: left;">
           <h4>Sala 01</h4>
            <p>
          <br/>
           <a href="area_de_salas/sala01/sala01.php?cod=1" class="botao-sala01">Entrar na sala<a/>
            </p>
           </td>
         </tr> 
       </table>

       <table>
          <tr>
            <td style="width: 35%">
        </td>
           <td style="text-align: left;">
          <h4>Sala 02</h4>
            <p>
          <br/>
          <a href="area_de_salas/sala02/sala02.php?cod=2" class="botao-sala02">Entrar na sala<a/>
            </p>
           </td>
         </tr> 
       </table>

       <table>
          <tr>
            <td style="width: 35%">
        </td>
           <td style="text-align: left;">
          <h4>Sala 03</h4>
            <p>
          <br/>
          <a href="area_de_salas/sala03/sala03.php?cod=3" class="botao-sala03">Entrar na sala<a/>
            </p>
           </td>
         </tr> 
       </table>

    <p>
        <a href="logout.php" class="botao-sair">Sair</a>
    </p>
    </div>
</body>
</html>