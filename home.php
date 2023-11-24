<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro para Churrasco</title>
</head>

<body>
    <h1>Cadastro para Churrasco</h1>

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
            echo "Cadastro realizado com sucesso!";

            // Adiciona um botão para redirecionar para pagina_resultado.php
            echo "<form action='pagina_resultado.php' method='get'>
                    <input type='submit' value='Ver Resultados'>
                </form>";
        } else {
            echo "Erro ao cadastrar: " . $conexao->error;
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br><br>

        <label for="filhos">Quantidade de Filhos (0 a 5):</label>
        <input type="number" name="filhos" min="0" max="5" required><br><br>

        <label for="alimento">Escolha um alimento sólido:</label>
        <select name="alimento">
            <option value="picanha">Picanha</option>
            <option value="alcatra">Alcatra</option>
            <option value="fraldinha">Fraldinha</option>
            <option value="maminha">Maminha</option>
            <option value="costela">Costela</option>
            <option value="contrafile">Contrafilé</option>
            <option value="linguica">Linguiça</option>
        </select><br><br>

        <label for="bebida">Escolha uma bebida:</label>
        <select name="bebida">
            <option value="suco">Suco</option>
            <option value="refrigerante">Refrigerante</option>
            <option value="água">Cerveja</option>
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>
