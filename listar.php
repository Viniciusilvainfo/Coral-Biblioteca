<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

$livro = $_GET['id'];

//$conexao = mysqli_connect("sql104.epizy.com", "epiz_31354366", "9xWAQ08U31xfkB", "epiz_31354366_biblioteca") or print (mysqli_error());
$conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());

$querylivro = "select titulo, autores, ano, editora, quantidade from livros where id = ".$livro;

$result = mysqli_query($conexao, $querylivro);

echo '<table border=1>';
echo '<tr><td>Livro</td><td>Ano</td><td>Autores</td><td>editora</td></tr>';
while($aux = mysqli_fetch_assoc($result)) {
    echo '<tr><td>'.$aux['titulo'].'</td><td>'.$aux['ano'].'</td><td>'.$aux['autores'].'</td><td>'.$aux['editora'].'</td></tr>';
}
echo '</table>';

echo '<a class="centro" href="index.php">Voltar</a> <br>';

if(isset($_SESSION['nome'])) {
    echo '<a class="centro" href="sair.php">Sair</a>';
}

?>

</body>
</html>