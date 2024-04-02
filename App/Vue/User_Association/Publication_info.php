<?php ob_start();    include_once('App/Vue/User_Association/nav.php');?>

<div class="containerdiv">
    <div class="Post">
        <label><?=$post->datepub?></label>
        <?php if($post->discription!=null): ?>

        <div class="post_disc">
            <?=$post->discription ?>
        </div>
        <?php endif;
            if($post->photo!=null):
        ?>

        <img src="<?=$post->photo?>" class="post_img">
        <?php endif?>

    </div>

    <div class="comments">
        <label>Comment</label>
        <hr>
        

        <?php if ((bool) $comments) 
        for ($i=0; $i <2 ; $i++) :
            foreach ($comments[$i] as $comment):
                if ($i==0) {
                    $Data=User_model::Infouser_comment($comment->HASH);
                    $nom=$Data->nom.' '.$Data->prenom;
                }
                else {
                    $Data=ASSOCIATION_MODEL::Infoass_comment($comment->HASH);
                    $nom=$Data->nom;
                }
            ?>
            <div class="comment">
                <div class="info">
                        <img src="<?= $Data->photo ?>" alt="" class="comment_img">
                        <div>
                            <a href="<?=$Data->HASH_ID?>"  class="comment_info"><?=$nom?></a>
                            <label class="datecomment"><?= $comment->date_comment?></label>
                        </div>
                        <?php if ($Data->HASH_ID==$_SESSION['HASH'] || $_GET["user"]==$_SESSION['HASH']) :
                            ?>
                            
                            <a onclick="confirm('Suppremer le Commentaire')" href=<?="?action=Pubinfo&id=$_GET[id]&user=$_GET[user]&type=delet&idc=$comment->id"?>><img class="delet-icon" src="Public/imgs/delete.png" alt=""></a>
                        <?php endif; ?>
                </div>
                    <div class="comment_disc"><?=$comment->discription ?></div>
            </div>
        
        <?php endforeach;
        endfor;

            else echo "<div class='comment_disc'>IL ne pas des Comment</div>"
        ?>
        
    </div>
    
</div>

<?php
    $content = ob_get_clean();
    $styles = "
        <link rel='stylesheet' href='Public/styles/User_Association/header.css'>
        <link rel='stylesheet' href='Public/styles/Users/Publication_info.css'>
    ";
    $scripts = "<script src='Public/scripts/User_Association/header.js'></script>";
    $title = 'Accueil';
    
    include_once 'App/Vue/Mastre.php'; 
?>