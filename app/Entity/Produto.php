<?php
namespace App\Entity;

use App\Db\Database;

class Produto
{
    /** @var Int $idProd Identificador único de produto */
    public $idProd;

    /** @var String $nome Nome do produto */
    public $nome;

    /** @var String $cor Cor do produto */
    public $cor;

    /** @var Int $idPreco Identificador único de preço */
    public $idPreco;

    /** @var Float $preoc Preço do produto */
    public $preco;

    /**
     * Método responsável por cadastrar um novo produto no banco
     *
     * @return Boolean
     **/
    public function cadastrar()
    {
        $obProduto = new Database('produtos');
        $this->idProd = $obProduto->insert([
            'nome' => $this->nome,
            'cor' => $this->cor,
        ]);

        $obPreco = new Database('precos');
        $this->idPreco = $obPreco->insert([
            'prod_id' => $this->idProd,
            'preco' => $this->preco,
        ]);
        
        return true;
    }
}

