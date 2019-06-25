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
			
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$columnToSort = isset($_GET['columnToSort']) ? $_GET['columnToSort'] : null;
			$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : null;

			$userId = User::checkLogged();
			$user = User::getUserById($userId);

			$total = Main::getTotalTasks();

			$pagination = new Pagination($total, $page, Main::SHOW_BY_DEFAULT, [
				'columnToSort' => $columnToSort,
				'sortOrder' => $sortOrder,
			]);

			$taskList = Main::getPost($page, $columnToSort, $sortOrder);

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

		public function actionDelete()
		{
			$this->beforeAction();

			$id = isset($_GET['id']) ? $_GET['id'] : null;

			if ($id === null)
			{
				http_response_code(404);
				exit();
			}

			Admin::deleteTask($id);

			header("Location: /admin");

		}

	}