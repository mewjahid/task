<?php  include_once ROOT.'/views/layouts/header.php'; ?>

<style>
	.form-class
	{
		padding-top: 70px;
	}
</style>

<div class="container">


	<div class="form-class">



		<form class="form-signin" action="#" method="post">



			<h2 class="form-signin-heading">Зайдите на сайт используя свои данные</h2>

			<?php if (isset($errors) && is_array($errors)): ?>
				<ul>

					<?php foreach ($errors as $error): ?>
						<li>
							<?php echo $error?>
						</li>
					<?php  endforeach ?>
				</ul>
			<?php endif ?>
			<input type="text" name="name" class="form-control" placeholder="Логин" required  ">
			<input type="password" name="password" class="form-control" placeholder="Пароль" required >

			<input class="btn btn-lg btn-primary btn-block" name="submit" value="Вход" type="submit">
		</form>
	</div>

	<style>
		body {
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #eee;
		}

		.form-signin {
			max-width: 500px;
			padding: 15px;
			margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
			margin-bottom: 10px;
		}
		.form-signin .checkbox {
			font-weight: normal;
		}
		.form-signin .form-control {
			position: relative;
			height: auto;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 10px;
			font-size: 16px;
		}
		.form-signin .form-control:focus {
			z-index: 2;
		}
		.form-signin input[type="email"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
	<?php  include_once ROOT.'/views/layouts/footer.php'; ?>
