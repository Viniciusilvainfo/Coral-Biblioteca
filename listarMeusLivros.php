<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meus Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="margin">
            Olá <?php echo ucfirst($_SESSION['nome']) ?> 
        </div>
        <div class="margin">
            <a href="index.php">Livros disponíveis</a>
        </div>
        <div class="margin">
            <a href="listarMeusLivros.php">Meus livros</a>    
        </div>
    </header>
    <?php

        if(isset($_GET['status'])) {
            if($_GET['status'] == 1) {
                echo '<h5>Livro alugado com sucesso</h5>';
            }else if($_GET['status'] == 2) {
                echo '<h5>Livro devolvido com sucesso</h5>';
            }
        }

        //$conexao = mysqli_connect("sql104.epizy.com", "epiz_31354366", "9xWAQ08U31xfkB", "epiz_31354366_biblioteca") or print (mysqli_error());
        $conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());

        $queryMeusLivros = "select livros.id as id, livros.titulo as titulo, livros.ano as ano from livros join alugar on alugar.livro = livros.id where alugar.usuario like '".$_SESSION['email']."' and alugar.ativo = 'sim'";
        $result = mysqli_query($conexao, $queryMeusLivros);

        echo '<table border=1>';
        echo '<tr><td>Livro</td><td>Ano</td><td>Ações</td></tr>';
        while($aux = mysqli_fetch_assoc($result)) {
            echo '<tr>
                <td><a href="listar.php?id='.$aux['id'].'">'.$aux['titulo'].'</a></td>
                <td>'.$aux['ano'].'</td>
                <td><a href="devolver.php?id='.$aux['id'].'">Devolver</a></td>
                </tr>';
        }
        echo '</table> <br> <br>';

        if(isset($_SESSION['nome'])) {
            echo '<a class="centro" href="sair.php">Sair</a>';
        }
    ?>
</body>
</html>