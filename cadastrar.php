<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Produto;

if (isset($_POST['nome'],$_POST['cor'],$_POST['preco'])) {
    include __DIR__.'/includes/helpers/validate.php';

    $obProduto = new Produto;
    $obProduto->nome = $nome;
    $obProduto->cor = $cor;
    $obProduto->preco = $preco;
    $obProduto->cadastrar();
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';