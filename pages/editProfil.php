<?php require_once "templates/dashboard.php" ?>

<?php

$UserModal = new Database($_SESSION['user_rule']);

$getUser = $UserModal->query(
  "
    SELECT * FROM {$_SESSION['user_rule']} WHERE user_id = :id
  "
)->bind('id', $_SESSION['user_id'])->resultSet();

if (count($getUser) === 0) {
  $insertUser = $UserModal->query(
    "INSERT INTO {$_SESSION['user_rule']} VALUES (:id, :ttl, :gender)"
  )->bind('id', $_SESSION['user_id'])
    ->bind('ttl', '-')
    ->bind('gender', '-')
    ->rowCount();

  $getUser = $UserModal->query(
    "SELECT * FROM {$_SESSION['user_rule']} WHERE user_id = :id"
  )->bind('id', $_SESSION['user_id'])->resultSet()[0];
}

$getName = $UserModal->query(
  "SELECT * FROM user WHERE id = :id"
)->bind('id', $_SESSION['user_id'])->resultSet()[0];

$getUser[0]['username'] = $getName['username'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $chanceU = $UserModel->query(
    "
      UPDATE {$_SESSION['user_rule']} SET
      user_id = :id,
      ttl = :ttl,
      gender = :gender
      WHERE user_id = :user_id
    "
  )->bind('id', $_SESSION['user_id'])
    ->bind('ttl', $_POST['ttl'])
    ->bind('gender', $_POST['gender'])
    ->bind('user_id', $_SESSION['user_id'])
    ->rowCount();

  $chanceY = $UserModel->query(
    "
      UPDATE user SET
      username = :username
      WHERE id = :id
    "
  )->bind('username', $_POST[''])
}

?>

<div class="container shadow-lg m-1 p-0 rounded" style="
  width: 50%;
  position: relative;
  left: 50%;
  transform: translateX(-50%);
  height: 70%;
">
  <div class="container-fluid bg-dark text-center p-0" style="height: 3em; color: white">
    Edit Profil Diri
  </div>
  <div class="form">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="row p-3">
        <div class="col">
          <div class="form-check m-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="<?= $getUser[0]['username'] ?>">
          </div>
          <div class="form-check m-3">
            <input type="date" class="form-control" name="ttl" placeholder="Name" value="<?= $getUser[0]['ttl'] ?>">
          </div>
          <div class="form-check m-3">
            <input type="text" class="form-control" name="gender" placeholder="Name" value="<?= $getUser[0]['gender'] ?>">
          </div>
          <div class="form-check  m-3">
            <input type="submit" class="btn btn-warning" value="submit" class="from-control">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<?php require_once "templates/bottom.php" ?>