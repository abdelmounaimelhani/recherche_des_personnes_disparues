<div class="div-ifo">
    <div class="image-div">
        <img src="Public/imgs/Profile.png" class="image" alt="">
    </div>
    <div class="info">
        <span><?= $user->prenom ?></span>
        <span><?= $user->nom ?></span>
    </div>
    <hr>
    <div class="nav">
        <ul class="nav-ul">
            <li><a href="?action=Editinfo" class="nav-link">Modifier info</a></li>
            <li><a href="#" class="nav-link">Les publications</a></li>
            <li><a href="#" class="nav-link">Les Declaration</a></li>
            <li><a href="?action=Accueil" class="nav-link">Accueil</a></li>
        </ul>
    </div>
</div>