<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "5896matilde";
$dbName = "churrasco_db";

$conexao = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conexao->connect_errno) {
    die("Erro na conexão: " . $conexao->connect_error);
} 

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $filhos = $_POST['filhos'];
    $alimentoSolido = $_POST['alimento'];
    $bebida = $_POST['bebida'];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO convidados (nome, filhos, alimento_solido, bebida) VALUES ('$nome', $filhos, '$alimentoSolido', '$bebida')";

    if ($conexao->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
} else {
    echo "Erro: O formulário não foi enviado corretamente.";
}

// Função para calcular a quantidade total de alimentos sólidos e líquidos
function calcularTotal($conexao) {
    $sql = "SELECT SUM(filhos) AS total_filhos, SUM(CASE WHEN nome = 'adulto' THEN filhos ELSE 0 END) AS total_adultos FROM convidados";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $totalFilhos = $row['total_filhos'];
        $totalAdultos = $row['total_adultos'];

        $totalAlimentoSolido = ($totalAdultos * 0.5) + ($totalFilhos * 0.25);
        $totalLiquido = ($totalAdultos * 1) + ($totalFilhos * 0.5);

        echo "Total de Alimento Sólido: " . $totalAlimentoSolido . " kg<br>";
        echo "Total de Líquido: " . $totalLiquido . " l";
    } else {
        echo "Erro ao calcular o total: " . $conexao->error;
    }
}

// Chama a função para calcular e exibir o total
calcularTotal($conexao);

// Fecha a conexão
$conexao->close();
?>
