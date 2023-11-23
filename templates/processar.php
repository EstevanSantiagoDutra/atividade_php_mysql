<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "5896matilde";
$dbName = "churrasco_db";

$conexao = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conexao->connect_errno) {
    die("Erro na conexão: " . $conexao->connect_error);
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $filhos = $_POST['filhos'];
    $alimentoSolido = $_POST['alimento'];
    $bebida = $_POST['bebida'];

    $sql = "INSERT INTO convidados (nome, filhos, alimento_solido, bebida) VALUES ('$nome', $filhos, '$alimentoSolido', '$bebida')";

    if ($conexao->query($sql) === TRUE) {
        $conexao->close();
        header("Location: pagina_resultado.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
} else {
    echo "Erro: O formulário não foi enviado corretamente.";
}

$conexao->close();
?>
