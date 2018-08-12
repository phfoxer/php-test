<?php
namespace exercicio7;
spl_autoload_register(function ($class) {
    require dirname(__FILE__) .DIRECTORY_SEPARATOR. $class . '.php';
});

use \Tools;

class Usuario {
    private $fileName = 'file.txt';

    public function list():Array {
        $tools      = new Tools;
        $userData   = $tools->request();
        $tools->setfilePath($this->fileName);
        return $tools->readFile();
    }

    public function create($userData):Array {
        $tools      = new Tools;
        $return     = [];
        $tools->setfilePath($this->fileName);
        if (count($tools->getByKey('email', $userData->email))) {
            $return  = [
                'done'      => false,
                'message'   => 'Esse E-mail já está em uso, escolha outro'
            ];
        } else {
            $fileData = $tools->readFile();
            $tools->createFile($fileData, (array) $userData);
             $return  = [
                'done'      => true,
                'message'   => 'Usuário cadastrado com sucesso!'
            ];
        }
        return $return;
    }

    public function update($userData):Array {
        $tools  = new Tools;
        $tools->setfilePath($this->fileName);

        if (count($tools->getByKey('email', $userData->email))) {
            $fileData = $tools->readFile();
            foreach ($fileData as $key => $data) {
                if ($data['email']===$userData->email) {
                   unset($fileData[$key]);
                }
            }
            $tools->clearFile();
            $tools->createFile($fileData,(array) $userData);
            $return  = [
                'done'      => true,
                'message'   => 'Informações alteradas com sucesso!'
            ];
        } else {
            $return  = [
                'done'      => true,
                'message'   => 'Usuário não encontrado'
            ];
        }
        return $return;
    }

    public function delete($email):Array {
        $tools  = new Tools;
        $tools->setfilePath($this->fileName);
        if (count($tools->getByKey('email', $email))) {
            $fileData = $tools->readFile();
            foreach ($fileData as $key => $data) {
                if ($data['email']===$email) {
                   unset($fileData[$key]);
                }
            }
            $tools->clearFile();
            $tools->createFile($fileData);
            $return  = [
                'done'      => true,
                'message'   => 'Usuário removido com sucesso'
            ];
        } else {
            $return  = [
                'done'      => true,
                'message'   => 'Usuário não encontrado'
            ];
        }
        return $return;
    }

}


$usuario    = new Usuario;
$tools      = new Tools;
$request    = $tools->request();
$method     = $_SERVER['REQUEST_METHOD'];
$result     = [];
$module     = $tools->segment(3);
$action     = $tools->segment(4);

// Headers
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// Endpoints methods
if ($module!=='users' || $action==='') {
    die(json_encode(['message' => 'Route not exists']));
}

if ($method==='GET' && $action === 'list') {
    $result = $usuario->list();
}

if ($method==='POST' && $action === 'create') {
    $result =  $usuario->create($request);
}

if ($method==='PUT' && $action === 'update') {
    $result =  $usuario->update($request);
}

if ($method=="DELETE") {
    $result =  $usuario->delete($request->email);
}

echo json_encode($result);
