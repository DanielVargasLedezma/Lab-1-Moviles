<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Mail;

class TemporaryPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $correo;
    protected $nombre;
    protected $nombre_usuario;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cedula, $nombre, $correo, $password)
    {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->nombre_usuario = $cedula;
        $this->password = $password;
    }

    public static function sendMail($cedula, $nombre, $correo, $password)
    {
        Mail::to($correo)->send(new TemporaryPassword($cedula, $nombre, $correo, $password));
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //retorna la vista del correo con todas las variables que recibe desde el controlador de usuario
        return $this->view('tempmailpass')
            ->subject('Creación de cuenta en el Sistema de Matrícula Estudiantil')
            ->with(['getMail' => $this->correo, 'getName' => $this->nombre, 'getUser' => $this->nombre_usuario, 'getPass' => $this->password]);
    }
}
