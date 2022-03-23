<?php

$email = $_POST['email'];

//$conexao = mysqli_connect("sql104.epizy.com", "epiz_31354366", "9xWAQ08U31xfkB", "epiz_31354366_biblioteca") or print (mysqli_error());
$conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());

$queryemail = "select email from usuarios where email like '".$email."'";

$result = mysqli_query($conexao, $queryemail);

$teste = mysqli_fetch_array($result);

if(isset($teste['email'])) {
    @header("Location: index.php?erro=5");
}else {
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $custo = '08';
    $salt = 'Cf1f11ePArKlBJomM0F6aJ';
    
    $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

    $sql = "insert into usuarios (email, nome, senha) values ('".$email."','".$nome."','".$hash."')";

    $result2 = mysqli_query($conexao, $sql);

    if($result2) @header("Location: index.php?acao=registrado");

}

mysqli_close($conexao);
?>