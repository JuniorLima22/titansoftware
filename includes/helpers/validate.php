<?php

/** Define variavéis e define valores vazios */
$nomeErro = $corErro = $precoErro = '';
$nome = $cor = $preco = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /** Valida campo nome */
    if (empty($_POST['nome'])) {
        $nomeErro = "Campo nome deve ser preenchido.";
    }else{
        $nome = limpaVariavel($_POST['nome']);
        
        if (strlen($nome) < 3) {
            $nomeErro = "O nome deve ter pelo menos 3 caracteres.";
        }

        if (strlen($nome) > 40) {
            $nomeErro = "O nome não pode ter mais de 40 caracteres.";
        }
    }

    /** Valida campo cor */
    if (empty($_POST['cor'])) {
        $corErro = "Campo cor deve ser selecionado.";
    }else{
        $cor = limpaVariavel($_POST['cor']);
        
        if (!in_array($cor, ['amarelo','azul','vermelho'])) {
            $corErro = "A cor informada não existe.";
        }
    }

    /** Valida campo preco */
    if (empty($_POST['preco'])) {
        $precoErro = "Campo preço deve ser preenchido.";
    }else{
        $preco = limpaVariavel($_POST['preco']);

        $preco = str_replace(',', '.', $preco);

        if (!is_numeric($preco)) {
            $precoErro = "O campo preço deve ser númerico.";
        }
    }
}

/**
 * Limpa dados das variavéis
 *
 * @param string $data
 * @return string
 **/
function limpaVariavel($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}