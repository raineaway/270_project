<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">

            <?php
                echo heading('Your Account', 3);

                echo "Username : " . $user['username'];
                echo br(1);
                echo "Email Address : " . $user['email_address'];
                echo br(1);
                echo "First Name : " . $user['firstname'];
                echo br(1);
                echo "Last Name : " . $user['lastname'];
                echo br(3);

                echo anchor('user/update', 'Update');
                echo br(2);
            ?>

        </div>
    </div>
</div>
