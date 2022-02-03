<?php
session_start();

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Produto');

use App\Helpers\Session;
use App\Entity\Produto;
use App\Helpers\Validate;

$session = new Session();
$validate = new Validate();

/** Validação do ID */
if (!isset($_REQUEST['id']) OR !is_numeric($_REQUEST['id'])) {
    header('Location: index.php?status=serror');
    exit;
}

/** Consultar Produto */
$obProduto = Produto::getProduto($_REQUEST['id']);

/** Validação se Produto existe */
if (!$obProduto instanceof Produto) {
    header('Location: index.php?status=serror');
    exit;
}

if (isset($_POST['nome'],$_POST['preco'])) {

    $validate->validate([
        'nome' => ['max:40', 'min:3', 'required'],
        // 'cor' => ['exists:amarelo,azul,vermelho', 'required'],
        'preco' => ['numeric', 'required'],
    ]);

    $id_prod = $obProduto->id_prod;
    $id_preco = $obProduto->id_preco;
    $cor = $obProduto->cor;
    
    for ($i=0; $i < count($validate->fields); $i++) {

        if (array_keys($validate->fields[$i])[0] == 'nome') {
            $nome = $validate->fields[$i]['nome'];
        }

        // if (array_keys($validate->fields[$i])[0] == 'cor') {
        //     $cor = $validate->fields[$i]['cor'];
        // }

        if (array_keys($validate->fields[$i])[0] == 'preco') {
            $preco = $validate->fields[$i]['preco'];
        }
    }

    if (count($validate->errorsFields) == 0) {
        $obProduto = new Produto;
        $obProduto->id_prod = $id_prod;
        $obProduto->nome = $nome;
        $obProduto->cor = $cor;
        $obProduto->id_preco = $id_preco;
        $obProduto->preco = $preco;

        if ($obProduto->atualizar()) {
            $session->flash('message', 'Produto atualizado com sucesso.');
            $session->flash('type', 'success');

            header('Location: index.php'); exit;
        }

        $session->flash('message', 'Erro ao atualizar produto.');
    }
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';