<html>
<head>
    <title>Scheduler: Sign Up</title>
</head>
<body>
    <div>
        <div>Create an Account</div>
        <div>
            <?php if (isset($errors['warning'])) { ?>
                <div class="warning">Error: <?php echo $errors['warning']; ?></div>
            <?php } ?>
            <form action='<?php echo site_url(array('signup')); ?>' method='POST'>
                <div class="row">
                    <div class="field"><input type="text" name="username" placeholder="Username" /></div>
                </div>
                <div class="row">
                    <div class="field"><input type="text" name="email_address" placeholder="Email Address" /></div>
                </div>
                <div class="row">
                    <div class="field"><input type="text" name="firstname" placeholder="First Name" /></div>
                </div>
                <div class="row">
                    <div class="field"><input type="text" name="lastname" placeholder="Last Name" /></div>
                </div>
                <div class="row">
                    <?php if (isset($errors['password'])) {?>
                        <div class="error"><?php echo $errors['password']; ?></div>
                    <?php } ?>
                    <div class="field"><input type="password" name="password" placeholder="Password" /></div>
                </div>
                <div class="row">
                    <div class="field"><input type="password" name="confirm_password" placeholder="Confirm Password" /></div>
                </div>
                <div class="row submit">
                    <input type="Submit" value="Sign Up" />
                </div>
                <div class="row right">
                    Already have an account? <a href="<?php echo site_url(array("login")); ?>">Log In.</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
