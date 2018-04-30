<?php

namespace app\models;

use app\core\Model;

class Account extends Model
{
    public function validate($input, $post)
    {
		$rules = [
			'email' => [
				'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
				'message' => 'E-mail адрес указан неверно',
			],
			'login' => [
				'pattern' => '#^[a-z0-9]{3,15}$#',
				'message' => 'Логин указан неверно (разрешены только латинские буквы и цифры от 3 до 15 символов',
			],
			'password' => [
				'pattern' => '#^[a-z0-9]{4,20}$#',
				'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 10 до 30 символов',

			],
		];
		foreach ($input as $val) {
			if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->error = $rules[$val]['message'];
				return false;
			}
        }
        return true;
    }
    
    public function emailExists($email)
    {
		$params = [
			'email' => $email,
		];
		return $this->db->column('SELECT id FROM accounts WHERE email = :email', $params);
	}

	public function loginExists($login)
    {
		$params = [
			'login' => $login,
		];
		if ($this->db->column('SELECT id FROM accounts WHERE login = :login', $params)) {
			$this->error = 'Этот логин уже используется';
			return false;
		}
		return true;
	}
    
    public function register($post)
    {
		$params = [
			'id' => '',
			'email' => $post['email'],
			'login' => $post['login'],
			'password' => password_hash($post['password'], PASSWORD_BCRYPT),
		];
		$this->db->query('INSERT INTO accounts VALUES (:id, :email, :login, :password)', $params);
        //$this->view->redirect('account/login');
    }
    
    public function checkData($login, $password)
    {
		$params = [
			'login' => $login,
		];
		$hash = $this->db->column('SELECT password FROM accounts WHERE login = :login', $params);
		if (!$hash or !password_verify($password, $hash)) {
			return false;
		}
		return true;
	}

	public function login($login)
    {
		$params = [
			'login' => $login,
		];
		$data = $this->db->row('SELECT * FROM accounts WHERE login = :login', $params);
		$_SESSION['account'] = $data[0];
	}
    
} 

?>
