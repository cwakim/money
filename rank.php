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
            <h1>Top Users By Rank</h1>
        </div>
        <div class="container">
            <p><a href="/">View Total</a></p>
            <p><a href="/create">Create User</a></p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>Id</th>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $users = $user->getUsersRank();
                    foreach ($users['items'] as $userRow) {
                ?>
                  <tr>
                      <td><?php echo $userRow['rank']; ?></td>
                      <td><?php echo $userRow['user_id']; ?></td>
                      <td><?php echo $userRow['fullname']; ?></td>
                      <td><?php echo $userRow['username']; ?></td>
                      <td><?php echo $userRow['total']; ?></td>
                      <td><a href="/add?user_id=<?php echo $userRow['user_id'] ?>">Add Points</a></td>
                  </tr>
                <?php
                    }
                ?>
              </tbody>
            </table>
        </div>
    </body>
</html>
