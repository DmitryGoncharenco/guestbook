<?php

namespace app\controllers;

use app\core\Controller;

class MessageController extends Controller
{
    /**
     * Подключаем шаблон страницы сообщений
     */
    
    public function showAction()
    {
		if (!empty($_POST)) {
			if (!$this->model->validate(['content'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
            $this->model->getMessage($_POST);
			$this->view->message('success', 'Сообщение отправлено');
        }
    $this->view->render('Сообщения');
	}
}

?>
