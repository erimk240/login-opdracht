<?php

// Is de register button aangeklikt?
if (isset($_POST['register-btn'])) {
    require_once('classes/user.php');
    $user = new User();
    $errors = [];

    $user->username = $_POST['username'];
    $user->SetPassword($_POST['password']);

    // Validatie gegevens
    $errors = $user->ValidateUser();

    // Voeg extra validatie toe indien nodig

    if (count($errors) == 0) {
        // Register user
        $registrationErrors = $user->RegisterUser();

        if (count($registrationErrors) > 0) {
            $errors = array_merge($errors, $registrationErrors);
        }
    }

    if (count($errors) > 0) {
        $message = implode("\\n", $errors);

        echo "
        <script>alert('" . $message . "')</script>
        <script>window.location = 'register_form.php'</script>";
    } else {
        echo "
        <script>alert('" . "User registered" . "')</script>
        <script>window.location = 'login_form.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<body>

    <h3>PHP - PDO Login and Registration</h3>
    <hr/>

    <form action="" method="POST">
        <h4>Register here...</h4>
        <hr>

        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
        </div>
        <br />
        <div>
            <button type="submit" name="register-btn">Register</button>
        </div>
        <a href="index.php">Home</a>
    </form>

</body>
</html>
