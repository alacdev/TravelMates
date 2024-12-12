<<?php
use PHPUnit\Framework\TestCase;

class InicioTest extends TestCase {
    public function testLogin() {
        $inicioController = new Com\TravelMates\Controllers\InicioController();
        $usuarioModel = new Com\TravelMates\Models\UsuarioModel();
        $hashPass = password_hash("TestTest1", PASSWORD_DEFAULT);
        $usuario = [
            'nombre_completo' => 'Prueba Test',
            'username'        => 'Test',
            'sexo'            => 'NA',
            'pass'            => $hashPass,
            'residencia'      => 'Vigo',
            'email'           => 'test@email.com'
        ];
        $usuarioModel->addUser($usuario);
        $login['username'] = 'Test';
        $login['pass'] = 'Testtest1';
        $this->assertTrue($inicioController->iniciarSesionTest($login));
    }

    public function testRegistro() {
        $inicioController = new Com\TravelMates\Controllers\InicioController();
        $registro = [
            'nombre_completo' => 'Prueba Test',
            'username'        => 'Test',
            'sexo'            => 'NA',
            'pass'            => 'Testtest1',
            'confirm_pass'    => 'Testtest1',
            'residencia'      => 'Vigo',
            'email'           => 'test@email.com'
        ];
        $this->assertTrue($inicioController->registrarTest($registro));
    }

}

?>