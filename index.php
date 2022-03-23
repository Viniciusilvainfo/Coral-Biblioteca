<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coral Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="margin">
            <?php if(isset($_SESSION['nome'])) {
                echo 'Olá '. ucfirst($_SESSION['nome']);
            }else {
                echo 'Coral Biblioteca';
            } 
            ?>
        </div>
        <div class="margin">
            <a href="index.php">Livros disponíveis</a>
        </div>
        <div class="margin">
            <?php 
                if(isset($_SESSION['nome'])) {
                    echo '<a href="listarMeusLivros.php">Meus livros</a>';
                } else {
                    echo '<a href="index.php?acao=cadastro">Cadastre-se</a> <br>';
                    echo '<a href="index.php?acao=login">Login</a>';
                }
            ?>
        </div>
    </header>
    <?php
        if(isset($_GET['erro'])) {
            if($_GET['erro'] == 3) {
                echo '<h5 class="erro">Email inválido</h5>';
            }else if($_GET['erro'] == 4) {
                echo '<h5 class="erro">Senha inválida</h5>';
            }else if($_GET['erro'] == 5) {
                echo '<h5 class="erro">Esse email já foi cadastrado</h5>';
            }
        }
        if(isset($_GET['acao'])) {
            if($_GET['acao'] == "registrado") {
                echo '<h5>Registrado com sucesso</h5>';
            }else if($_GET['acao'] == "logue") {
                echo '<h5 class="erro">Faça login para pode alugar</h5>';
            }
        }
    ?>
    <?php

        if(isset($_GET['acao'])) {
            if($_GET['acao'] == "cadastro") {
                ?>
                <div class="container">
                    <div class="cadastro interno">
                        <h3>Cadastre-se</h3>
                        <form action="cadastro.php" class="formulario" method="post">
                            <label for="nome">Nome:</label>
                            <input id="nome" name="nome" type="text" required>
                            <label for="senha">Senha:</label>
                            <input id="senha" name="senha" type="password" required>
                            <label for="email">Email:</label>
                            <input id="email" name="email" type="email" required>
                            <button type="submit">Cadastrar</button>
                        </form>
                    </div>
                </div>
                <?php
            }else if($_GET['acao'] == "login" || $_GET['acao'] == "registrado" || $_GET['acao'] == "logue") {
                    ?>
                    <div class="container">
                        <div class="login interno">
                            <h3>Login</h3>
                            <form action="login.php" class="formulario" method="post">
                                <label for="emailLogin">Email:</label>
                                <input id="emailLogin" name="emailLogin" type="email" required>
                                <label for="senhaLogin">Senha:</label>
                                <input id="senhaLogin" name="senhaLogin" type="password" required>
                                <button type="submit">Logar</button>
                            </form>
                        </div>
                    </div>
                    <?php
            }
        }

        if(isset($_GET['erro'])) {
            if($_GET['erro'] == 1) {
                echo '<h5 class="erro">Você já alugou esse livro </h5>';
            }else if($_GET['erro'] == 2) {
                echo '<h5 class="erro">Não existem cópias desse livro disponíveis </h5>';
            }
        }

        //$conexao = mysqli_connect("sql104.epizy.com", "epiz_31354366", "9xWAQ08U31xfkB", "epiz_31354366_biblioteca") or print (mysqli_error());
        $conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());

        $query = "select id, titulo, ano, quantidade from livros";

        $result = mysqli_query($conexao, $query);

        if(isset($result)) {

            echo '<table border=1>';
            echo '<tr><td>Livro</td><td>Ano</td><td>Quantidade</td><td>Ações</td></tr>';
                while($aux = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                        <td><a href="listar.php?id='.$aux['id'].'">'.$aux['titulo'].'</a></td>
                        <td>'.$aux['ano'].'</td>
                        <td>'.$aux['quantidade'].'</td>
                        <td><a href="alugar.php?id='.$aux['id'].'">Alugar</a></td>
                        </tr>';
                }
            echo '</table>';
        }else {
            echo 'Nenhum livro encontrado';
        }

        if(isset($_SESSION['nome'])) {
            echo '<a class="centro" href="sair.php">Sair</a>';
        }
    ?>
</body>
</html>