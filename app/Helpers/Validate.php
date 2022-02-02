<?php

namespace App\Helpers;

class Validate
{
    /** @var String $errors Habilita retorno dos erros */
    static $errors = true;

    /** @var String $errorsFields Retorna campos e mensagens de erros */
    public $errorsFields = [];

    /** @var String $requestMethod Identifica verbo HTTP Request */
    protected $requestMethod;
    
    /** @var Array $fields Retorna dados dos campos do formulário */
    public $fields;

    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * Método para validar dados
     *
     * @param Array $fields
     * @return String
     **/
    public function validate($fields)
    {
        foreach ($fields as $field => $types) {
            $field = $this->clearVariable($field);
            
            foreach ($types as $type) {

                $type = explode(':', $type);
                $params = isset($type[1]) ? $type[1] : '';

                switch ($type[0]) {
                    case 'required':
                        $this->required($field);
                        break;
                    
                    case 'min':
                        $this->min($field, $params);
                        break;
                        
                    case 'max':
                        $this->max($field, $params);
                        break;

                    case 'exists':
                        $this->exists($field, $params);
                        break;
                }
                
            }
        }
    }

    /**
     * Método para validar dados requeridos
     *
     * @param String $field
     * @return String
     **/
    private function required($field)
    {
        if (empty($this->request()[$field])) {
            $this->throwError('Campo '.$field. ' deve ser preenchido.', 1, $field);
        }
        
        $this->fields[] = [$field => $this->request()[$field]];
    }

    /**
     * Método responsavel por verificar tamanho mínimo dos dados
     *
     * @param String $field
     * @param String $minimus
     * @return String
     **/
    private function min($field, $minimus)
    {
        $length = strlen($this->request()[$field]);
        if ($length < $minimus) {
            $this->throwError('O campo '. $field. ' deve ter pelo menos '. $minimus. ' caracteres.', 1, $field);
        }
    }

    /**
     * Método responsavel por verificar tamanho máximo dos dados
     *
     * @param String $field
     * @param String $maximum
     * @return String
     **/
    private function max($field, $maximum)
    {
        $length = strlen($this->request()[$field]);
        if ($length > $maximum) {
            $this->throwError('O campo '. $field. ' deve ter pelo menos '. $maximum. ' caracteres.', 1, $field);
        }
    }

    /**
     * Método responsavel por verificar existência dos dados em um determinado array
     *
     * @param String $field
     * @param String $params
     * @return String
     **/
    private function exists($field, $params)
    {
        $params = explode(',', $params);

        if (!in_array($this->request()[$field], $params)) {
            $this->throwError('Valor do campo '. $field .' informada não existe.', 1, $field);
        }
    }

    /**
     * Método verbo HTTP Request
     *
     * @return Array
     **/
    private function request()
    {
        if ($this->requestMethod == 'POST') return $_POST;

        return $_GET;
    }

    /**
     * Método responsavel por verificar error em um determindado campo especifico
     *
     * @param String $field
     * @param Array $data
     * @return String
     **/
    public function hasErro($field, $data)
    {
        $hasErro = false;
        foreach ($data as $fields) {
    
            foreach ($fields as $fieldName => $message) {
                if ($fieldName == $field) {
                    $hasErro = true;
                }
            }
        }

        return $hasErro;
    }

    /**
     * Método responsavel por retornar mensagem de erro do campo especifico
     *
     * @param String $field
     * @param Array $data
     * @return String
     **/
    public function errorMessage($field, $data)
    {
        $hasMessage = '';
        foreach ($data as $fields) {
            
            foreach ($fields as $fieldName => $message) {

                if ($fieldName == $field) {
                    $hasMessage = $message['messages'];
                }
            }
        }

        return $hasMessage;
    }

    /**
     * Método responsavewl por remover dados desnecessários das variavéis
     *
     * @param String $data
     * @return string
     **/
    private function clearVariable($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /**
     * Método para lançar erros
     *
     * @param String $error
     * @param String $errorCode
     * @return Exception
     **/
    private function throwError($error = 'Solicitação de processamento de erro', $errorCode = 0, $field)
    {
        if ($this::$errors === true) {
            try {
                throw new \Exception($error, $errorCode);
            } catch (\Exception $e) {
                return array_push($this->errorsFields, [
                    $field => ['messages' => $e->getMessage()],
                ]);
            }
        }
    }
}
