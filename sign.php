<!DOCTYPE html>
<html>
<head>
	<title>eduscrum</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles/sign.css">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
	<main>
		<div>
			<img class='paralaxImg' src="images/img1.png">
		</div>
		<div class="content">
			<form class="signIn" method="POST">
				<h2>Member Login</h2>
				<input name="email" type="email" placeholder="email">
				<i class="fa fa-envelope" aria-hidden="true"></i>
				<input name="password" type="password" placeholder="password">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<?php 
				if (isset($_SESSION['sign_in_error'])) {
					echo "<p class='err'>".$_SESSION['sign_in_error']."</p>";
			        unset($_SESSION['sign_in_error']);
			      }
	            ?>
				<input name="signIn" type="submit" value="Login">
			</form>
			<div class="forgot">
				<p>Forgot</p>
				<a href="">Username</a>
				<p> / </p>
				<a href="">Password</a>
				<p>?</p>
			</div>
			<p class="createAcc signBtn1">Create your Account  -><i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> </p>
		</div>
		<form class="signUp hidden" method="POST">
			<h2>Registration</h2>
			<input type="name" name="name" placeholder="name">
			<i class="fas fa-user-circle"></i>
			<input type="surname" name="surname" placeholder="surname">
			<i class="fas fa-user-circle"></i>
			<input name="email" type="email" placeholder="email">
			<i class="fa fa-envelope" aria-hidden="true"></i>
			<input name="password" type="password" placeholder="password">
			<i class="fa fa-lock" aria-hidden="true"></i>
			<input name="repassword" type="password" placeholder="password again">
			<i class="fa fa-lock" aria-hidden="true"></i>
			<select name="status">
				<option value="student">student</option>
				<option value="teacher">teacher</option>
			</select>
			<input type="text" name="PIN" placeholder="PIN" class="hidden">
			<select name="group">
				<?php
					$groups = $con->query("SELECT * FROM groups")->fetchAll();
					foreach($groups as $group):
				?>
					<option value="<?= $group['id']; ?>"><?= $group['name']; ?></option>
				<?php endforeach; ?>
			</select>
			<!-- <i class="fas fa-users"></i> -->
			<input name="signUp" type="submit" value="Sign un" placeholder="">
		</form>
		<div class="about hidden">
			<div>
				<img class='paralaxImg' src="images/img1.png">
				<p>texttexttexttexttexttex</p>
			</div>
			<p class="backSign signBtn1"><span>Back  -></span><i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> </p>
		</div>
	</main>
	<script src="script.js"></script>
</body>
</html>