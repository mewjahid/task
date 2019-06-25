<?php include_once ROOT . '/views/layouts/header.php'; ?>
<div class="container">
	<h1>Просмотр отдельной записи</h1>

	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">Таблица заданий</div>

		<!-- Table -->
		<form class="form-signin" action="#" method="post">

			<table class="table table-bordered">

				<tr>
					<th>№</th>
					<th>Имя пользователя</th>
					<th>email</th>
					<th>Текст задачи</th>
					<th>Выполнено</th>

				</tr>
				<tr>

					<td class="col-xs-1">
						<?php echo $taskItem[ 'id' ] ?>
					</td>

					<td class="col-xs-1"">
					<?php echo $taskItem[ 'name' ] ?>
					</td>

					<td class="col-xs-2"">
					<?php echo $taskItem[ 'email' ] ?>
					</td>

					<td class="col-xs-4">
						<textarea type="text" name="text" rows="15" class="form-control"  required><?php echo $taskItem[ 'text' ] ?> </textarea>
					</td>


					<td class="col-xs-1">

						<?php if ($taskItem[ 'status' ] == 'on'):  ?>
						<input type="checkbox" name="status" checked  class="form-control" ">
						<?php elseif($taskItem[ 'status' ] == 'off'): ?>
						<input type="checkbox" name="status" class="form-control" " >
						<?php endif; ?>

					</td>


				</tr>

				<br>

			</table>

	</div>
	<input class="btn btn-lg btn-primary btn-block" name="submit-admin" value="Внести изменения" type="submit">
	</form>

</div>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>
