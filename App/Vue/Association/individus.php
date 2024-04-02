<?php ob_start();    include_once('App/Vue/User_Association/nav.php');?>
  
<div class="container">
    <div class="d-flex justify-content-between col-12">
        <a class="btn btn-primary m-3" href="http://localhost/Project/?action=creat_desparu">Ajouter un individu</a>
        <form class="d-flex align-items-center" action="" >
            <input placeholder="nom" type="text" class="form-control">
            <button class="btn btn-outline-dark ms-2">serch</button>
        </form>
        
    </div>
    <table id="tableres" class="table table-hover table-primary text-center">
        <thead>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Ville</th>
                <th>Action</th>
            </tr>
        </thead>

    </table>
</div>
<?php
    $content = ob_get_clean();
    $styles = <<<styles
        <link rel='stylesheet' href='Public/styles/User_Association/header.css'>
        <link rel='stylesheet' href='Public/styles/Association/individus.css'>
        <script src='Public/scripts/Users/jquery-3.7.1.js'></script>
        styles;

    $scripts = <<<script
    <script src='Public/scripts/Users/header.js'></script>
    <script src='Public/scripts/Association/individus.js'></script>
    script;

    $title = 'Accueil';
    
    include_once 'App/Vue/Mastre.php'; 
?>