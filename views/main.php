<?php include_once ROOT . '/views/layouts/header.php'; ?>

	<div class="container">
		<h1>Тестовая задача</h1>

		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Таблица заданий</div>

			<!-- Table -->
			<table id="table" class="table table-bordered">
				<thead>
				<tr>
                    <?php foreach (Main::COLUMNS as $column_name => $column_label): ?>
                        <th>
                            <?php
                                $icon_class = 'glyphicon-sort';
                                $url = '/?columnToSort=' . $column_name . '&sortOrder=asc';

                                if ($column_name === $columnToSort) {
                                    $icon_class = 'glyphicon-sort-by-alphabet';

                                    $url = '/?columnToSort=' . $column_name;

                                    if (empty($sortOrder) || $sortOrder === 'asc')
                                    {
                                        $url .= '&sortOrder=desc';
                                        $icon_class = 'glyphicon-sort-by-alphabet';
                                    } else {
                                        $url .= '&sortOrder=asc';
                                        $icon_class = 'glyphicon-sort-by-alphabet-alt';
                                    }
                                }
                            ?>

                            <?php if (in_array($column_name, Main::COLUMNS_TO_SORT)): ?>
                                <a href="<?= $url ?>" id=" <?=$column_name ?>" class="column_sort">
                                    <span class="glyphicon <?= $icon_class ?>"></span>
                                </a>
                                <br>
                                <?= $column_label ?>
                            <?php else: ?>
                                <?= $column_label ?>
                            <?php endif; ?>
                        </th>
                    <?php endforeach; ?>
				</tr>
				</thead>
				<?php foreach ($taskList as $task): ?>
					<tr>
						<td class="col-xs-1"><?php echo $task[ 'id' ] ?></td>
						<td class="col-xs-1"
						"><?php echo $task[ 'name' ] ?></td>
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
		</div>

		<?php echo $pagination->get(); ?>

		<form class="form-signin" action="#" method="post">

			<?php if (!isset($_SESSION[ 'user' ])): ?>
				<input type="email" name="email" class="form-control" placeholder="Почта" required> <br>
			<?php endif ?>
			<input type="text" name="text" class="form-control" placeholder="Введите текст задачи" required>

			<br>
			<input class="btn btn-lg btn-primary btn-block" name="submit" value="Ввод" type="submit">
		</form>
	</div>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>