<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
    /** @var String Host de conexão com o banco de dados */
    const HOST = 'localhost';

    /** @var String Nome do banco de dados */
    const NAME = 'titansoftware';

    /** @var String Usuário do banco de dados */
    const USER = 'root';

    /** @var String Senha de acesso ao banco e dados */
    const PASS = '';

    /** @var String Nome da tabela a ser manipulada */
    private $table;

    /** @var PDO Instancia de conexão com o banco de dados */
    private $connection;

    /**
     * Define a tabela e instancia de conexão
     *
     * @param String $table
     **/
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsavel por criar uma conexão com o banco de dados
     *
     **/
    public function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME.';charset=utf8mb4', self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error Connect: '. $e->getMessage());
        }
    }

    /**
     * Método responsavel por executar queries dentro do banco de dados
     *
     * @param String $query
     * @param Array $params
     * @return PDOStatement
     **/
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('Error Execute: '. $e->getMessage());
        }
    }

    /**
     * Método responsavelpor inserir dados no banco de dados
     *
     * @param Array $values [field => value]
     * @return Integer ID inserido
     **/
    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        
        $query = 'INSERT INTO '. $this->table. ' ('. implode(',', $fields) .') VALUES ('. implode(',', $binds) .')';

        $this->execute($query, array_values($values));
        
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsavel por atualizar dados no banco de dados
     *
     * @param String $where
     * @param Array $values [field => value]
     * @return Boolean
     **/
    public function update($where, $values)
    {
        $fields = array_keys($values);
        
        $query = 'UPDATE '. $this->table .' SET '. implode('=?,', $fields) .'=? WHERE '. $where;
        
        $this->execute($query, array_values($values));

        return true;
    }

    /**
     * Método responsavel por executar uma consulta no banco de dados
     *
     * @param String $join
     * @param String $where
     * @param String $order
     * @param String $limit
     * @param String $fields
     * @return PDOStatement
     **/
    public function select($join = null, $where = null, $order = null, $limit = null, $fields = '*')
    {
        $join = strlen($join) ? $join : '';
        $where = strlen($where) ? 'WHERE '. $where : '';
        $order = strlen($order) ? 'ORDER BY '. $order : '';
        $limit = strlen($limit) ? 'LIMIT '. $limit : '';

        $query = 'SELECT '. $fields. ' FROM '. $this->table. ' '. $join. ' '. $where. ' '. $order. ' '. $limit;

        return $this->execute($query);
    }
}
