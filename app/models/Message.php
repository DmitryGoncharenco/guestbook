<?php

namespace app\models;

use app\core\Model;

class Message extends Model
{
    
    public function validate($input, $post)
    {
		$rules = [
			'content' => [
				'pattern' => '#^[А-яA-z0-9.\s]#',
			],
		];
		foreach ($input as $val) {
			if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->error = 'Невозможно отправить сообщение.';
				return false;
			}
        }
        return true;
    }
    
    public function getMessage($post)
    {
		$params = [
			'id' => '',
            'account_id' => $_SESSION['account']['id'],
            'message' => $post['content'],
		];
		$this->db->query('INSERT INTO content VALUES (:id, :message, :account_id)', $params);
    }
} 

?>
