<!-- SIGN UP FORM -->
<div id="cd-signup"> 
    <form class="cd-form" action="register.php" method="POST">
        <p class="fieldset">
            <label class="image-replace cd-username" for="signup-firstname">First Name</label>
            <input class="full-width has-padding has-border <?php echo isset($_SESSION['signup_error']['firstname']) ? "has-error" : "" ?>" type="text" placeholder="First name" name="signup_firstname" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : "" ?>">
            <?php if(isset($_SESSION['signup_error']['firstname'])): ?>
                <span class="cd-error-message is-visible"><?php echo $_SESSION['signup_error']['firstname']; ?></span>
            <?php endif; unset($_SESSION['signup_error']['firstname']); ?>
        </p>

        <p class="fieldset">
            <label class="image-replace cd-username" for="signup-lastname">Last Name</label>
            <input class="full-width has-padding has-border <?php echo isset($_SESSION['signup_error']['lastname']) ? "has-error" : "" ?>" type="text" placeholder="Last name" name="signup_lastname" value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : "" ?>">
            <?php if(isset($_SESSION['signup_error']['lastname'])): ?>
                <span class="cd-error-message is-visible"><?php echo $_SESSION['signup_error']['lastname']; ?></span>
            <?php endif; unset($_SESSION['signup_error']['lastname']); ?>
        </p>

        <p class="fieldset">
            <label class="image-replace cd-email" for="signup-email">E-mail</label>
            <input class="full-width has-padding has-border <?php echo isset($_SESSION['signup_error']['email']) ? "has-error" : "" ?>" type="email" placeholder="E-mail" name="signup_email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : "" ?>">
            <?php if(isset($_SESSION['signup_error']['email'])): ?>
                <span class="cd-error-message is-visible"><?php echo $_SESSION['signup_error']['email']; ?></span>
            <?php endif; unset($_SESSION['signup_error']['email']); ?>
        </p>

        <p class="fieldset">
            <label class="image-replace cd-password" for="signup-password">Password</label>
            <input class="full-width has-padding has-border <?php echo isset($_SESSION['signup_error']['password']) ? "has-error" : "" ?>" type="password"  placeholder="Password" name="signup_password">
            <a href="#0" class="hide-password">Show</a>
            <?php if(isset($_SESSION['signup_error']['password'])): ?>
                <span class="cd-error-message is-visible"><?php echo $_SESSION['signup_error']['password']; ?></span>
            <?php endif; unset($_SESSION['signup_error']['password']); ?>
        </p>

        <p class="fieldset">
            <label class="image-replace cd-password" for="signin-password">Retype Password</label>
            <input class="full-width has-padding has-border <?php echo isset($_SESSION['signup_error']['repassword']) ? "has-error" : "" ?>" type="password"  placeholder="Retype password" name="signup_repassword">
            <a href="#0" class="hide-password">Show</a>
            <?php if(isset($_SESSION['signup_error']['repassword'])): ?>
                <span class="cd-error-message is-visible"><?php echo $_SESSION['signup_error']['repassword']; ?></span>
            <?php endif; unset($_SESSION['signup_error']['repassword']); ?>
        </p>

        <p class="fieldset">
            <input type="checkbox" id="accept-terms">
            <label for="accept-terms">I agree to the <a href="#0">terms and conditions</a></label>
        </p>

        <p class="fieldset">
            <button type="submit" name="signup">Create account</button>
        </p>
    </form>

</div>