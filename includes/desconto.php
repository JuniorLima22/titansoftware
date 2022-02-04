<?php
/**
 * Função responsavel por calcular desconto
 *
 * Produtos das cores AZUL ou VERMELHO, terão um desconto de 20%.
 * Produtos das cores AMARELO, terão um desconto de 10%.
 * Produtos de cor VERMELHO e com VALOR MAIOR que R$ 50.00. Será aplicado um desconto de 5%.
 * 
 * @param String $cor
 * @param Float $preco
 * @return Numeric
 **/
function desconto($cor, $preco)
{
    $resultado = [];

    if ($cor == 'vermelho' && $preco > 50) {
        $resultado['total'] = $preco - $preco / 100 * 5;
        $resultado['porcentagem'] = 5;

        return $resultado;
    }

    if ($cor == 'azul' OR $cor == 'vermelho') {
        $resultado['total'] = $preco - $preco / 100 * 20;
        $resultado['porcentagem'] = 20;

        return $resultado;
    }

    if ($cor == 'amarelo') {
        $resultado['total'] = $preco - $preco / 100 * 10;
        $resultado['porcentagem'] = 10;

        return $resultado;
    }
}
