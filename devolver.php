<?php

session_start();

$livro = $_GET['id'];

//$conexao = mysqli_connect("sql104.epizy.com", "epiz_31354366", "9xWAQ08U31xfkB", "epiz_31354366_biblioteca") or print (mysqli_error());
$conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());

$querylivro = "select quantidade from livros where id = ".$livro;

$result = mysqli_query($conexao, $querylivro);

$aux = mysqli_fetch_assoc($result);

$sql = "insert into alugar (usuario, livro) values ('".$_SESSION['email']."', $livro)";

$insert = mysqli_query($conexao, $sql);

$quantidade = (int)$aux['quantidade'] + 1;
$updateLivro = "update livros set quantidade = ".$quantidade." where id = ".$livro;
$update = mysqli_query($conexao, $updateLivro);

$updateAlugar = "update alugar set ativo = 'nao' where livro = ".$livro." and usuario like '".$_SESSION['email']."'";
$update = mysqli_query($conexao, $updateAlugar);

if(isset($update) && isset($insert)) @header("Location: listarMeusLivros.php?status=2");

?>