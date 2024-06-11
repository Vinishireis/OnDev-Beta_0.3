<?php

class Usuario {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function createQR($id) {
        // Implementar a lógica para gerar o token QR
        // Por exemplo, usar o ID do usuário para criar um token único
        $token = "user-" . $id . "-" . uniqid();
        return $token;
    }
}
?>
