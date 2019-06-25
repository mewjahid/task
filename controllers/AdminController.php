<?php

	include_once ROOT . '/models/Admin.php';
	include_once ROOT . '/models/User.php';
	include_once ROOT . '/models/Main.php';
	include_once ROOT . '/components/Pagination.php';

	class AdminController
	{
	    public function beforeAction()
        {
            if (!Admin::isAdmin())
            {
                die('Доступ запрещён');
            }
        }

		public function actionIndex ()
		{
            $this->beforeAction();

			$userId = User::checkLogged();
			$user = User::getUserById($userId);

			if (isset($_POST[ 'submit' ]))
			{
				if ($userId == null)
				{
					$name = 'Гость';
					$email = '---';
					$text = $_POST[ 'text' ];
					$errors = false;

					if (!Main::checkPost($text))
					{
						$errors[] = 'Поле не может быть пустым';
					}

					if ($errors == false)
					{
						Main::setPost($name, $email, $text);
						header('Location: /');
					}
				}
				else
				{

					$name = $user[ 'name' ];
					$email = $user[ 'email' ];
					$text = $_POST[ 'text' ];

					$errors = false;

					if (!Main::checkPost($text))
					{
						$errors[] = 'Поле не может быть пустым';
					}

					if ($errors == false)
					{
						Main::setPost($name, $email, $text);
						header('Location: /');
					}
				}
			}
			$taskList = Main::getTaskList();

			require_once( ROOT . '/views/admin.php' );

			return $taskList;
		}

		public function actionEdit ()
		{
		    $this->beforeAction();

			$userId = User::checkLogged();
			$user = User::getUserById($userId);

			$id = isset($_GET['id']) ? $_GET['id'] : null;

			if ($id === null)
            {
                http_response_code(404);
                exit();
            }

            $taskItem = Main::getTaskById($id);

			if (empty($taskItem))
            {
                http_response_code(404);
                exit();
            }

            require_once( ROOT . '/views/view.php' );

            if (isset($_POST['submit-admin']))
            {

                $status = isset($_POST['status']) ? 'on' : 'off' ;

                $text = $_POST[ 'text' ];

                $errors = false;

                if (!Main::checkPost($text))
                {
                    $errors[] = 'Поле "Текст задачи" не может быть пустым';

                }

                if ($errors == false)
                {
                    Admin::editTaskData($id, $text,$status);

                }

            }
		}

	}