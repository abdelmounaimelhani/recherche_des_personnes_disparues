<?php ob_start();?>
<div class="containerdiv">
    <div class="bg_img"></div> 
    <form id="form_register" action="" method="post" class="form-register">
        <h1>créer compte personnel</h1>
        <div class="div_valid" id="div_valid"></div>
        <div class="error" id="error"></div>
        <div class="form-group">
            <label>nom</label>
            <input class="form-input" type="text" name="nom" id="nom" placeholder="nom">
        </div>
        <div class="form-group">
            <label>prenom</label>
            <input class="form-input" type="text" name="prenom" id="prenom" placeholder="prenom">
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
            <label>Genner</label>
            <select class="form-input" name="Genner" id="Genner">
                <option value="" disabled selected>Genner</option>
                <option value="H">Homme</option>
                <option value="F">Famme</option>
            </select>
            <img class="img-select"  src="Public/imgs/arrow.png">
        </div>
        <div class="form-group">
            <label>Mote de pass</label>
            <input class="form-input" type="password" name="password1" id="password1" placeholder="Mote de pass">
        </div>
        <div class="form-group">
            <label>Confirmer Mote de pass</label>
            <input class="form-input" type="password" name="password2" id="password2" placeholder="Confirmer Mot de passe">
        </div>

        <input name="submit" id="btn" type="submit" class="form-btn">
        <div class="group-link">
            <a href="?action=Register_ass" class="form-link">Compte Association</a>
            <a href="?action=login" class="form-link">Connexion</a>
        </div>
    </form>
</div>
<?php 
    $content = ob_get_clean();
    $styles = "<link rel='stylesheet' href='Public/styles/Users/register.css'>";
    $scripts = "<script src='Public/scripts/Users/register.js'></script>";
    $title = 'inscription';
    include_once 'App/Vue/Mastre.php'; 
?>
