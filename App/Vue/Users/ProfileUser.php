<?php ob_start();    include_once('App/Vue/User_Association/nav.php');?>

<div class="containerdiv">
    <div class="Recherch">
        <div>
            <form id="Rch">
                <input type="text" id="inputrch" class="input-serch" placeholder="Serch">
                <input type="submit" value="recherch"  name="serch" class="serch-submit">
            </form>
            <hr>
        </div>
        <div class="result" id="result">
            <div class="res"></div>
        </div>
    </div>
    <div class="posts" id="posts">
        <div id="P"></div>
        <button id='p_post'>Plus Posts</button>
        <span class="user-res" id="msg"></span>
    </div>
</div>

<?php
    $content = ob_get_clean();
    $styles = <<<styles
        <link rel='stylesheet' href='Public/styles/User_Association/header.css'>
        <link rel='stylesheet' href='Public/styles/Users/Accule.css'>
        <script src='Public/scripts/Users/jquery-3.7.1.js'></script>
        styles;
    $scripts = <<<script
    <script src='Public/scripts/Users/header.js'></script>
    <script src='Public/scripts/Users/Accueil.js'></script>
    script;
    $title = 'Accueil';
    
    include_once 'App/Vue/Mastre.php'; 
?>