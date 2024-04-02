<?php ob_start();
    if (isset($error)) {
        switch ($error) {
            case 1: echo "<script>alert('Les données sont incorrectes.')</script>";break;
            case 2: echo "<script>alert('Saisissez la description ou bien une photo.')</script>";break;
            case 3: echo "<script>alert('Échec de l'enregistrement de l'image.')</script>";break;
            case 4: echo "<script>alert('Type de fichier invalide. S'il vous plaît, saisissez une image. (png jpeg)')</script>";break;

        }
    }
?>

<div class="row">
        <form action="" method="post" enctype="multipart/form-data"  class="bg-body rounded-3 p-2">
            <h4 class="text-primary">Ajouter Post</h4>
            <label for="Desc" class="fs-6 text-body">Description</label>
            <input id="Desc" name="disc" type="text" class="form-control">
            <label for="" class="fs-6 text-body">Photo</label>
            <div class="d-flex">
                <div class="col-4">
                    <input name="image" type="file" class="form-control">
                </div>
                <input type="submit" name="post" value="Ajouter" class="btn btn-dark ms-4">
            </div>
        </form>
      </div>
      <div class="row mt-4 ps-8">
        <?php foreach($posts as $post): ?>
        <div class="card col-3 m-4">
            <div class="mb-3">
                <label for=""><?=$post->datepub?></label>
            </div>
            
              <?php if($post->photo != null){?>
              <div class="height-300 mb-4">
                <p class="max-height-100 overflow-auto"><?=$post->discription?></p>
                <img src="<?=$post->photo?>" class="max-height-200 d-block mx-auto rounded-2" alt="">
                <?php }else{?>
                  <div class="height-300 d-flex align-items-center mb-4">
                    <p class="max-height-300 overflow-auto"><?=$post->discription?></p>
                <?php } ?>
              </div>
            <div class="d-flex justify-content-around">
                <a class="btn btn-danger">delet</a>
                <a class="btn btn-danger">Commentairs</a>
            </div>
        </div>
        <?php endforeach?>
      </div>

<?php 
    $content = ob_get_clean();
    
    $title = 'Publication';
    include_once 'App/Vue/Mastre.php'; 
?>