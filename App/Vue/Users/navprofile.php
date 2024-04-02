<div class="div-ifo">
    <div class="image-div">
        <img src="<?= $user->photo ?>" class="image" alt="">
    </div>
    <div class="info">
        <span><?= $user->prenom ?></span>
        <span><?= $user->nom ?></span>
    </div>
    <hr>
    <div class="nav">
        <ul class="nav-ul">
            <li><a href="?action=Editinfo" class="nav-link">Modifier info</a></li>
            <li><a href="?action=Pub" class="nav-link">Mes publications</a></li>
            <li><a href="#" class="nav-link">Suivre</a></li>
            <li><a href="?action=Accueil" class="nav-link">Accueil</a></li>
        </ul>
    </div>
</div>