<?php ob_start(); 
    $title='Rechech_disparue';
?>
<div class="row">
  <form action="" method="post">
  <table class="table align-items-center mb-0 bg-white rounded-3">
      <tbody>
        <tr>
          <td>
            <div class="col-10 d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm text-dark">Nom</h6>
              <input value="<?php if(isset($_POST['Nom'])) echo $_POST['Nom'] ?>" placeholder="Nom" name="Nom" type="text"  class="form-control">
            </div>
          </td>
          <td>
            <div class="col-10 d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm text-dark">Prenom</h6>
              <input value="<?php if(isset($_POST['Prenom'])) echo $_POST['Prenom'] ?>" placeholder="Prenom" name="Prenom" type="text"  class="form-control">
            </div>
          </td>
          <td>
            <div class="col-10 d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm text-dark">Ville</h6>
              <input value="<?php if(isset($_POST['Ville'])) echo $_POST['Ville'] ?>" placeholder="Ville" name="Ville" type="text"  class="form-control">
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="col-10 d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm text-dark">Gennre</h6>
              <select name="Gennre"  class="form-select">
                <option value="H" <?php if(isset($_POST['Gennre'])&&$_POST['Gennre']=='H') echo "selected" ?>>Homme</option>
                <option value="F" <?php if(isset($_POST['Gennre'])&&$_POST['Gennre']=='F') echo "selected" ?>>Famme</option>
              </select>
            </div>
          </td>
          <td>
            <div class="col-10 d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm text-dark">Date Naissance</h6>
              <input value="<?php if(isset($_POST['Daten'])) echo $_POST['Daten'] ?>"  name="Daten" type="date"  class="form-control">
            </div>
          </td>
          <td>
            <div class="col-10 d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm text-dark">Date de disparition</h6>
              <input value="<?php if(isset($_POST['Dated'])) echo $_POST['Dated'] ?>"  name="Dated" type="date"  class="form-control">
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <button name="Rechercher" class="btn btn-primary">Recherche</button>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
<?php if(isset($data)) { ?>
<div class="row">
  <div class="col-12 mt-4">
    <div class="card">
      <div class="card-header pb-0 px-3">
        <h6 class="mb-0">Résultats de la recherche pour personnes disparues</h6>
      </div>
      <?php
      if(count($data)>0) {
      foreach ($data as $key => $value) {?>
      <div class="card-body pt-4 p-3">
        <ul class="list-group">
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
            <div class="col-2">
              <img src="<?= $value->photo ?>" class="avatar avatar-xxl" alt="" />
            </div>
            <div class="d-flex flex-column col-4">
              <h6 class="mb-3 text-sm"><?=$value->nom ." ".$value->prenom?></h6>
              <span class="mb-2 text-xs">
                Date Naissance:
                <span class="text-dark font-weight-bold ms-sm-2"><?= $value->date_N ?></span></span>
              <span class="text-xs">
                Ville:
                <span class="text-dark ms-sm-2 font-weight-bold">
                  <?= $value->ville ?>
                </span>
              </span>
              <span class="text-xs">
                Genner:
                <span class="text-dark ms-sm-2 font-weight-bold">
                  <?php if($value->Gennre=="H") echo "Homme"; elseif($value->Gennre=="F") echo "Famme" ?>
                </span>
              </span>
            </div>
            <div class="d-flex flex-column col-4">
              <h6 class="mb-3 text-sm"><?= $value->assnom ?></h6>
              <span class="mb-2 text-xs">
                Address:
                <span class="text-dark font-weight-bold ms-sm-2"
                  ><?= $value->adress ?></span
                ></span
              >
              <span class="mb-2 text-xs">
                Email Address:
                <span class="text-dark ms-sm-2 font-weight-bold"
                  ><?= $value->email ?></span
                >
              </span>
              <span class="text-xs">
                telephone:
                <span class="text-dark ms-sm-2 font-weight-bold">
                  <?= $value->tele ?>
                </span>
              </span>
            </div>
            <div class="ms-auto text-end">
              <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;">
                <i class="ni ni-email-83 text-dark me-2" aria-hidden="true" ></i>
                Missage
              </a>
            </div>
          </li>
        </ul>
      </div>
      <?php } }else {?>
      <div class="card-body pt-4 p-3">
          <p class="text-center">Il n'y a aucun résultat pour ces données</p>
      </div>
    <?php }
      }else {} ?>
    </div>
  </div>
</div>
<?php $content = ob_get_clean();
    include_once("./App/Vue/Mastre.php");
?>