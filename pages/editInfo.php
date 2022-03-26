<?php require_once "templates/dashboard.php" ?>
<?php

$infoSchoolDB = new Database('inf_school');
$dataInfo = $infoSchoolDB->query(
  "
    SELECT * FROM {$infoSchoolDB->getTable()}
  "
)->resultSet()[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $newName = $dataInfo['image'];
  try {
    if ($_FILES['image']['name']) {
      $pathLib = ['png'];
      $path = in_array(explode('/', $_FILES['image']['type'])[1], $pathLib);
      if (!$path) throw new Exception("File not support");

      $newName = md5($_FILES['image']['name']) . ".png";
      $newPath = "../images/" . $newName;
      move_uploaded_file($_FILES['image']['tmp_name'], $newPath);
    }

    $name = $_POST['name'];
    $address = $_POST['address'];
    $MPSN = $_POST['MPSN'];
    $schoolYear = $_POST['tahun'];
    $image = $dataInfo['image'];

    $update = $infoSchoolDB->query(
      "
      UPDATE inf_school SET
        name='$name',
        address='$address',
        MPSN='$MPSN',
        school_year='$schoolYear' 
        WHERE 1
    "
    );
    $update = $update->rowCount();
    if ($update == 0) throw new Exception('failed');
    Flass::msg('success');
    header('Location: ' . BASEURL . 'beranda.php');
    exit();
  } catch (\Exception $e) {
    Flass::msg($e->getMessage());
  }
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
    Edit Profil Sekolah
  </div>
  <div class="form">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="row p-3">
        <div class="col d-flex justify-content-center">
          <img src=<?= "../images/" . $dataInfo['image'] ?> alt="">
        </div>
        <div class="col-8">
          <div class="form-check m-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="<?= $dataInfo['name'] ?>">
          </div>
          <div class="form-check m-3">
            <input type="text" class="form-control" name="address" placeholder="Name" value="<?= $dataInfo['address'] ?>">
          </div>
          <div class="form-check m-3">
            <input type="number" class="form-control" name="MPSN" placeholder="Name" value="<?= $dataInfo['MPSN'] ?>">
          </div>
          <div class="form-check m-3">
            <input type="number" class="form-control" name="tahun" placeholder="Name" value="<?= $dataInfo['school_year'] ?>">
          </div>
          <div class="form-check m-3">
            <input class="form-control" type="file" name="image" id="">
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