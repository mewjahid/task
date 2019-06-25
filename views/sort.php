

<table id="table" class="table table-bordered">
	<thead>
		<tr>
			<th>№</th>
			<th><a href="#" id="email" class="column_sort" data-order="<?php echo $order ?>">
					<span class="glyphicon glyphicon-sort"></span></a>
				<br>Имя пользователя
			</th>
			<th><a href="#" id="email" class="column_sort" data-order="<?php echo $order ?>">
					<span class="glyphicon glyphicon-sort"></span></a>
				<br>email
			</th>
			<th><a href="#" id="text" class="column_sort" data-order="<?php echo $order ?>">
					<span class="glyphicon glyphicon-sort"></span></a>
				<br>Текст задачи
			</th>
			<th><a href="#" id="status" class="column_sort" data-order="<?php echo $order ?>">
					<span class="glyphicon glyphicon-sort"></span></a>
				<br>Выполнено
			</th>
		</tr>
	</thead>
	<?php foreach ($taskList as $task): ?>

		<tr>
			<td class="col-xs-1"><?php echo $task[ 'id' ] ?></td>
			<td class="col-xs-1"
			">
			<?php echo $task[ 'name' ] ?></td>
			<td class="col-xs-1"
			"><?php echo $task[ 'email' ] ?></td>
			<td class="col-xs-3"><?php echo $task[ 'text' ] ?>
			<td class="col-xs-1">
				<?php if ($task[ 'status' ] == 'on'): ?>
					<span class="glyphicon glyphicon-ok"></span>
				<?php else : ?>
					<span class="glyphicon glyphicon-remove"></span>
				<?php endif; ?>
			</td>
		</tr>

	<?php endforeach ?>
</table>

