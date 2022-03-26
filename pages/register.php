<?php
require_once "../init.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $DB = new Database('user');
  try {
    $insert = $DB->query(
      "
      INSERT INTO {$DB->getTable()} VALUES 
      (NULL, :username, :password, :rule)
    "
    )
      ->bind('username', $_POST['username'])
      ->bind('password', password_hash($_POST['password'], PASSWORD_DEFAULT))
      ->bind('rule', $_POST['rule'])
      ->rowCount();

    if ($insert > 0) {
      header('Location: ' . BASEURL . 'login.php');
      exit();
    }
  } catch (PDOException $e) {
    Flass::msg($e->getMessage());
  }

  Flass::msg('input failed');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/css/bootstrap.css">
  <title>Register</title>
</head>

<body>
  <div class="container-fluid bg-dark d-flex align-items-center" style="height: 100vh">
    <div class="container bg-light d-flex p-5 d-flex align-items-center" style="height: 40vh; width: 50%">
      <div class="image bg-warning" style=" width: 50%;
                height: 100%">
      </div>
      <form action="" method="post">
        <div class="form-check mb-3" style="width: 200%">
          <input type="text" class="form-control" name="username" placeholder="Username" style="width: 100%">
        </div>
        <div class="form-check mb-3" style="width: 200%">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-check mb-3" style="width: 200%">
          <select name="rule" class=" form-select">
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
          </select>
        </div>

        <div class="form-check">
          <input type="submit" value="submit" class="btn btn-warning">
        </div>
        <a class="m-4" href="login.php">Login</a>
      </form>
    </div>
  </div>
</body>

</html>