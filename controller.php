<?php
    include_once('./bd/conexao.php');

    if (isset($_GET['id_empr']) && (int) $_GET['id_empr'] > 0) {
        $id_empr = $_GET['id_empr'];
        $sql = sprintf("DELETE FROM empresarios.empresarios WHERE id_empr = %d", (int) $id_empr);

        $pdo->exec($sql);
        header("Location: projetoForm.php");
        die();
    }

    validaCampos($_POST);
    validaTelefone($_POST['telid'], $pdo);

    $nom_empr       = $_POST['nomeid'];
    $cel_empr       = $_POST['telid'];
    $est_cid_empr   = $_POST['cidade-uf'];
    $pai_id_empr    = !empty($_POST['pai-empresa']) ? $_POST['pai-empresa'] : "NULL";

    $sql = sprintf("INSERT INTO empresarios.empresarios 
                    (nom_empr, cel_empr, est_cid_empr, pai_id_empr, data_cad_empr) 
                    VALUES ('%s', '%s', '%s', %s, '%s')", 
                    $nom_empr, $cel_empr, $est_cid_empr, $pai_id_empr, date('Y-d-m H:i:s'));

    $pdo->exec($sql);

    header("Location: projetoForm.php");
    die();

    function validaCampos($post)
    {
        $campos = [
                'nomeid'    => 'Nome Completo',
                'telid'     => 'Celular',
                'cidade-uf' => 'Cidade e Estado',
        ];

        foreach($campos as $key => $value) {
            if (empty($post[$key])) {
                $msg = sprintf('O campo %s é obrigatório.', $value);
                header(sprintf("Location: projetoForm.php?campo=%s", $msg));
                die();
            }
        }
    }

    function validaTelefone($telefone, $pdo)
    {
        $sql = sprintf("SELECT COUNT(id_empr) qtd FROM empresarios.empresarios WHERE cel_empr = '%s'", trim($telefone));

        $stm = $pdo->query($sql);
        $result = $stm->fetchColumn(); 

        if ((int) $result > 0) {
            $msg = sprintf('Já existe uma pessoa cadastrada com esse Celular.');
            header(sprintf("Location: projetoForm.php?campo=%s", $msg));
            die();
        }
    }
