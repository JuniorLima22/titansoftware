<?php

namespace App\Helpers;

Class Session 
{    
    /**
     * Método responsavel por criar flash message
     *
     * @param String $key
     * @param String $message
     * @return String
     **/
    public function flash($key, $message)
    {
        if (!isset($_SESSION['flash'][$key])) {
            $_SESSION['flash'][$key] = $message;
        }
    }

    /**
     * Método responsavel por resgatar flash message
     *
     * @param String $key
     * @return String
     **/
    public function get($key)
    {
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];

            unset($_SESSION['flash'][$key]);

            return $message ?? '';
        }
    }

    /**
     * Método responsavel por verificar se existe flash message
     *
     * @param String $key
     * @return Boolean
     **/
    public function has($key)
    {
        if (isset($_SESSION['flash'][$key])) {
            return true;
        }
        return false;
    }
}