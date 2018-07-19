<?php
    require_once 'models/user.php';
    $userId = null;
    if (isset($_GET['user_id']))
    {
        $userId = $_GET['user_id'];
    }
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
            <h1>Add Points</h1>
        </div>
        <?php
            if (isset($_POST['amount']))
            {
                $user->addUserPoint($_POST['user_id'], $_POST['amount']);
        ?>
        <div class="alert alert-success">
            <strong>Success!</strong> Added <?php echo $_POST['amount']; ?> points for user with id <?php echo $_POST['user_id']; ?>
        </div>
        <?php
            }
        ?>
        <div class="container">
            <p><a href="/">Home</a></p>
            <form method="POST" action="/add">
              <div class="form-group">
                  <label for="user_id">User:</label>
                  <select name="user_id">
                  <?php
                      $users = $user->getUsers();
                      foreach ($users['items'] as $item) {
                  ?>
                      <option
                          <?php if($userId == $item['user_id']) { echo 'selected';} ?>
                          value="<?php echo $item['user_id'] ?>">
                          <?php echo $item['username'] .' - '. $item['fullname'] ?>
                      </option>
                  <?php
                      }
                  ?>
                  </select>
              </div>
              <div class="form-group">
                  <label for="amount">Amount:</label>
                  <input type="number" class="form-control" id="amount" name="amount" required/>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </body>
</html>
