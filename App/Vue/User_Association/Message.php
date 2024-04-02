<?php ob_start();
    include_once("App/Vue/User_Association/nav.php");
?>
<input type="hidden" id="HASH" value="<?=$_SESSION["HASH"]?>">
<input type="hidden" id="USERHASH" value="">
<div class="containerdiv">
    <div class="Discussions" id="Discussions"></div>
    <div class="chat" id="chat">
        <div class="diver"><span id="mesg_err">taper sur un conversation</span></div>
        <div class="infochat" id="infochat">
            <img id="userimg" src="" alt="">
            <a id="userlink" href=""><span id="username"></span></a>
        </div>
        <div class="Messages" id="Messages"></div>
        <div class="form_message" id="form_message">

        </div>
        
    </div>
</div>
<?php
    $content = ob_get_clean();
    $styles = <<<styles
        <link rel='stylesheet' href='Public/styles/User_Association/header.css'>
        <link rel='stylesheet' href='Public/styles/User_Association/Message.css'>
        styles;
    $scripts = <<<script
    <script src='Public/scripts/User_Association/jquery-3.7.1.js'></script>
    <script src='Public/scripts/User_Association/header.js'></script>
    <script src='Public/scripts/User_Association/Message.js'></script>
    script;
    $title = 'Message';
    
    include_once 'App/Vue/Mastre.php'; 
?>