<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados do Churrasco</title>
</head>

<body>
    <h1>Resultados do Churrasco</h1>

    <?php
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "5896matilde";
    $dbName = "churrasco_db";

    $conexao = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conexao->connect_errno) {
        die("Erro na conexão: " . $conexao->connect_error);
    } 

    $sql = "SELECT nome, filhos, alimento_solido, bebida FROM convidados";
    $resultado = $conexao->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>Filhos</th>
                <th>Solido</th>
                <th>Liquido</th>
            </tr>";

        $totalSolido = 0;
        $totalLiquido = 0;

        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['nome'] . "</td>
                <td>" . $row['filhos'] . "</td>
                <td>" . $row['alimento_solido'] . "</td>
                <td>" . $row['bebida'] . "</td>
            </tr>";

            $totalSolido += calcularPeso($row['filhos']);
            $totalLiquido += calcularVolume($row['filhos']);
        }

        echo "</table>";

        echo "<p>Total a ser comprado para o churrasco:</p>";
        echo "<p>Solido: " . $totalSolido . " kg <img src='barbecue-1239434_640.jpg' alt='Solido'></p>";
        echo "<p>Liquido: " . $totalLiquido . " l <img src='orange-juice-67556_640.jpg' alt='Liquido'></p>";
    } else {
        echo "Nenhum dado encontrado.";
    }

    $conexao->close();

    function calcularPeso($filhos) {
        // 0.5 kg por adulto e 0.25 kg por criança
        return 0.5 * (1 + 0.25 * $filhos);
    }

    function calcularVolume($filhos) {
        // 1 l por adulto e 0.5 l por criança
        return 1 * (1 + 0.5 * $filhos);
    }
    ?>
</body>

</html>
