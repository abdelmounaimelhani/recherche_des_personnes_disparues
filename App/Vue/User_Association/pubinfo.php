<?php ob_start();?>
<div class="row bg-white rounded-2">
    <div class="col-12 d-flex justify-content-between">
        <div class="card col-6">
            <div class="card-header p-3 ">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="<?=$photo?>" class="avatar" alt="">
                    <div class="ms-2">
                    
                        <a href="?action=Profile&hash=<?=$hash?>" class="text-xs"><?=$nom." ".$prenom?></a>
                        <p class="text-xxs"><?=$post->datepub?></p>
                    </div>
                </div>
            </div>
            <div>
                <p class="max-height-100 overflow-auto"><?=$post->discription?></p>
                <img class="card-img d-block m-auto max-width-300 max-height-400" src="<?=$post->photo?>" alt="">
            </div>
        </div>
        <div class="card col-5 p-2 max-height-500 min-height-500 overflow-auto">
            <?php if ($commente) :?>
            <?php foreach($commente as $C): ?>
            <div>
                <div class="card-header p-3 ">
                    <div class="d-flex justify-content-start  align-items-center">
                        <img src="Files/desparus/050624100035_66601b23362e0.jpg" class="avatar" alt="">
                        <div class="ms-2">
                            <a href="" class="text-xs"><?=$C->nom." ".$C->prenom?> </a>
                            <p class="text-xxs"><?=$C->date_comment?></p>
                        </div>
                    </div>
                </div>
                <p class="max-height-100 overflow-auto ps-3 text-sm" ><?=$C->discription?></p>
            </div>
            <hr>
            <?php endforeach ?>
            <?php endif;if (!$commente): ?>
                <div class="text-center">
                    Il ne pas des Resultat
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?php
    $content = ob_get_clean();
   
    $title = 'information de Annonce';
    
    include_once 'App/Vue/Mastre.php'; 
?>