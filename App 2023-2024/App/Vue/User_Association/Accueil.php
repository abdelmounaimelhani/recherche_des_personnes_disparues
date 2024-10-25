<?php ob_start();
    if (isset($_SESSION['user'])) {
        $nom=$_SESSION['info']->nom." ".$_SESSION['info']->prenom;
    }else $nom=$_SESSION['info']->nom;
    $title = 'Accueil';
?>

<div
    class=" scroll d-flex height-100 max-height-150  mb-3 bg-dark rounded-3  col-12 justify-content-start align-items-center  ps-1 pe-2 collapse">
    <div id="result" class="h-75 me-1 d-flex me-2 "></div>
</div>
<div class="row col-12 rounded-3 bg-white d-flex justify-content-around">
    <button class="btn btn-behance col-5"  id="ADis">Avis de disparition</button>
    <button class="btn  col-5" id="ADec">Avis de découverte</button>
</div>
<input type="hidden" value="<?=$_SESSION['HASH']?>" id="userid">
<input type="hidden" value="<?=$nom?>" id="usernom">
<div class="col-12  d-flex justify-content-center">
    <div id="Posts" class="col-6"></div>
</div>
<div id="p_post">Plus pust</div>
<div id="msg"></div>

<script src="http://localhost/Project/Public/scripts/User_Association/Accueil.js"></script>
<?php
    $content = ob_get_clean();
    include_once 'App/Vue/Mastre.php'; 
?>