<?php ob_start();  include_once('App/Vue/User_Association/nav.php');?>
<div class="containerdiv1">
    <div class="profile">
        <div class="profile-heade">
            <img src="<?=$res->photo?>" class="profile-img" />
            <span class="profile-name"><?=$res->nom." ".$res->prenom?></span>
        </div>
        <div class="profil-bodey">
            <div class="btn-link modifier">modifier</div>
            <div class="btn-link declaration">declaration</div>
            <div class="btn-link suprime" id="supp">suprimé</div>
        </div>
    </div>
    <div class="content">
        
        <form id="form">
            <input type="hidden" id="indv" value="<?=$res->id?>">
            <img class="photo" src="<?=$res->photo?>" />
            <div class="inputs">
                <div id="msg"></div>

                <div class="group-inp">
                    <label>Nom</label>
                    <input type="text" name="nom" id="nom" value="<?=$res->nom?>" class="inp" />
                </div>
                <div class="group-inp">
                    <label>Prenom</label>
                    <input type="text" name="Prenom" id="Prenom" value="<?=$res->prenom?>" class="inp" />
                </div>
                <div class="group-inp">
                    <label>Date Naissance</label>
                    <input type="date" name="datenai" id="datenai" value="<?=$res->date_N?>" class="inp" />
                </div>
                <div class="group-inp">
                    <label>Date d'entrée</label>
                    <input type="date" name="Dateen" id="Dateen" value="<?=$res->date_entre?>" class="inp" />
                </div>
                <div class="group-inp">
                    <label>Villa</label>
                    <input type="text" name="Villa" id="Villa" value="<?=$res->ville?>" class="inp" />
                </div>
                
                <input type="submit" id="btns" value="Modifier" class="btnsub">
            </div>
        </form>
    </div>
</div>

<?php
    $content = ob_get_clean();
    $styles = <<<styles
        <link rel='stylesheet' href='Public/styles/User_Association/header.css'>
        <link rel='stylesheet' href='Public/styles/Association/info_iniv.css'>
        <script src='Public/scripts/Users/jquery-3.7.1.js'></script>
        styles;

    $scripts = <<<script
    <script src='Public/scripts/Users/header.js'></script>
    <script src='Public/scripts/Association/info_iniv.js'></script>
    script;

    $title = 'profile';
    
    include_once 'App/Vue/Mastre.php'; 
?>