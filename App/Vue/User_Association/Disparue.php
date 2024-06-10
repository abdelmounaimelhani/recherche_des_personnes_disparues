<?php ob_start();?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6><?=$title?> table</h6>
            </div>
            <?php
            if (!isset($_GET["ASS"]) && !isset($_GET["USER"]) && !isset($_GET["hash"])):?>
                <div class="d-flex justify-content-between p-2">
                    <a href="<?=$link?>" class="btn btn-outline-primary">Ajouter <?=$title?></a>
                    <form action="" method="post">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Recherch">
                        </div>
                    </form>
                </div>
            <?php endif;?>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Indivudue
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Date De Naissance</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <?php 
                            
                            if (isset($_GET["ASS"])) echo "Date d'entrée";
                            elseif (isset($_GET["USER"])) echo "Date disparition";
                            elseif (isset($_SESSION["ass"])) echo "Date d'entrée";
                            elseif(isset($_SESSION["user"])) echo "Date disparition";
                        ?>
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Ville</th>
                                    <?php if (!isset($_GET["ASS"]) && !isset($_GET["USER"]) && !isset($_GET["hash"])):?>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    colspan="2">Action</th>
                                    <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($RES)>0){
                                foreach ($RES as $indi) :
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="<?=$indi->photo?>" class="avatar avatar-sm me-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"><?=$indi->nom." ".$indi->prenom?></h6>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0"><?=$indi->date_N?></p>

                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">
                                        <?php  
                                        if (isset($_GET["ASS"])) echo $indi->date_entre;
                                        elseif (isset($_GET["USER"])) echo $indi->date_disparition;
                                        elseif (isset($_SESSION["ass"])) echo $indi->date_entre;
                                        elseif (isset($_SESSION["user"])) echo $indi->date_disparition;
                                    ?>
                                        
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold"><?=$indi->ville?></span>
                                </td>
                                <?php if (!isset($_GET["ASS"]) && !isset($_GET["USER"]) && !isset($_GET["hash"])){ ?>
                                <td class="align-middle">
                                    <a href="http://localhost/Project/?action=Modifier_desp&IDD=<?=$indi->id?>"
                                        class="text-success font-weight-bold text-xs d-block text-center"
                                        title="Edit Disparue">
                                        <i class="fas fa-edit text-sm opacity-10"></i> Modifier
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a onclick="return confirm('Confirmer la sipprission')" href="?action=<?php if(isset($_SESSION['user'])) echo "Disparues&id=".$indi->id; else echo "Individue&id=".$indi->id ?>"
                                        class="text-danger font-weight-bold text-xs d-block text-center"
                                        title="Edit Disparue">
                                        <i class="fas fa-trash text-sm opacity-10"></i> Supprimer
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="http://localhost/Project/?action=Recherch_desparu&IDD=<?=$indi->id?>&hash=<?=$_SESSION["HASH"]?>"
                                        class="text-primary font-weight-bold text-xs d-block text-center"
                                        title="Edit Disparue">
                                        <i class="fas fa-search text-sm opacity-10"></i> Serch
                                    </a>
                                </td>
                                <?php } ?>
                                    
                            </tr>
                            <?php endforeach; } else{ ?>
                            <tr>
                                <td colspan="5">
                                    <p class="text-center"><?=$msg?></p>
                                </td>
                            </tr>
                            <?php }?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $content = ob_get_clean();
    
    include_once 'App/Vue/Mastre.php'; 
?>