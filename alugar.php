<?php

session_start();

if(isset($_SESSION['nome'])) {

    $livro = $_GET['id'];

    //conexão original
    //$conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());
    $conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());

    $querylivro = "select quantidade from livros where id = ".$livro;

    $result = mysqli_query($conexao, $querylivro);

    $aux = mysqli_fetch_assoc($result);
        
    if ($aux['quantidade'] > 0) {

        $testelivro = "select transacao from alugar where usuario like '".$_SESSION['email']."' and ativo like 'sim' and livro = ".$livro;
        $testel = mysqli_query($conexao, $testelivro);
        $row = $testel->fetch_array();
        if(isset($row)) {
            @header("Location: index.php?erro=1");
        }else {

        $sql = "insert into alugar (usuario, livro, ativo) values ('".$_SESSION['email']."', $livro, 'sim')";

        $insert = mysqli_query($conexao, $sql);

        $quantidade = (int)$aux['quantidade'] - 1;
        $updateLivro = "update livros set quantidade = ".$quantidade." where id = ".$livro;
        $update = mysqli_query($conexao, $updateLivro);

        if(isset($update) && isset($insert)) @header("Location: listarMeusLivros.php?status=1");

        }
    }else {
        @header("Location: index.php?erro=2");
    }

}else {
    @header("Location: index.php?acao=logue");
}
?>