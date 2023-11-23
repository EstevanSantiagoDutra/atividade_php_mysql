<?php

$dbHost= "localhost";
$dbUser = "root";
$dbPassword = "5896matilde";
$dbName = "churrasco";

$conexao = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conexao->connect_errno) {
    echo"erro";

} 
else {
    echo"conexão feita com sucesso";
}

?>