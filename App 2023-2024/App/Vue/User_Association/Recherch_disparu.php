<?php ob_start(); 
    $title='Rechech_disparue';

?>
<style>
    .loaderdisp {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  border: 3px solid;
  border-color: #111 #111 transparent transparent;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
    }
    .loaderdisp::after,
    .loaderdisp::before {
    content: '';  
    box-sizing: border-box;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    border: 3px solid;
    border-color: transparent transparent #5e72e4 #5e72e4;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    box-sizing: border-box;
    animation: rotationBack 0.5s linear infinite;
    transform-origin: center center;
    }
    .loaderdisp::before {
    width: 10px;
    height: 10px;
    border-color: #111 #111 transparent transparent;
    animation: rotation 1.5s linear infinite;
    }
        
    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    } 
    @keyframes rotationBack {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(-360deg);
    }
    }
    
</style>
<div class="row">
    <?php if(isset($_GET["IDD"]) && isset($Disp)){ ?>
    <div class="card">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="position-relative">
                        <a href="">
                            <img src="<?=$Disp->photo?>" alt="profile_image"
                                class="avatar avatar-xxl border-radius-lg shadow-sm">
                        </a>
                    </div>
                </div>
                <div class="col-3 text-center my-auto">
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">Nom</p>
                        <p class="mb-1"><?=$Disp->nom?></p>
                    </div>
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">Prenom</p>
                        <p class="mb-1"><?=$Disp->prenom?></p>
                    </div>
                </div>
                <div class="col-3 text-center my-auto">
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">Gennre</p>
                        <p class="mb-1"><?php if($Disp->Gennre=="H") echo "Homme" ; else echo "Famme" ?></p>
                    </div>
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">ville</p>
                        <p class="mb-1"><?=$Disp->ville?></p>
                    </div>
                </div>
                <div class="col-3 text-center my-auto">
                    <?php if (isset($_SESSION["user"])) {?>
                        <div class="h-100">
                            <p class="mb-0 font-weight-bold text-sm">Date Disparition</p>
                            <p class="mb-1"><?=$Disp->date_disparition?></p>
                        </div>
                    <?php }elseif(isset($_SESSION["ass"])){?>
                        <div class="h-100">
                            <p class="mb-0 font-weight-bold text-sm">Date Entre</p>
                            <p class="mb-1"><?=$Disp->date_entre?></p>
                        </div>
                    <?php }?>
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">Date Naissance</p>
                        <p class="mb-1"><?=$Disp->date_N?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button id="BtnRES" class="btn btn-github">Recherch Avec Image </button>
        </div>
    </div>
    <?php }else{ ?>
    <form action="" method="post">
        <table class="table align-items-center mb-0 bg-white rounded-3">
            <tbody>
                <tr>
                    <td>
                        <div class="col-10 d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-dark">Nom</h6>
                            <input value="<?php if(isset($_POST['Nom'])) echo $_POST['Nom'] ?>" placeholder="Nom"
                                name="Nom" type="text" class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="col-10 d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-dark">Prenom</h6>
                            <input value="<?php if(isset($_POST['Prenom'])) echo $_POST['Prenom'] ?>"
                                placeholder="Prenom" name="Prenom" type="text" class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="col-10 d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-dark">Ville</h6>
                            <input value="<?php if(isset($_POST['Ville'])) echo $_POST['Ville'] ?>" placeholder="Ville"
                                name="Ville" type="text" class="form-control">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-10 d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-dark">Gennre</h6>
                            <select name="Gennre" class="form-select">
                                <option value="H"
                                    <?php if(isset($_POST['Gennre'])&&$_POST['Gennre']=='H') echo "selected" ?>>Homme
                                </option>
                                <option value="F"
                                    <?php if(isset($_POST['Gennre'])&&$_POST['Gennre']=='F') echo "selected" ?>>Famme
                                </option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-10 d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-dark">Date Naissance</h6>
                            <input value="<?php if(isset($_POST['Daten'])) echo $_POST['Daten'] ?>" name="Daten"
                                type="date" class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="col-10 d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-dark">
                                <?php if(isset($_SESSION['user'])) echo "Date de disparition";elseif(isset($_SESSION['ass'])) echo "Date d'entrée"; ?>
                            </h6>
                            <input value="<?php if(isset($_POST['Dated'])) echo $_POST['Dated'] ?>" name="Dated"
                                type="date" class="form-control">
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
    <?php }?>
</div>
<?php if(isset($data)) : ?>
<div class="row">
    <div class="col-12 mt-4" >
        <div class="card pb-3" id="Res">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0 d-flex align-content-center me-2" id="titre">Résultats de recherche </h6>
            </div>
            <?php
      if(count($data)>0) {

      foreach ($data as $key => $value) :
      if(isset($_SESSION['user'])) :
      ?>
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
                            <span class="mb-2 text-xs">
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
                                <span class="text-dark font-weight-bold ms-sm-2"><?= $value->adress ?></span>
                            </span>
                            <span class="mb-2 text-xs">
                                Email Address:
                                <span class="text-dark ms-sm-2 font-weight-bold"><?= $value->email ?></span>
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
                                <i class="ni ni-email-83 text-dark me-2" aria-hidden="true"></i>
                                Missage
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <?php endif;if(isset($_SESSION['ass'])) :?>
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
                                <span class="text-dark ms-sm-2 font-weight-bold"><?= $value->ville ?></span>
                            </span>
                            <span class="text-xs">
                                Genner:
                                <span class="text-dark ms-sm-2 font-weight-bold">
                                    <?php if($value->Gennre=="H") echo "Homme"; elseif($value->Gennre=="F") echo "Famme" ?>
                                </span>
                            </span>
                        </div>
                        <div class="d-flex flex-column col-4">
                            <h6 class="mb-3 text-sm"><?= $value->nomC ?></h6>
                            <span class="mb-2 text-xs">
                                Email Address:
                                <span class="text-dark ms-sm-2 font-weight-bold"><?= $value->email ?></span>
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
                                <i class="ni ni-email-83 text-dark me-2" aria-hidden="true"></i>
                                Missage
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <?php endif; endforeach; }else {?>
            <div class="card-body pt-4 p-3">
                <p class="text-center">Il n'y a aucun résultat pour ces données</p>
            </div>
            <?php }endif ?>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['ass'])) {?>
    <script src="Public/scripts/User_Association/ApiIndi.js"></script>
<?php }elseif(isset($_SESSION['user'])){?>
    <script src="Public/scripts/User_Association/ApiDis.js"></script>
<?php }?>
<?php $content = ob_get_clean();
    include_once("./App/Vue/Mastre.php");
?> 