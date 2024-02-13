<?php

class Flash
{
    private $valid_type = ['primary', 'secundary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    private $default = 'primary';
    private $type;
    private $msj;

    /**
     * Metodo para guardar notificación flash
     * 
     * @param string array $msj
     * @param string type
     * @return void
     * 
     */
    public static function new($msj, $type = null):bool
    {

        $self = new self();

        //setear tipo de notificacion por defecto 
        if ($type === null) {
            $self->type = $self->default;
        }


        $self->type = in_array($type, $self->valid_type) ? $type : $self->default;


        //guardar la notificacion 
        if (is_array($msj)) {
            foreach ($msj as $m) {
                $_SESSION[$self->type][] = $m;
            }
            return true;
        }

        $_SESSION[$self->type][] = $msj;

        return true;
    }

    /**
     * Renderisa las notificaciones  a nuestro usuario
     * 
     * @return void
     * 
     */
    public static function flash():string
    {
        $self = new self();
        $output = '';

        foreach ($self->valid_type as $type) {
            if (isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
                foreach ($_SESSION[$type] as $m) {
                    $output .= '<div class="alert alert-' . $type . '  alert-dismissible show fade" role="alert">';
                    $output .= $m;
                    $output .= ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    $output .= '</div>';
                }

                unset($_SESSION[$type]);

            }
        }
        return $output;
    }
    
}