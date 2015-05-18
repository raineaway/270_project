<html>
<head>
    <title>Scheduler: Log In</title>
</head>
<body>
    <div>
        <div>Log In</div>
        <div>
            <?php if (isset($errors['warning'])) { ?>
                <div class="warning"><?php echo $errors['warning']; ?></div>
            <?php } ?>
            <form action='<?php echo site_url(array('login')); ?>' method='POST'>
                <div class="row">
                    <?php if (isset($errors['username'])) {?>
                        <div class="error">Error: <?php echo $errors['username']; ?></div>
                    <?php } ?>
                    <div class="field"><input type="text" name="username" placeholder="Username" /></div>
                </div>
                <div class="row">
                    <?php if (isset($errors['password'])) {?>
                        <div class="error"><?php echo $errors['password']; ?></div>
                    <?php } ?>
                    <div class="field"><input type="password" name="password" placeholder="Password" /></div>
                </div>
                <div class="row submit">
                    <input type="Submit" value="Log In" />
                </div>
                <div class="row right">
                    Don't have an account yet? <a href="<?php echo site_url(array("signup")); ?>">Sign up here.</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
