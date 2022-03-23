<?php

$email = $_POST['emailLogin'];

$conexao = mysqli_connect("localhost", "root", "", "biblioteca") or print (mysqli_error());

$queryemail = "select senha, email, nome from usuarios where email like '".$email."'";

$result = mysqli_query($conexao, $queryemail);

$teste = mysqli_fetch_array($result);

if(isset($teste)) {
    $senha = $_POST['senhaLogin'];

    $hash = $teste['senha'];
    if (crypt($senha, $hash) === $hash) {
        session_start();
        $_SESSION['nome'] = $teste['nome'];
        $_SESSION['email'] = $teste['email'];
        @header("Location: index.php");
    } else {
        @header("Location: index.php?erro=4");
    }

}else {
    @header("Location: index.php?erro=3");
}
?>