<?php

	include_once ROOT . '/models/Main.php';
	include_once ROOT . '/models/User.php';
	include_once ROOT . '/components/Pagination.php';

	class MainController
	{
		public function actionIndex()
		{
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $columnToSort = isset($_GET['columnToSort']) ? $_GET['columnToSort'] : null;
            $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : null;

			$userId = User::checkLogged();
			$user = User::getUserById($userId);

			if (isset($_POST[ 'submit' ]))
			{
				if ($userId == null)
				{
					$name = 'Гость';
					$email = $_POST['email'];
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

            $total = Main::getTotalTasks();

            $pagination = new Pagination($total, $page, Main::SHOW_BY_DEFAULT, [
                'columnToSort' => $columnToSort,
                'sortOrder' => $sortOrder,
            ]);

            $taskList = Main::getPost($page, $columnToSort, $sortOrder);

			require_once( ROOT . '/views/main.php' );
			return $taskList;

		}
	}