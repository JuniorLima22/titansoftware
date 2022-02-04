<?php
session_start();

require __DIR__.'/vendor/autoload.php';

use App\Helpers\Session;
use App\Entity\Produto;

$session = new Session();

/** Parâmetros da URL */
$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRING);

$cor = filter_input(INPUT_GET, 'cor', FILTER_SANITIZE_STRING);
$cor = in_array($cor, ['amarelo','azul','vermelho']) ? $cor : '';

$preco = filter_input(INPUT_GET, 'preco', FILTER_SANITIZE_STRING);

$sinal = filter_input(INPUT_GET, 'sinal', FILTER_UNSAFE_RAW);
$sinal = in_array($sinal, ['=','>','<']) ? $sinal : '=';
$sinal = empty($preco) ? '' : $sinal;

/** Condições SQL */
$condicoes = [
    strlen($nome) ? 'nome LIKE "%'. str_replace(' ','%', $nome). '%"' : null,
    strlen($cor) ? 'cor = "'. $cor. '"' : null,
    strlen($preco) ? 'preco '. $sinal .' "'. $preco. '"' : null,
];

$condicoes = array_filter($condicoes);

/** Cláusula WHERE */
$where = implode(' AND ', $condicoes);

/** Cláusula JOIN */
$join = 'LEFT JOIN precos ON precos.prod_id=produtos.id_prod';

$produtos = Produto::getProdutos($join, $where);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';