<?php ob_start(); ?>
<div class="row mt-5">
<div class="card mb-4">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="position-relative">
                        <img src="<?=$Disp->photo?>" for="PH" alt="profile_image"
                            class="avatar avatar-xxl border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-5 text-center my-auto">
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">Nom</p>
                        <p class="mb-1"><?=$Disp->nom?></p>
                    </div>
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">Prenom</p>
                        <p class="mb-1"><?=$Disp->prenom?></p>
                    </div>
                </div>
                <div class="col-5 text-center my-auto">
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">Gennre</p>
                        <p class="mb-1"><?php if($Disp->Gennre=="H") echo "Homme" ; else echo "Famme" ?></p>
                    </div>
                    <div class="h-100">
                        <p class="mb-0 font-weight-bold text-sm">ville</p>
                        <p class="mb-1"><?=$Disp->ville?></p>
                    </div>
                </div>
            </div>
        </div>
</div>
    <div class="col-12">
        <div class="card  mb-4">
            <div class="card-header pb-0">
                <h6 class="text-dark">Modifire <?=$title?></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-borderless align-items-center mb-0">
                        <form action="" method="post" enctype="multipart/form-data">
                            <tbody>
                                <tr>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Nom</h6>
                                            <input placeholder="Nom" name="Nom" type="text" class="form-control" value="<?=$Disp->nom?>">
                                        </div>
                                    </td>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Prenom</h6>
                                            <input placeholder="Prenom" name="Prenom" type="text" class="form-control" value="<?=$Disp->prenom?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Date Naissance</h6>
                                            <input name="Naissance" type="date" class="form-control" value="<?=$Disp->date_N?>">
                                        </div>
                                    </td>
                                    <?php if(isset($_SESSION['user'])) { ?>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Date de Disparition</h6>
                                            <input name="dentree" type="date" class="form-control" value="<?=$Disp->date_disparition?>">
                                        </div>
                                    </td>
                                    <?php }elseif(isset($_SESSION['ass'])) { ?>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Date d'entrée</h6>
                                            <input name="dentree" type="date" class="form-control" value="<?=$Disp->date_entre?>">
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Genner</h6>
                                            <select name="Genner" class="form-select" id="">
                                                <option value="H" <?php if($Disp->Gennre=="H") echo "selected" ?>>Homme</option>
                                                <option value="F" <?php if($Disp->Gennre=="F") echo "selected" ?>>Famme</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Ville</h6>
                                            <input type="text" placeholder="Ville" name="Villa" class="form-control" value="<?=$Disp->ville?>">
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Photo</h6>
                                            <input type="file" id="PH" name="Photo" class="form-control">
                                        </div>
                                    </td>
                                    <td class="col-6">
                                        <div class="col-10 d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-white">Enregistrer</h6>
                                            <input type="submit" name="sub" value="Ajouter" class="btn btn-primary">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    $content = ob_get_clean();
    if (isset($_SESSION['user'])) {
        $title = 'Ajouter Disparue';
    }elseif(isset($_SESSION['ass'])){
        $title = 'Ajouter individue';
    }
    
    include_once 'App/Vue/Mastre.php'; 
?>