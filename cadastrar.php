<?php
session_start();

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Cadastrar Produto');

use App\Helpers\Session;
use App\Entity\Produto;
use App\Helpers\Validate;

$session = new Session();
$validate = new Validate();

if (isset($_POST['nome'],$_POST['cor'],$_POST['preco'])) {

    $validate->validate([
        'nome' => ['max:40', 'min:3', 'required'],
        'cor' => ['exists:amarelo,azul,vermelho', 'required'],
        'preco' => ['numeric', 'required'],
    ]);
    
    for ($i=0; $i < count($validate->fields); $i++) {

        if (array_keys($validate->fields[$i])[0] == 'nome') {
            $nome = $validate->fields[$i]['nome'];
        }

        if (array_keys($validate->fields[$i])[0] == 'cor') {
            $cor = $validate->fields[$i]['cor'];
        }

        if (array_keys($validate->fields[$i])[0] == 'preco') {
            $preco = $validate->fields[$i]['preco'];
        }
    }

    if (count($validate->errorsFields) == 0) {
        $obProduto = new Produto;
        $obProduto->nome = $nome;
        $obProduto->cor = $cor;
        $obProduto->preco = $preco;
        
        if ($obProduto->cadastrar()) {
            $session->flash('message', 'Produto cadastrado com sucesso.');
            $session->flash('type', 'success');

            header('Location: index.php'); exit;
        }

        $session->flash('message', 'Erro ao cadastrar produto.');
    }
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';