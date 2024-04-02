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

    public static function Edit_Association()
    {
        $id=$_SESSION['user'];
        
        if (isset($_POST["Modifier"])) {
            if (
                isset($_POST["nom"]) && isset($_POST["prenom"]) &&
                isset($_POST["email"]) && isset($_POST["Genner"]) &&
                isset($_POST["pass"])
            ) {
                $nom=$_POST["nom"];$prenom=$_POST["prenom"];$email=$_POST["email"];
                $genner=$_POST["Genner"];$pass=$_POST["pass"];
                if (
                    !empty($nom)&&!empty($prenom)&&!empty($email)&&
                    !empty($genner)&&!empty($pass)
                ){
                    $hash=USER_MODEL::Verifierpass($id)->pass;
                    if (password_verify($pass,$hash)) {
                        $res=USER_MODEL::Editeuser($nom,$prenom,$email,$genner,$id);
                        if ($res) {
                            echo "<script>alert('Les informations sont modifiées.')</script>";
                        }else{
                            echo "<script>alert('Échec de la modification des informations.')</script>";
                        }
                    }else $error=2;
                }else $error=1;
            }else $error=1;
        }
        
        if (isset($_POST["Change"])) {
            if (isset($_POST["pass"]) && isset($_POST["pass1"]) && isset($_POST["pass2"])){
                $pass=$_POST["pass"];$pass1=$_POST["pass1"];$pass2=$_POST["pass2"];
                if (!empty($pass)&&!empty($pass1)&&!empty($pass2)){
                    $hash=USER_MODEL::Verifierpass($id)->pass;
                    if (password_verify($pass,$hash)) {
                        if ($pass1==$pass2) {
                           $respass=USER_MODEL::UpdateUserPassword(password_hash($pass1,PASSWORD_DEFAULT),$id);
                            if ($respass) {
                                echo "<script>alert('Le mot de pass est modifiées.')</script>";
                            }else{
                                echo "<script>alert('Échec de la modification de Mot de Pass.')</script>";
                            }
                        }else $passerore=3;
                    }else $passerore=2;
                }else $passerore=1;
            }else $passerore=1;
        }        
        $user=USER_MODEL::Infouser($id);
        include_once "App/Vue/Users/Editinfo.php";
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

    public static function Edit_Info_Individus()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["Dateen"]) && isset($_POST["Prenom"]) && isset($_POST["Villa"])&&isset($_POST["datenai"])&&isset($_POST["nom"])&&isset($_POST["indv"])) {
                if (!empty($_POST["Dateen"]) && !empty($_POST["Prenom"]) && !empty($_POST["Villa"])&&!empty($_POST["datenai"])&&!empty($_POST["nom"])&&!empty($_POST["indv"])) {
                    $Dateen = DateTime::createFromFormat('Y-m-d', $_POST["Dateen"]);
                    $datenai = DateTime::createFromFormat('Y-m-d', $_POST["datenai"]);
                    if ($datenai != false && $Dateen!=false) {
                        $id=$_POST["indv"];
                        $asso=$_SESSION["ass"];
                        $res=ASSOCIATION_MODEL::info_indiv($id,$asso);
                        if ((bool) $res) {
                            $res=ASSOCIATION_MODEL::edite_indiv($_POST["nom"],$_POST["Prenom"],$_POST["Dateen"],$_POST["datenai"],$_POST["Villa"],$id,$asso);
                            if ($res) {
                                echo json_encode(["code"=>0]);
                            }else echo json_encode(["code"=>5]);
                        }else echo json_encode(["code"=>4]);
                    }else echo json_encode(["code"=>3]);
                }else echo json_encode(["code"=>2]);
            }else echo json_encode(["code"=>1]);
        }
    }

    public static function Delet_Individus()
    {
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            
            if (isset($_POST['idin'])) {
                if (!empty($_POST['idin']) && is_numeric($_POST['idin'])) {
                    $id=$_POST["idin"];
                    $asso=$_SESSION["ass"];
                    $res=ASSOCIATION_MODEL::info_indiv($id,$asso);
                    if ((bool) $res) {
                        ASSOCIATION_MODEL::delet_indiv($id,$asso);
                        $res=ASSOCIATION_MODEL::info_indiv($id,$asso);
                        if (!(bool) $res) {
                            echo json_encode(["code"=>0]);
                        }else echo json_encode(["code"=>1]);
                    }else echo json_encode(["code"=>2]);
                }else echo json_encode(["code"=>1]);
            }else echo json_encode(["code"=>1]);
        }else header("location:http://localhost/Project/?action=Accueil");
    }
}
