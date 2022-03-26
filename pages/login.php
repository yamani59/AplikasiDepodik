<?php

require_once "../init.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $DB = new Database('user');

  try {
    $validateData = $DB->query("
      SELECT * FROM {$DB->getTable()} WHERE username = :username
    ")->bind('username', $_POST['username'])->resultSet();

    if (!password_verify($_POST['password'], $validateData[0]['password']))
      throw new Exception('Failed');

    $_SESSION['user_id'] = $validateData[0]['id'];
    $_SESSION['user_username'] = $validateData[0]['username'];
    $_SESSION['user_rule'] = $validateData[0]['rule'];

    header('Location: ' . BASEURL . 'beranda.php');
    exit();
  } catch (Exception $e) {
    Flass::msg($e->getMessage());
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/css/bootstrap.css">
  <title>LOGIN</title>
</head>

<body>
  <div class="container-fluid bg-dark d-flex align-items-center" style="height: 100vh">
    <div class="container bg-light d-flex p-5 d-flex align-items-center" style="height: 40vh; width: 50%">
      <div class="image bg-warning" style=" width: 50%;
                height: 100%">
      </div>
      <form action="" method="post">
        <div class="form-check mb-3" style="width: 200%">
          <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" style="width: 100%">
        </div>
        <div class="form-check mb-3" style="width: 200%">
          <input type="password" class="form-control" name="password" placeholder="Password" style="width: 100%">
        </div>

        <div class="form-check">
          <input type="submit" value="submit" class="btn btn-warning">
        </div>
        <a class="m-4" href="register.php">Belum punya akun</a>
      </form>
    </div>
  </div>
</body>

</html>