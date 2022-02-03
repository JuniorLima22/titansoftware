<?php
session_start();

require __DIR__.'/vendor/autoload.php';

use App\Helpers\Session;
use App\Entity\Produto;
use App\Helpers\Validate;

$session = new Session();
$validate = new Validate();

/** Validação do ID */
if (!isset($_POST['id']) OR !is_numeric($_POST['id'])) {
    header('Location: index.php?status=error');
    exit;
}

/** Consultar Produto */
$obProduto = Produto::getProduto($_POST['id']);

/** Validação se Produto existe */
if (!$obProduto instanceof Produto) {
    header('Location: index.php?status=error');
    exit;
}

if (isset($_POST['excluir'])) {

    if ($obProduto->excluir()) {
        $session->flash('message', 'Produto excluido com sucesso.');
        $session->flash('type', 'success');

        header('Location: index.php'); exit;
    }

    $session->flash('message', 'Erro ao excluir produto.');

    header('Location: index.php'); exit;
}
