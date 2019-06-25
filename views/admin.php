<?php  include_once ROOT.'/views/layouts/header.php'; ?>

<?php if ($_SERVER['REQUEST_URI'] == '/admin'): ?>

<div class="container">
	<h1>Панель администратора</h1>

	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">Таблица заданий</div>

		<!-- Table -->
		<table class="table table-bordered">

			<tr>
				<th>№</th>
				<th>Имя пользователя</th>
				<th>email</th>
				<th>Текст задачи</th>
				<th>Выполнено</th>
				<th>Изменить</th>

			</tr>
			<?php foreach ($taskList as $task): ?>
				<tr>
					<td class="col-xs-1"><?php echo $task['id'] ?></td>
					<td class="col-xs-1""><?php echo $task['name'] ?></td>
					<td class="col-xs-1""><?php echo $task['email'] ?></td>
					<td class="col-xs-3"><?php echo $task['text'] ?>
					<td class="col-xs-1">
						<?php if ($task['status'] == 'on'): ?>
						<span class="glyphicon glyphicon-ok"></span>
					<?php else : ?>
						<span class="glyphicon glyphicon-remove"></span>
					<?php endif; ?>
					</td>
					<td class="col-xs-1"> <a href="admin/edit?id=<?php echo $task['id'] ?>"><span class="glyphicon glyphicon-pencil"></a></span></td>

				</tr>
			<?php endforeach ?>
		</table>
	</div>



</div>
<?php endif; ?>
<?php  include_once ROOT.'/views/layouts/footer.php'; ?>
