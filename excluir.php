<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Produto;
use App\Helpers\Validate;

$validate = new Validate();

/** Validação do ID */
if (!isset($_POST['id']) OR !is_numeric($_POST['id'])) {
    header('Location: index.php?status=error');
    exit;
}

/** Consultar Produto */
$obProduto = Produto::getProduto($_POST['id']);

var_dump($obProduto);
echo '<br>';

/** Validação se Produto existe */
if (!$obProduto instanceof Produto) {
    header('Location: index.php?status=error');
    exit;
}

if (isset($_POST['excluir'])) {

    $obProduto->excluir();

    header('Location: index.php?status=success');
    exit;
}