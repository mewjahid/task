<?php

	include_once ROOT . '/models/User.php';

	class UserController
	{
		public function actionRegister ()
		{

			$name = '';
			$email = '';
			$password = '';

			$result = false;

			if (isset($_POST[ 'submit' ]))
			{

				$name = $_POST[ 'name' ];
				$email = $_POST[ 'email' ];
				$password = $_POST[ 'password' ];

				$errors = false;

				if (!User::checkName($name))
				{
					$errors[] = 'Имя должно быть не короче 2-х символов';
				}

				if (!User::checkPassword($password))
				{
					$errors[] = 'Пароль должен быть не короче 6-х символов';
				}

				if (!User::checkEmail($email))
				{
					$errors[] = 'Введите email';
				}

				if (User::checkEmailExist($email))
				{
					$errors[] = 'Такой почтовый ящик уже зарегистрирован';
				}
				if (User::checkNameExist($name))
				{
					$errors[] = 'Пользователь с таким логином уже существует';
				}

				if ($errors == false)
				{

					$result = User::register($name, $email, $password);
					$userId = User::checkUserData($email, $password);
//					User::auth($userId);
					header("Location: /user/login");

				}
			}

			require_once( ROOT . '/views/user/register.php' );

			return true;
		}

		public function actionLogin ()
		{
			$email = '';
			$password = '';

			$result = false;

			if (isset($_POST[ 'submit' ]))
			{
				$name = $_POST[ 'name' ];
				$password = $_POST[ 'password' ];

				$errors = false;

				if (!User::checkName($name))
				{
					$errors[] = 'Введите логин';
				}

				if (!User::checkPassword($password))
				{
					$errors[] = 'Пароль должен быть не короче 6-х символов';
				}

				$userId = User::checkUserData($name, $password);

				if ($userId == false)
				{
					$errors[] = 'Неверные логин или пароль';
				}
				else
				{
					User::auth($userId);
					header("Location: /");
				}
			}

			require_once( ROOT . '/views/user/login.php' );

			return true;
		}

		public function actionLogout ()
		{
			session_destroy();
			header("Location: /");
		}

	}