<?php 
class ASSOCIATION_CONTROLLER 
{
    //les functions des Association
    public static function Creat_association()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             
            if (
                isset($_POST["nom"]) && isset($_POST["ville"]) &&
                isset($_POST["email"]) && isset($_POST["adress"]) &&
                isset($_POST["Tele"])&&isset($_POST["password1"]) &&
                isset($_POST["password2"])
            ) {
                $nom=$_POST["nom"];$ville=$_POST["ville"];$email=$_POST["email"];$tele=$_POST["Tele"];
                $adress=$_POST["adress"];$pass1=$_POST["password1"];$pass2=$_POST["password2"];
                $photo="http://localhost/Project/Public/imgs/association.png";
                if (
                    !empty($nom)&&!empty($ville)&&!empty($email)&&
                    !empty($adress)&&!empty($pass1)&&!empty($pass2)&&
                    !empty($tele)&& $pass1==$pass2
                ) {
                    $res=ASSOCIATION_MODEL::EmailAsssexist($email);
                    if ($res->nb==0) {
                        $passw=password_hash($pass1, PASSWORD_DEFAULT);
                        ASSOCIATION_MODEL::Creat_association($nom,$email,$tele,$ville,$adress,$passw,$photo);
                        $rese=ASSOCIATION_MODEL::EmailAsssexist($email);
                        if ($rese->nb!=0) {echo json_encode(["code"=>0]);}
                        else  echo json_encode(["code"=>4]);
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
            include_once "App/Vue/Association/register_ass.php";
    }
    //les functions des Individus
       
    public static function Get_Info_Individus()
    {
        if (isset($_GET["indv"])) {
            $idind=$_GET["indv"];
            $idass=$_SESSION["ass"];
            $res=ASSOCIATION_MODEL::info_indiv($idind,$idass);
            if ((bool) $res) {
                include_once "App/Vue/Association/info_indiv.php";
            }else header('location:http://localhost/Project/?action=individus');
        }
    }



    public static function Profile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["hash"])) {
            $ass=ASSOCIATION_MODEL::get_ass($_GET["hash"]);
        }elseif(isset($_SESSION["ass"]) ){
            $id=$_SESSION['ass'];
            
            if (isset($_POST["Modifier"])) {
    
                if (
                    isset($_POST["Nom"]) && isset($_POST["email"]) && isset($_POST["Adress"]) &&
                    isset($_POST["pass"]) && isset($_POST["Tele"]) && isset($_POST["Ville"])
                ) {
                    $nom=$_POST["Nom"];$email=$_POST["email"];$Adress=$_POST["Adress"];
                    $pass=$_POST["pass"];$tele=$_POST["Tele"];$Ville=$_POST["Ville"];
                    if (
                        !empty($nom)&&!empty($email)&&!empty($Adress)
                        &&!empty($pass)&&!empty($tele)&&!empty($Ville)
                    ){
                        $hash=ASSOCIATION_MODEL::Info_ass($id)->pass;
                        if (password_verify($pass,$hash)) {
                            $res=ASSOCIATION_MODEL::Editeass($nom,$email,$Adress,$tele,$Ville);
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
                        $hash=ASSOCIATION_MODEL::Info_ass($id)->pass;
                        if (password_verify($pass,$hash)) {
                            if ($pass1==$pass2) {
                               $respass=ASSOCIATION_MODEL::UpdateassPassword(password_hash($pass1,PASSWORD_DEFAULT),$id);
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
            $ass=ASSOCIATION_MODEL::Info_ass($id);
        }
            
        include_once "App\Vue\Association\Profile.php";
    }
}