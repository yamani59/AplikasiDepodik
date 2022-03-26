<?php require_once "templates/dashboard.php" ?>
<?php

$infoSchool = new Database('inf_school');
$dataUser = [
  "username" => $_SESSION['user_username'],
  "ttl" => "-",
  "gender" => "-"
];
try {
  $UserModal = new Database($_SESSION['user_rule']);
  $dataUser = $UserModal->query(
    "
      SELECT * FROM {$UserModal->getTable()} WHERE user_id = :userId
    "
  )->bind('userId', $_SESSION['user_id'])->resultSet();
  if (!$dataUser) $dataUser = [
    "username" => $_SESSION['user_username'],
    "ttl" => "-",
    "gender" => "-"
  ];
} catch (\Exception $e) {
  Flass::msg($e->getMessage());
}

$dataInfo = $infoSchool->query(
  "
    SELECT * FROM {$infoSchool->getTable()}
  "
)->resultSet()[0];

?>
<div class="m-2">
  <div class="row">
    <?php for ($i = 0; $i <= 3; $i++) : ?>
      <div class="col m-3 bg-dark rounded border border-secondary shadow-lg d-flex flex-column p-5" style="color: white">
        <div class="row">
          <div class="col text-center">
            <i class="large material-icons">group</i>
            <h1>Guru</h1>
          </div>
          <div class="col text-center">
            <h1 class="fs-1">0</h1>
          </div>
        </div>
      </div>
    <?php endfor ?>
  </div>

  <div class="row" style="height: 200%">
    <div class="col-8 m-3 shadow-lg p-0 border rounded" style="
      color: white;
      height: 40%
      ">
      <div class="bg-dark rounded text-center" style="
        height: 3em;
        width: 100%
      ">
        <h3>Informasi Sekolah</h3>
      </div>
      <div class="container p-3 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col d-flex justify-content-center">
            <img src=<?= "../images/" . $dataInfo['image'] ?> alt="">
          </div>
          <div class="col">
            <div class="info-scho m-3 p-2 rounded" style="color: black; background: #DFDFDE">
              <p class="fs-5 m-0 fw-bold">Nama Sekolah: <?= $dataInfo['name'] ?></p>
            </div>
            <div class="info-scho m-3 p-2 rounded" style="color: black; background: #DFDFDE">
              <p class="fs-5 m-0 fw-bold">Alamat: <?= $dataInfo['address'] ?></p>
            </div>
            <div class="info-scho m-3 p-2 rounded" style="color: black; background: #DFDFDE">
              <p class="fs-5 m-0 fw-bold">MPSN: <?= $dataInfo['MPSN'] ?></p>
            </div>
            <div class="info-scho m-3 p-2 rounded" style="color: black; background: #DFDFDE">
              <p class="fs-5 m-0 fw-bold">Tahun Ajaran: <?= $dataInfo['school_year'] ?></p>
            </div>
          </div>
        </div>
        <div class="row d-flex p-4 justify-content-end">
          <?php if ($_SESSION['user_rule'] == 'admin') : ?>
            <a class="btn btn-warning" style="width: 20%" href="editInfo.php">Edit</a>
          <?php endif ?>
        </div>
      </div>
    </div>
    <div class="col m-3 shadow-lg p-0 border rounded" style="
      color: white;
      height: 40%
      ">
      <div class="bg-dark rounded text-center" style="
        height: 3em;
        width: 100%
      ">
        <h3>Profil account</h3>
      </div>
      <div class="row d-flex justify-content-center" style="
        width: 200px;
        height: 200px;
        position: relative;
        left: 50%;
        transform: translateX(-50%)
      ">
        <img src="../images/profil.png" alt="">
      </div>
      <div class="row m-3">
        <div class="info m-1 bg-dark rounded">
          <p>Nama : <?= $dataUser['username'] ?></p>
        </div>
        <div class="info m-1 bg-dark rounded">
          <p>Tanggal Lahir : <?= $dataUser['ttl'] ?></p>
        </div>
        <div class="info m-1 bg-dark rounded">
          <p>Jenis Kelamin : <?= $dataUser['gender'] ?></p>
        </div>
        <a class="btn btn-warning m-3" style="width: 20%" href="editProfil.php">Edit</a>
      </div>
    </div>
  </div>
</div>


<?php require_once "templates/bottom.php" ?>