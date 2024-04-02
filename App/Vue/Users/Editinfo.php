<?php ob_start();?>

    <div class="containerdiv">
        <?php include_once "App/Vue/Users/navprofile.php" ?>
        <div class="content">
            <form id="form_info"  action="" method="post" class="form-info">
                <h3>Modifier info</h3>
                <div class="form-group">
                    <label>nom</label>
                    <input class="form-input" name="nom" type="text" id="nom" placeholder="nom" value="<?=$user->nom ?>">
                </div>
                <div class="form-group">
                    <label>prenom</label>
                    <input class="form-input" name="prenom" type="text" id="prenom" placeholder="prenom" value="<?=$user->prenom ?>">
                </div>
                <div class="form-group">
                    <label>email</label>
                    <input class="form-input" name="email" type="email" id="email" placeholder="Email" value="<?=$user->email ?>">
                </div>
                <div class="form-group">
                    <label>Genner</label>
                    <select class="form-input" name="Genner" id="Genner">
                        <option value="">Genner</option>
                        <option value="H" <?php if($user->genner=="H")echo "selected" ;?>>Homme</option>
                        <option value="F" <?php if($user->genner=="F")echo "selected" ;?>>Famme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mote de pass</label>
                    <input class="form-input" name="pass" type="password" id="pass" placeholder="Mote de pass">
                </div>
        
                <input id="btn" type="submit" name="Modifier" class="form-btn" value="Modifier">
                
                <span id="btn_info" class="form-btn" style="width: 200px;">Change le mote de pass</span>  
            </form>

            <form id="form_pass" style="display: none;" action="" method="post" class="form-info">
                <h3>Change Mote De Pass</h3>
                
                <div class="form-group">
                    <label>Mot de passe actuel</label>
                    <input class="form-input" name="pass" type="password" id="password" placeholder="Mote de pass">
                </div>
                <div class="form-group">
                    <label>nouveau mot de passe</label>
                    <input class="form-input" name="pass1" type="password" id="password1" placeholder="Mote de pass">
                </div>
                <div class="form-group">
                    <label>Confirmation mot de passe</label>
                    <input class="form-input" name="pass2" type="password" id="password2" placeholder="Mote de pass">
                </div>
        
                <input id="btn_subpass" name="Change" type="submit" class="form-btn" value="Change">
                
                <span id="btn_pass" class="form-btn" style="width: 200px;">info personnels</span>  
            </form>
            <?php
            if (isset($error)) {
                switch ($error) {
                    case 1: echo "<script>alert('Les données sont incorrectes.')</script>";break;
                    case 2: echo "<script>alert('Mot de pass incorrectes')</script>";break;
                }
            }
            if (isset($passerore)) {
                switch ($passerore) {
                    case 1: echo "<script>alert('Remplir toutes les données.')</script>";break;
                    case 2: echo "<script>alert('Mot de passe actuel incorrect')</script>";break;
                    case 3: echo "<script>alert('Le nouveau mot de passe est incorrect.')</script>";break;
                }
            }
            ?>
        </div>
    </div>


<?php 
    $content = ob_get_clean();
    $styles = "<link rel='stylesheet' href='Public/styles/Users/Profile.css'>";
    $scripts = "<script src='Public/scripts/Users/Profile.js'></script>";
    $title = 'Profile';
    include_once 'App/Vue/Mastre.php'; 
?>