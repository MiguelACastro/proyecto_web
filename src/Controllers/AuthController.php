<?php

namespace App\Controllers;
use PDO;
class AuthController {
    function findUserByEmail($email) {
        $stmt = getpdo()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function attemptLogin($email, $password) {
        $user = $this->findUserByEmail($email);
        
        if (!$user || !password_verify($password, $user['password'])) {
            return viewWithoutLayout('auth/login', ['error' => 'Credenciales incorrectas']);
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        redirect('admin/products');
    }

    function logout() {
        session_start();
        $_SESSION=[];
        session_destroy();

        redirect('login');
    }

}
