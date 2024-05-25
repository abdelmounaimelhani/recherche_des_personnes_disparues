<?php
class USER_CONTROLLER{
    public static function creat_user()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (
                isset($_POST["nom"]) && isset($_POST["prenom"]) &&
                isset($_POST["email"]) && isset($_POST["Genner"]) &&
                isset($_POST["Tele"])&&isset($_POST["password1"]) &&
                isset($_POST["password2"])
            ) { 
                $nom=$_POST["nom"];$prenom=$_POST["prenom"];$email=$_POST["email"];$tele=$_POST["Tele"];
                $genner=$_POST["Genner"];$pass1=$_POST["password1"];$pass2=$_POST["password2"];
                if ($_POST["Genner"]== "H") {
                    $photo="http://localhost/Project/Public/imgs/homme.png";
                }elseif($_POST["Genner"]== "F"){
                    $photo="http://localhost/Project/Public/imgs/femme.png";
                }
                if (
                    !empty($nom)&&!empty($prenom)&&!empty($email)&&
                    !empty($genner)&&!empty($pass1)&&!empty($pass2)&&
                    !empty($tele)&& $pass1==$pass2
                ) {
                    $res=USER_MODEL::Emailexist($email);
                    if ($res->nb==0) {
                        $passw=password_hash($pass1, PASSWORD_DEFAULT);
                        USER_MODEL::Register($nom,$prenom,$email,$genner,$passw,$tele ,$photo);
                        $res=USER_MODEL::Emailexist($email);
                        if ($res->nb!=0) {
                            echo json_encode(["code"=>0]);
                        }else  echo json_encode(["code"=>4]);
                    }else  echo json_encode(["code"=>3]);
                }else  echo json_encode(["code"=>2]);
            }else  echo json_encode(["code"=>1]);
        }
    }

    public static function Register()
    {   
        if (isset($_SESSION["user"])) {
        header("location:?action=Accueil");
        }else
            include_once "App/Vue/Users/register.php";
    }

    public static function Profile()
    {
        
        if (isset($_GET['hash'])) {
            $id=$_GET['hash'];
            $user=USER_MODEL::Infouser($id);
        }else{
            $id=$_SESSION['HASH'];
            $user=USER_MODEL::Infouser($id);
            if (isset($_POST["Modifier"])) {
    
                if (
                    isset($_POST["nom"]) && isset($_POST["prenom"]) &&
                    isset($_POST["email"]) && isset($_POST["Genner"]) &&
                    isset($_POST["pass"]) && isset($_POST["Tele"]) && isset($_POST["Ville"])
                ) {
                    $nom=$_POST["nom"];$prenom=$_POST["prenom"];$email=$_POST["email"];
                    $genner=$_POST["Genner"];$pass=$_POST["pass"];$tele=$_POST["Tele"];$Ville=$_POST["Ville"];
                    if (
                        !empty($nom)&&!empty($prenom)&&!empty($email)&&
                        !empty($genner)&&!empty($pass)&&!empty($tele)&&!empty($Ville)
                    ){
                        $hash=USER_MODEL::Verifierpass($user->id)->pass;
                        if (password_verify($pass,$hash)) {
                            $res=USER_MODEL::Editeuser($nom,$prenom,$email,$genner,$user->id,$tele,$Ville);
                            $user=USER_MODEL::Infouser($id);
                            if ($res) {
                                echo "<script>alert('Les informations sont modifiées.')</script>";
                            }else{
                                echo "<script>alert('Échec de la modification des informations.')</script>";
                            }
                        }else echo "<script>alert('Le Mot de pass est incorect')</script>";
                    }else echo "<script>alert('Remplier Tout Les Donnes est incorect')</script>";
                }else echo "<script>alert('Échec de la modification Les Donnes est incorect.')</script>";
            }

            if (isset($_POST["Change"])) {
                if (isset($_POST["pass"]) && isset($_POST["pass1"]) && isset($_POST["pass2"])){
                    $pass=$_POST["pass"];$pass1=$_POST["pass1"];$pass2=$_POST["pass2"];
                    if (!empty($pass)&&!empty($pass1)&&!empty($pass2)){
                        $passhash=USER_MODEL::Verifierpass($id)->pass;
                        if (password_verify($pass,$passhash)) {
                            if ($pass1==$pass2) {
                               $respass=USER_MODEL::UpdateUserPassword(password_hash($pass1,PASSWORD_DEFAULT),$id);
                                if ($respass) {
                                    echo "<script>alert('Le mot de pass est modifiées.')</script>";
                                }else{
                                    echo "<script>alert('Échec de la modification de Mot de Pass.')</script>";
                                }
                            }else echo "<script>alert('Le Neveu mot de pass incorect .')</script>";
                        }else echo "<script>alert('Votre Mot de pass incorrect.')</script>";
                    }else echo "<script>alert('remplier tout les chompe.')</script>";
                }else echo "<script>alert('remplier tout les chompe.')</script>";
            }
        }
        
        
        $user=USER_MODEL::Infouser($id);
        if ((bool) $user) {
            include_once "App/Vue/Users/Profile.php";
        }
    }

    public static function Publication()
    {
        function is_valid_image($file) {
            // Vérifiez si le type de fichier est une image
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            return in_array($file['type'], $allowed_types);
        }
        function upload_image($file) {
            $uploadDirectory = "Files/Posts/";
            // Extraire l'extension du fichier
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
            // Générer un nom de fichier unique avec l'extension
            $unique_name = uniqid(date("dmyHis")."_") . "." . $extension;
            $destination_path = $uploadDirectory . $unique_name;
        
            // Déplacer le fichier vers le répertoire de destination
            if (move_uploaded_file($file["tmp_name"], $destination_path)) {
                return $destination_path;  // Retourner le chemin du fichier téléchargé
            } else {
                return null;  // Retourner faux si le téléchargement échoue
            }
        }
        
        if (isset($_POST["post"])) {
            if (isset($_POST["disc"]) || isset($_FILES["image"])) {
                $disc=null;
                $path=null;
                $uploadedimg=true;
                if (isset($_POST["disc"])) {
                    $disc=htmlspecialchars($_POST['disc']);
                }
                if (isset($_FILES["image"])) {
                    $uploadedFile = $_FILES["image"];

                    if (is_valid_image($uploadedFile)) {
                        if ($uploadedFile['name'] != "" && $uploadedFile['error'] == 0) {
                            $path = upload_image($uploadedFile);
                            if ($path!=null) {
                                $uploadedimg=true;
                            } else $uploadedimg=false;
                        }
                    } else $error=4; 
                }

                if ($disc!=null || $path!=null ) {
                    if ($uploadedimg) { 
                        USER_MODEL::Addpost($_SESSION['HASH'],$disc,$path);
                        $_POST=array ();
                    }else $error=3;
                    
                }else $error=2;

            }else$error=1;
        }
        $posts=USER_MODEL::All_Post_User($_SESSION['HASH']);
        
        include_once "./App/Vue/Users/Publication.php";
    }

    public static function Delet_Pub()
    {
        if (isset($_GET['id'])) {
            $id=htmlspecialchars($_GET['id']);
            $res=USER_MODEL::Delet_Post_User($id,$_SESSION['HASH']);
            header('location:index.php?action=Pub');
        }
    }


    
    public static function usersuive(){
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['id'])) {
                $res=USER_MODEL::usersuive($_POST['id'],$_SESSION['HASH']);
                if (count($res)>0) {
                    echo json_encode(["res"=>1]);
                }else echo json_encode(["res"=>0]);
            }else echo json_encode(["res"=>2]);
        }
    }
    public static function toggleusersuivi(){
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['id'])&&isset($_POST['type'])) {
                if ($_POST['type']=='user' || $_POST['type']=='ass') {
                    $res=USER_MODEL::usersuive($_POST['id'],$_SESSION['HASH']);
                    if (count($res)>0) {
                        $res=USER_MODEL::Deletsersuive($_POST['id'],$_SESSION['HASH']);
                        if ($res) echo json_encode(["res"=>0]);
                    }else {
                        $res=USER_MODEL::Addusersuive($_POST['id'],$_SESSION['HASH']);
                        if ($res) echo json_encode(["res"=>1]);
                    }
                }else echo json_encode(["res"=>2]);
            }else echo json_encode(["res"=>2]);
        }
    }
    public static function nom(){

    }
}