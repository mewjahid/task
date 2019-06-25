<?php


	include_once ROOT . '/components/Db.php';

class Admin
{

	const COLUMNS = [
		'id' => '№',
		'name' => 'Имя пользователя',
		'email' => 'Email',
		'text' => 'Текст задачи',
		'status' => 'Выполнено',
		'edit' => 'Изменить',
		'delete' => 'Удалить'

	];

	const COLUMNS_TO_SORT = ['name', 'email', 'text', 'status', 'edit', 'delete'];
	
	public static function isAdmin()
	{
		$userId = User::checkLogged();
		$user = User::getUserById($userId);

		if ($user['role'] == 'admin')
		{
			return true;
		}

		return false;
	}

	public static function editTaskData($id, $text, $status)
	{
		$db = Db::getConnection();


		$sql = 'UPDATE task SET text =  :text, status = :status WHERE task.id = :id';
		$result = $db->prepare($sql);

		$result->bindParam(':text', $text, PDO::PARAM_STR);
		$result->bindParam(':status', $status, PDO::PARAM_STR);
		$result->bindParam(':id', $id, PDO::PARAM_INT);

		$result->execute();

	}

	public static function deleteTask($id)
	{
		$db = Db::getConnection();

		$sql = 'DELETE FROM task WHERE task.id = :id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);

		$result->execute();

	}


}