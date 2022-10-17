<?php

	include("config/session.php");

	if(isset($_GET['v'])) {
		$active = $_GET['v'];
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" href="images/favicon-32x32.png" sizes="32x32">
  <link rel="icon" href="images/favicon-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon" href="images/favicon-180x180.png">
  <link rel="stylesheet" href="styles/login.css?v=<?php echo time(); ?>">
  <title>Login - Doppell</title>
</head>
<body>

	<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#0" class="<?php echo ($active == "login") ? "active" : ""; ?>">Sign in</a></li>
				<li><a href="#0">New account</a></li>
			</ul>

			<div id="cd-login"> <!-- log in form -->
				<form class="cd-form" action="verify.php" method="POST">
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail</label>
						<input class="full-width has-padding has-border <?php echo isset($_SESSION['login_error']['email']) ? "has-error" : "" ?>" type="email" placeholder="E-mail" name="login_email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : "" ?>">
						<?php if(isset($_SESSION['login_error']['email'])): ?>
							<span class="cd-error-message is-visible"><?php echo $_SESSION['login_error']['email']; ?></span>
						<?php endif; unset($_SESSION['login_error']['email']); ?>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border <?php echo isset($_SESSION['login_error']['password']) ? "has-error" : "" ?>" type="password"  placeholder="Password" name="login_password">
						<a href="#0" class="hide-password">Show</a>
						<?php if(isset($_SESSION['login_error']['password'])): ?>
							<span class="cd-error-message is-visible"><?php echo $_SESSION['login_error']['password']; ?></span>
						<?php endif; unset($_SESSION['login_error']['password']); ?>
					</p>

					<p class="fieldset">
						<input type="checkbox" id="remember-me" checked>
						<label for="remember-me">Remember me</label>
					</p>

					<p class="fieldset">
						<button type="submit" name="login">Login</button>
					</p>
				
					<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
				</form>
			</div> <!-- cd-login -->

			<?php require('signup.php'); ?>

			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Email is taken or not valid email</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Reset password">
					</p>					

					<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
				</form>
			</div> <!-- cd-reset-password -->
			<a href="index.php" class="cd-close-form">
				<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->

    <script src="vendor/jquery-3.6.0.min.js"></script>
    <script src="scripts/login.js?v=<?php echo time(); ?>"></script>
</body>
</html>