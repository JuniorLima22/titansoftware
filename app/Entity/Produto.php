<?php
namespace App\Entity;

use App\Db\Database;

use PDO;

class Produto
{
    /** @var Int $id_prod Identificador único de produto */
    public $id_prod;

    /** @var String $nome Nome do produto */
    public $nome;

    /** @var String $cor Cor do produto */
    public $cor;

    /** @var Int $id_preco Identificador único de preço */
    public $id_preco;

    /** @var Int $prod_id chave extrangeira de produto */
    public $prod_id;

    /** @var Float $preco Preço do produto */
    public $preco;

    /**
     * Método responsável por cadastrar um novo produto no banco
     *
     * @return Boolean
     **/
    public function cadastrar()
    {
        $obProduto = new Database('produtos');
        $this->id_prod = $obProduto->insert([
            'nome' => $this->nome,
            'cor' => $this->cor,
        ]);

        $obPreco = new Database('precos');
        $this->id_preco = $obPreco->insert([
            'prod_id' => $this->id_prod,
            'preco' => $this->preco,
        ]);
        
        return true;
    }

    /**
     * Método responsavel por atualizar produto no banco
     *
     * @return Boolean
     **/
    public function atualizar()
    {
        (new Database('produtos'))->update('id_prod = '. $this->id_prod, [
            'nome' => $this->nome,
            'cor' => $this->cor,
        ]);

        (new Database('precos'))->update('id_preco = '. $this->id_preco, [
            'preco' => $this->preco,
        ]);

        return true;
    }

    /**
     * Método responsavel por deletar produto no banco
     *
     * @return Boolean
     **/
    public function excluir()
    {
        (new Database('precos'))->delete('id_preco = '. $this->id_preco);

        (new Database('produtos'))->delete('id_prod = '. $this->id_prod);

        return true;
    }

    /**
     * Método responsavel por listar produtos do banco de dados
     *
     * @param String $join
     * @param String $where
     * @param String $order
     * @param String $limit
     * @return Array
     **/
    public static function getProdutos($join = null, $where = null, $order = null, $limit = null)
    {
        return (new Database('produtos'))->select($join, $where, $order, $limit)
                                         ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsavel por buscar um produto com base em seu ID
     *
     * @param Integer $id
     * @return Produto
     **/
    public static function getProduto($id)
    {
        return (new Database('produtos'))->select('LEFT JOIN precos ON precos.prod_id=produtos.id_prod', 'id_prod = '. $id)
                                         ->fetchObject(self::class);
    }
}

