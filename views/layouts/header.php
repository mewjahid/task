<html>
	<head>
		<title>Задачник</title>
		<style>
			body
			{
				padding-top: 70px;
			}
		</style>
	</head>
	<body>
		<!-- Fixed navbar -->
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Задачник</a>
				</div>
				<div class="navbar-collapse collapse">

					<ul class="nav navbar-nav navbar-right">

						<?php if (User::isGuest()): ?>
							<li><a href="/user/login/">Вход</a></li>
							<li><a href="/user/register/">Регистрация</a></li>

						<?php else: ?>
							<li><a><?php echo $user['name'];?></a></li>
							<li><a href="/user/logout/">Выход</a></li>
						<?php endif; ?>

					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>