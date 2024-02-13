<?php

class Auth
{
    // Definimos una constante para la variable de sesión. 
    public const SESSION_VAR = 'user_session';

    // Método para iniciar sesión. 
    public static function login($userId, $userData = [])
    {   
        $_SESSION[self::SESSION_VAR] = [
            'logged' => true,
            'token'  => self::generateToken(), // Generar un token seguro.
            'id'     => $userId,
            'ssid'   => session_id(),
            'user'   => $userData
        ];
        return true;
    }

    public static function getUserData()
    {
        if (self::validate()) {
            return $_SESSION[self::SESSION_VAR]['user'];
        }
        return null;
    }
    // Método para validar la sesión. 
    public static function validate()
    {
        if (!isset($_SESSION[self::SESSION_VAR])) {
            return false;
        }

        $session = $_SESSION[self::SESSION_VAR];
        return $session['logged'] === true 
               && $session['ssid'] === session_id() 
               && $session['token'] !== null;
    }

    // Método para cerrar sesión. Sólo eliminamos la variable de sesión relacionada con el usuario.
    public static function logout()
    {
        if (isset($_SESSION[self::SESSION_VAR])) {
            unset($_SESSION[self::SESSION_VAR]);
        }
        return true;
    }

    // Método privado para generar un token seguro.
    private static function generateToken()
    {
        return bin2hex(random_bytes(32));  // Token criptográficamente seguro.
    }
}
