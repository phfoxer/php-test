<?php
namespace exercicio4;
spl_autoload_register(function ($class) {
    require dirname(__FILE__) .DIRECTORY_SEPARATOR. $class . '.php';
});

use \Tools;

class Usuario {
    private $encryptKey = 'dKY_6wuvC@sEoq79h!V7pT0XUJ20wOuCOgS';
    private $fileName = 'file.txt';
    public function create():String{
        $tools      = new Tools;
        $userData   = $tools->request();
        $fileData   = $tools->readFile($this->fileName);
        if ($this->uniqueFields('login',$userData->login)) {
            return 'Esse login já está em uso, escolha outro';
        } elseif ($this->uniqueFields('email',$userData->email)) {
            return 'Esse E-mail já está em uso, escolha outro';
        } else {
            $userData->senha = sha1($this->encryptKey.$userData->senha);
            $tools->createFile($this->fileName,$fileData,json_encode($userData));
            return 'done';
        }
    }

    public function uniqueFields($key,$value):Bool {
        $tools = new Tools;
        $fileData = $tools->readFile($this->fileName);
        foreach ($fileData as $json) {
            $data = json_decode($json,1);
            if ($data[$key]==$value) {
                return true;
            }
        }
        return false;
    }

}

$usuario = new Usuario;
header('Content-Type: text/html; charset=utf-8');
print $usuario->create();