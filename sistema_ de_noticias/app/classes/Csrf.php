<?php

class Csrf
{
    private $length = 32; // logintitud de nuestro token
    private $token; //token
    private $token_expiration;//tiempo de expiracion
    private $expiration_time= 60 * 5;// 5 minutos de expiracion 

    
    //crear nuestro token si no existe y es nuestro primer inicio al sitio 
    public function __construct()
    {
      if(!isset($_SESSION['csrf_token'])){
        $this->generate();
        $_SESSION['csrf_token']=[
               'token'=>$this->token,
               'expiration'=>$this->token_expiration
        ];
        //return $this;
      }
      $this->token = $_SESSION['csrf_token']['token'];
      $this->token_expiration = $_SESSION['csrf_token']['expiration'];

      //return $this;
    }

    /**
     * Metodo para generar un nuevo token 
     * 
     * @return  mixed
     */

    private function generate()
    {
        if(function_exists('bin2hex')){
            $this->token=bin2hex(random_bytes($this->length));
        }else{
            $this->token=bin2hex(openssl_random_pseudo_bytes($this->length));
        }

        $this->token_expiration=time()+$this->expiration_time;
        return $this;
    }


     /**
     * Validar el token de la peticion con el del sistema 
     * 
     * @param string $scrf_token
     * @param boolean $validate_expiration
     * @return  mixed
     */

     public static function validar($csrf_token,$validate_expiration=false)
     {

        
         $self = new self();
        // var_dump("Token en función:", $csrf_token);
        var_dump("Token en clase:", $self->get_token());
       // var_dump("Expiración:", $self->get_expiration());
        //var_dump("Tiempo actual:", time());
        
         
         if($validate_expiration && $self->get_expiration() < time()){
              return false;
         }

         if($csrf_token !== $self->get_token()){
              return false;
         }

         return true;
     }


     /**
     * Metodo para optener el token
     *
     * @return  mixed
     */

     public  function get_token()
     {
        return $this->token;
     }

     /**
     * Metodo para optener el token
     *
     * @return  mixed
     */

     public  function get_expiration()
     {
        return $this->token_expiration;
     }


}