<?php ob_start();?>
<style>
.message1 {
    min-width: 120px;
    max-width: max-content;
    padding: 6px;
    min-height: 50px;
    text-wrap: wrap;
    border-radius: 20px 20px 20px 0;
    background-color: rgb(155, 201, 255);
    margin: 3px;
}

.message1 span {
    margin: 2px;
    font-size: 12px;
}

.message2>div>span {

    margin: 2px;
    font-size: 12px;
}

.message2 {
    display: flex;
    justify-content: end;
}

.message2>div {
    min-width: 120px;
    max-width: max-content;
    padding: 6px;
    min-height: 50px;
    text-wrap: wrap;
    border-radius: 20px 20px 0 20px;
    background-color: rgb(119, 255, 160);
    margin: 3px;
}
</style>
<input type="hidden" id="HASH" value="<?=$_SESSION["HASH"]?>">
<input type="hidden" id="USERHASH" value="">
<div class="row">
    <div class="min-vh-80 max-height-vh-80 d-flex justify-content-between align-self-stretch">
        <div class="col-4 border-radius-top-start border-radius-bottom-start bg-light" id="Discussions">
        </div>

        <div class="col-8 border-radius-top-end border-radius-bottom-end bg-white" id="chat">
            <div class="d-flex align-items-center p-1 bg-dark d-none" id="infochat">
                <img id="userimg" class="avatar m-2">
                <a id="userlink" href=""><span id="username" class="text-white link-info"></span></a>
            </div>
            <div class="diver text-center col-7 position-absolute mt-10"><span id="mesg_err" class="">taper sur un
                    conversation</span></div>
            <div class="height-400 mt-3 overflow-auto" id="Messages">

            </div>
            <div class="mt-2" id="form_message">

            </div>

        </div>
    </div>
</div>
<script src='Public/scripts/User_Association/Message.js'></script>
<?php
    $content = ob_get_clean();
   
    $title = 'Message';
    
    include_once 'App/Vue/Mastre.php'; 
?>