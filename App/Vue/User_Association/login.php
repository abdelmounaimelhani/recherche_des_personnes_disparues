<!DOCTYPE html>
<html lang="en">

<head>
    <title>Connexion</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='Public/styles/User_Association/login.css'>

</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" id="form_login">
        <h3>Connexion</h3>

        <label for="username">Username</label>
        <label id="emailer" class="errore"></label>
        <input type="text" name="email" class="form-input" id="email" placeholder="Email"
            value="<?php if(isset($_COOKIE['email']))echo $_COOKIE['email']?>">
        <label for="password">Mot De Pass</label>
        <label id="passer" class="errore"></label>
        <input type="password" name="pass" class="form-input" id="Pass" placeholder="Mot De Pass"
            value="<?php if(isset($_COOKIE['pass']))echo $_COOKIE['pass']?>">

        <div class="enrgestre">
            <span>Enregistrez vos informations de connexion</span>
            <input type="checkbox" name="eng" id="eng">
        </div>

        <button id="btn">Connexion</button>
        <div class="social">
            <div class=""><a href="?action=Register_user"> Creer un Cmpet </a></div>
        </div>
    </form>
    <script src='Public/scripts/User_Association/login.js'></script>
</body>

</html>