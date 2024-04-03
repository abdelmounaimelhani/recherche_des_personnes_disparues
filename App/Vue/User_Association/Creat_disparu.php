<?php ob_start(); ?>
<?php
    if (isset($error)) {
      switch ($error) {
          case 1: echo "<script>alert('L'individu a été ajouté')</script>";break;
          case 2: echo "<script>alert('Erreur de chargement de l'image')</script>";break;
          case 3: echo "<script>alert('Erreur Type de fichier invalide S'il vous plaît, saisissez une image. (png jpeg) ')</script>";break;
          case 4: echo "<script>alert('Erreur Vérifiez que toutes les données ont été remplies')</script>";break;
      }
  }
?>
<div class="row mt-5">
    <div class="col-12">
      <div class="card bg-gray-600 mb-4">
        <div class="card-header  bg-gray-600 pb-0">
          <h6 class="text-white">Ajouter <?=$title?></h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <form action="" method="post" enctype="multipart/form-data">
              <tbody>
                <tr>
                  <td>
                    <div class="col-10 d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm text-white">Nom</h6>
                      <input placeholder="Nom" name="Nom" type="text"  class="form-control">
                    </div>
                </td>
                  <td>
                      <div class="col-10 d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-white">Prenom</h6>
                        <input placeholder="Prenom" name="Prenom" type="text" class="form-control">
                      </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="col-10 d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm text-white">Date Naissance</h6>
                      <input name="Naissance" type="date" class="form-control">
                    </div>
                </td>
                <td>
                  <div class="col-10 d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm text-white">Date d'entrée</h6>
                    <input name="dentree" type="date" class="form-control">
                  </div>
                </td>
                  
                </tr>
                <tr>
                  <td>
                    <div class="col-10 d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm text-white">Genner</h6>
                      <select name="Genner" class="form-select" id="">
                        <option value="H">Homme</option>
                        <option value="F">Famme</option>
                      </select>
                    </div>
                </td>
                <td>
                  <div class="col-10 d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm text-white">Ville</h6>
                    <input type="text" placeholder="Ville" name="Villa" class="form-control">
                  </div>
                </td>
                  
                </tr>
                <tr>
                  <td>
                    <div class="col-10 d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm text-white">Photo</h6>
                      <input type="file" name="Photo" class="form-control">
                    </div>
                  </td>
                  <td>
                    <div class="col-10 d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm text-white">Enregistrer</h6>
                      <input type="submit" name="sub" value="Ajouter"  class="btn btn-primary">
                    </div>
                  </td>
                </tr>
              </tbody>
              </form>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<?php 
    $content = ob_get_clean();
    if (isset($_SESSION['user'])) {
        $title = 'Ajouter Disparue';
    }elseif(isset($_SESSION['ass'])){
        $title = 'Ajouter individue';
    }
    
    include_once 'App/Vue/Mastre.php'; 
?>