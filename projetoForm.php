<?php

include_once('./bd/conexao.php');

$sql = sprintf("SELECT e.id_empr, e.nom_empr, e.cel_empr, e.est_cid_empr, e.pai_id_empr, emp.nom_empr AS nom_empr_pai, e.data_cad_empr
                FROM empresarios.empresarios e 
                LEFT JOIN empresarios.empresarios emp on emp.id_empr = e.pai_id_empr
                ORDER BY e.data_cad_empr DESC");

$stm = $pdo->query($sql);
$result = $stm->fetchAll();

$msgValidacao = !isset($_GET['campo']) ? '' : $_GET['campo'];

?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresários</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>
    <h1>Cadastro de Empresários</h1>
    <h1 style="background: orange;"><?= $msgValidacao ?></h1>

    <form id="form_empresarios" action="controller.php" method="POST">
        <label for="nome">Nome Completo:</label>
        <input text="text" id="nomeid" name="nomeid" placeholder="Digite seu nome completo" required="required" name="nome" /><br>
        <br>
        <label for="tel">Celular:</label>
        <input text="text" id="telid" name="telid" placeholder="Digite seu número" name="celular" required="required" maxlength="11" /><br>
        <br>
        <label for="endereco">Cidade e Estado: </label>
        <select id="cidade-uf" name="cidade-uf">
            <option value="Rio Branco / AC">Rio Branco / Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
        </select>
        <br>
        <br>
        <label for="pai-empresa">Pai Empresarial: </label>
        <select id="pai-empresa" name="pai-empresa">
            <option value="">Sem Pai</option>
            <?php
            foreach ($result as $key => $r) {
                echo "<option value='{$r['id_empr']}'>{$r['nom_empr']}</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <input type="submit" class="enviar" value="ENVIAR">
    </form>

    </br>

    <table border="1">
        <thead>
            <tr>
                <th>Nome Completo</th>
                <th>Celular</th>
                <th>Cidade/UF</th>
                <th>Cadastrado em</th>
                <th>Pai Empresarial</th>
                <th>Rede</th>
                <th> - </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $key => $r) {
                $date = date_create($r['data_cad_empr']);
                $data_cad = date_format($date, 'd/m/Y H:i');

                $tel = $r['cel_empr'];

                $pattern = '/(\d{2})(\d{5})(\d{4})/i';
                $replacement = '(${1}) $2-$3';
                $tel_format = preg_replace($pattern, $replacement, $tel);

                $linkHerq = sprintf("<a href='hierarquia.php?id_empr=%s'>[VER REDE]</a>", $r['id_empr']);
                $linkExcl = sprintf("<a href='controller.php?id_empr=%s' onclick='excluir(event)'>[EXCLUIR]</a>", $r['id_empr']);

                echo "<tr>";
                echo "<td>{$r['nom_empr']}</td>
                        <td>{$tel_format}</td>
                        <td>{$r['est_cid_empr']}</td>
                        <td>{$data_cad}</td>
                        <td>{$r['nom_empr_pai']}</td>
                        <td>$linkHerq</td>
                        <td>$linkExcl</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <!--- JQUERY -->
    <script>
        $(document).ready(function() {
            $('#cidade-uf').select2();
        });
    </script>

<script>
    function excluir(event)
    {
        var r = confirm("Tem certeza que deseja excluir o registro?");
        if (r == false){
            event.preventDefault();
        }
    }
</script>

</body>

</html>