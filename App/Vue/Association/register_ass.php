<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='Public/styles/Users/register.css'>
    <title>Document</title>
</head>

<body>
    <div class="containerdiv">
        <div class="bg_img"></div>
        <form id="form_register" action="" method="post" class="form-register">
            <h1>créer Compte Association</h1>
            <div class="div_valid" id="div_valid"></div>
            <div class="error" id="error"></div>
            <div class="form-group">
                <label>nom</label>
                <input class="form-input" type="text" name="nom" id="nom" placeholder="Nom-Association">
            </div>
            <div class="form-group">
                <label>ville</label>
                <input class="form-input" type="text" name="ville" id="ville" placeholder="Ville">
            </div>
            <div class="form-group">
                <label>email</label>
                <input class="form-input" type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Tele</label>
                <input class="form-input" type="text" name="Tele" id="Tele" placeholder="Tele">
            </div>
            <div class="form-group">
                <label>adress</label>
                <input class="form-input" type="text" name="adress" id="adress" placeholder="Adress" />
            </div>
            <div class="form-group">
                <label>Mote de pass</label>
                <input class="form-input" type="password" name="password1" id="password1" placeholder="Mote de pass">
            </div>
            <div class="form-group">
                <label>Confirmer Mote de pass</label>
                <input class="form-input" type="password" name="password2" id="password2"
                    placeholder="Confirmer Mot de passe">
            </div>

            <input name="submit" id="btn" type="submit" class="form-btn">
            <div class="group-link">
                <a href="?action=Register_user" class="form-link">compte personnel</a>
                <a href="?action=login" class="form-link">Connexion</a>
            </div>
        </form>
    </div>

    <script src='Public/scripts/Association/register_ass.js'></script>
</body>

</html>