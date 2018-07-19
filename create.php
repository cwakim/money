<?php
    require_once 'models/user.php';
    $user = new User();
?>
<html>
    <head>
        <title>Money Demo</title> <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="jumbotron text-center">
            <h1>Create User</h1>
        </div>
        <?php
            if (isset($_POST['password']))
            {
                if ($_POST['password'] !== $_POST['confirm_password'])
                {
                ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong> Passwords do not match
                </div>
                <?php
                }
                else
                {
                    $userId = $user->createUser($_POST['username'], $_POST['password'], $_POST['fullname'])
                ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> Created User <?php echo $_POST['username']; ?> with id <?php echo $userId; ?>
                </div>
                <?php

                }
            }
        ?>
        <div class="container">
            <p><a href="/">Home</a></p>
            <form method="POST" action="/create">
              <div class="form-group">
                  <label for="fullname">Full Name:</label>
                  <input type="text" name="fullname" class="form-control" required />
              </div>
              <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" name="username" class="form-control" required />
              </div>
              <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" name="password" class="form-control" required />
              </div>
              <div class="form-group">
                  <label for="confirm_password">Confirm Password:</label>
                  <input type="password" name="confirm_password" class="form-control" required />
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </body>
</html>
