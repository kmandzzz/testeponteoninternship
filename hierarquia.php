<?php

include_once('./bd/conexao.php');

$sqlHierarquia = "SELECT e.id_empr, e.pai_id_empr FROM empresarios.empresarios e;";
$sqlNomeEmpr = "SELECT e.id_empr, e.nom_empr FROM empresarios.empresarios e;";

$stmH = $pdo->query($sqlHierarquia);
$resultHerq = $stmH->fetchAll(PDO::FETCH_KEY_PAIR);

$stmN = $pdo->query($sqlNomeEmpr);
$resultNom = $stmN->fetchAll(PDO::FETCH_KEY_PAIR);

$cara_que_vem = (int) $_GET['id_empr'];

echo "<ul>";
echo "<li>{$resultNom[$cara_que_vem]}</li>";

echo "<ul>";
foreach ($resultHerq as $key => $val) {
    if ($cara_que_vem === (int) $val) {
        echo "<li>" . $resultNom[$key] . "</li>";
        buscaFilhos($resultHerq, $key, $resultNom);
    }
}
echo "</ul>";
echo "</ul>";

function buscaFilhos($resultHerq, $cara_que_vem, $resultNom)
{
    echo "<ul>";
    foreach ($resultHerq as $key => $val) {
        if ($cara_que_vem === (int) $val) {
            echo "<li>" . $resultNom[$key] . "</li>";
            buscaFilhos($resultHerq, $key, $resultNom);
        }
    }
    echo "</ul>";
}
