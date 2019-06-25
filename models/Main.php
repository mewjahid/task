<?php

	include_once ROOT . '/components/Db.php';

	class Main
	{
		const SHOW_BY_DEFAULT = 3;

		const COLUMNS = [
		    'id' => '№',
            'name' => 'Имя пользователя',
            'email' => 'Email',
            'text' => 'Текст задачи',
            'status' => 'Выполнено',
        ];

		const COLUMNS_TO_SORT = ['name', 'email', 'text', 'status'];

		
		public static function getTaskList ()
		{

			Db::getConnection();

			$taskList = [];

			$result = Db::getConnection()->query('SELECT * FROM `task` ');

			$i = 0;
			while ($row = $result->fetch())
			{
				$taskList[ $i ][ 'id' ] = $row[ 'id' ];
				$taskList[ $i ][ 'name' ] = $row[ 'name' ];
				$taskList[ $i ][ 'email' ] = $row[ 'email' ];
				$taskList[ $i ][ 'text' ] = $row[ 'text' ];
				$taskList[ $i ][ 'status' ] = $row[ 'status' ];

				$i++;
			};

			return $taskList;
		}

		public static function getTaskById ($id)
		{
			$id = intval($id);

			Db::getConnection();
			$result = Db::getConnection()->query('SELECT * FROM `task` WHERE id=' . $id);

			$taskItem = $result->fetch();

			return $taskItem;
		}

		public static function setPost ($name, $email, $text)
		{

			$db = Db::getConnection();
			$sql = "INSERT INTO task  (name, email, text) VALUES (:name, :email, :text)";
			$result = $db->prepare($sql);
			$result->bindParam(':name', $name, PDO::PARAM_STR);
			$result->bindParam(':email', $email, PDO::PARAM_STR);
			$result->bindParam(':text', $text, PDO::PARAM_STR);

			$result->execute();
		}

		public static function checkPost ($text)
		{
			if (strlen($text) > 0)
			{
				return true;
			}

			return false;
		}

		public static function getPost ($page = 1, $columnToSort = null, $sortOrder = null)
		{
			$page = intval($page);
			$offset = ( $page - 1 ) * self::SHOW_BY_DEFAULT;

			$orderBy = '';
            if ($columnToSort !== null)
            {
                if (in_array($columnToSort, self::COLUMNS_TO_SORT, true))
                {
                    $orderBy = 'ORDER BY ' . $columnToSort;

                    if ($sortOrder != null && in_array($sortOrder, ['asc', 'desc']))
                    {
                        $orderBy .= ' '  . strtoupper($sortOrder);
                    }
                }
            }

			$db = Db::getConnection();
			$result = $db->query("SELECT * FROM task " . $orderBy . " LIMIT "
				. self::SHOW_BY_DEFAULT . " OFFSET " . $offset);

			$tasks = array ();
			$i = 0;
			while ($row = $result->fetch())
			{
				$tasks[ $i ][ 'id' ] = $row[ 'id' ];
				$tasks[ $i ][ 'name' ] = $row[ 'name' ];
				$tasks[ $i ][ 'email' ] = $row[ 'email' ];
				$tasks[ $i ][ 'text' ] = $row[ 'text' ];
				$tasks[ $i ][ 'status' ] = $row[ 'status' ];
				$i++;
			}

			return $tasks;
		}

		public static function getTotalTasks()
		{
			$db = Db::getConnection();

			$result = $db->query("SELECT count(id) FROM task AS count where id > 0");
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$row = $result->fetch();
			return $row['count(id)'];
		}

		public static function getAjax($column_name= 'id', $order = 'desc')
		{
			$db = Db::getConnection();
			$taskList = [];
			$result = $db->query("SELECT * FROM task ORDER BY $column_name $order ");
//			$result = $db->query("SELECT * FROM `task` ");

			$i = 0;
			while ($row = $result->fetch())
			{
				$taskList[ $i ][ 'id' ] = $row[ 'id' ];
				$taskList[ $i ][ 'name' ] = $row[ 'name' ];
				$taskList[ $i ][ 'email' ] = $row[ 'email' ];
				$taskList[ $i ][ 'text' ] = $row[ 'text' ];
				$taskList[ $i ][ 'status' ] = $row[ 'status' ];

				$i++;
			};


			return $taskList ;

		}



	}