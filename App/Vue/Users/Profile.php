<?php
ob_start();
$title='Profile';
?>

<div class="card shadow-lg mx-4">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="<?=$user->photo?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1"><?=$user->nom." ".$user->prenom?></h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Utilisateur
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a id="IN"
                                class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                data-bs-toggle="tab" href="http://localhost/Project/?action=Profile&hash=<?=$_GET["hash"]?>" role="tab" aria-selected="true">
                                <i class="ni ni-single-02"></i>
                                <span class="ms-2">Info</span>
                            </a>
                        </li>
                        <?php  if(isset($_GET["hash"])){?>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-email-83"></i>
                                <span class="ms-2">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-bullet-list-67"></i>
                                <span class="ms-2">Publication</span>
                            </a>
                        </li>
                        <?php }else{?>
                        <li class="nav-item">
                            <a id="MD" class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-settings-gear-65"></i>
                                <span class="ms-2">Modifier</span>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row" id="info">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nom</label>
                                <input disabled class="form-control" type="text" value="<?=$user->nom?>"
                                    placeholder="Nom">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Prenom</label>
                                <input disabled class="form-control" type="text" value="<?=$user->prenom?>"
                                    placeholder="Prenom">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Gennre</label>
                                <input disabled class="form-control" type="text"
                                    value="<?php if($user->genner=="H"){echo "Homme";}else{echo "Femme";}?>"
                                    placeholder="Gennre">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Contact Information</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <input disabled class="form-control" value="<?=$user->email?>" type="email"
                                    placeholder="Exomple@gmail.com">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Telephone</label>
                                <input disabled class="form-control" value="<?=$user->tele?>" type="text"
                                    placeholder="0600000000">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Ville</label>
                                <input disabled class="form-control" value="<?=$user->Ville?>" type="text"
                                    placeholder="Ville">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-none" id="Modifier">
        <div class="col-12">
            <div class="card">
                <form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Modifier Profile</p>
                            <button name="Modifier" class="btn btn-primary btn-sm ms-auto">Enregestre</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nom</label>
                                    <input class="form-control" type="text" value="<?=$user->nom?>" placeholder="Nom"
                                        name="nom">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Prenom</label>
                                    <input class="form-control" type="text" value="<?=$user->prenom?>"
                                        placeholder="Prenom" name="prenom">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Gennre</label>
                                    <select name="Genner" class="form-select" id="">
                                        <option disabled>Genner</option>
                                        <option value="H" <?php if($user->genner=="H") echo "selected"?>>Homme</option>
                                        <option value="F" <?php if($user->genner=="F") echo "selected"?>>Famme</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Contact Information</p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" value="<?=$user->email?>" type="email" name="email"
                                        placeholder="Exomple@gmail.com">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Telephone</label>
                                    <input class="form-control" value="<?=$user->tele?>" type="text" name="Tele"
                                        placeholder="0600000000">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Ville</label>
                                    <input class="form-control" value="<?=$user->Ville?>" type="text" name="Ville"
                                        placeholder="Ville">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Mote de pass</label>
                                    <input class="form-control" type="password" name="pass" placeholder="Mote de pass">
                                </div>
                            </div>
                        </div>
                </form>
                <hr class="horizontal dark">
                <form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Changer le Mote de Pass</p>
                        <button name="Change" class="btn btn-primary btn-sm ms-auto">Changer</button>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-control-label">Neveu Mote de pass</label>
                                <input class="form-control" type="password" name="pass1">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-control-label">Confirmer Mote de pass</label>
                                <input class="form-control" type="password" name="pass2">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-control-label">Mote de pass</label>
                                <input class="form-control" type="password" name="pass">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
let info = document.getElementById('info');
let Modifier = document.getElementById('Modifier');
let MD = document.getElementById('MD');
let IN = document.getElementById('IN');
IN.addEventListener('click', function() {
    Modifier.classList.toggle('d-none');
    info.classList.toggle('d-none');
})
MD.addEventListener('click', function() {
    Modifier.classList.toggle('d-none');
    info.classList.toggle('d-none');
})
</script>
<?php 
    $content=ob_get_clean();
    include_once "./App/Vue/Mastre.php";