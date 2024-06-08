<?php
class CONTROLLER
{
    public static function Login()
    {
        if (isset($_SESSION["user"])) {
            header("location:?action=Accueil");
        }elseif (isset($_SESSION["ass"])) {
            header("location:?action=Accueil");
        }else return include_once "App/Vue/User_Association/login.php";
    }

    public static function logout()
    {
        $_SESSION = array();
        session_destroy();
        header("location:?action=P_login");
    }

    public static function V_Login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['eng'])) {
                if ($_POST["eng"]=="true") {
                    setcookie("email",$_POST['email'] , time() + 3600 * 24, "/");
                    setcookie("pass",$_POST['pass'] , time() + 3600 * 24, "/");
                }
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $resuser=USER_MODEL::Emailexist($email);
                $resass=ASSOCIATION_MODEL::EmailAsssexist($email);
                if ($resuser->nb!=0) {
                    $passuser=USER_MODEL::Passuser($email);
                    if (password_verify($pass, $passuser->pass)) {
                        $_SESSION["user"]=$passuser->id;
                        $_SESSION["HASH"]=USER_MODEL::GetHash($passuser->id)->HASH_ID;
                        $_SESSION['info']=USER_MODEL::Infouser($_SESSION["HASH"]);
                        echo json_encode(["code"=>2]);
                    }else
                        echo json_encode(["code"=>1]);
                }elseif($resass->nb!=0){
                    $passass=ASSOCIATION_MODEL::PassAss($email);
                    if (password_verify($pass, $passass->pass)) {
                        $_SESSION['info']=ASSOCIATION_MODEL::Info_ass($passass->id);
                        $_SESSION["ass"]=$passass->id;
                        $_SESSION["HASH"]=ASSOCIATION_MODEL::GetHash($passass->id)->HASH_ID;
                        echo json_encode(["code"=>3]);
                    }else
                        echo json_encode(["code"=>1]);
                }else echo json_encode(["code"=>0]);
            }        
        }
    }
    

    public static function Posts()
    {
        //renvoi 10 post
        $debut=$_GET["debut"];
        $fin=$_GET["nb"];
        $post=USER_MODEL::Get_posts($debut,$fin);
        echo json_encode($post);
    }
    public static function getposts_Dec()
    {
        //renvoi 10 post
        $debut=$_GET["debut"];
        $fin=$_GET["nb"];
        $post=ASSOCIATION_MODEL::Get_posts($debut,$fin);
        echo json_encode($post);
    }

    public static function Addcomment(){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_POST["comment"]) && isset($_POST["idp"])) {
                $comment=$_POST["comment"];
                $idpost=$_POST["idp"];
                $HASH=$_SESSION['HASH'];
                $res=USER_MODEL::Addcomment($HASH,$idpost,$comment);
                if ($res) echo json_encode(['res'=>1]);
                else  echo json_encode(['res'=>2]);
            }
        }
    }

    public static function get_comment(){
        if (isset($_GET['idp'])) {
            $idp=$_GET['idp'];
            $res["user"]=USER_MODEL::Commentair_Post_User($idp);
            $res["asso"]=ASSOCIATION_MODEL::Commentair_Post_Ass($idp);
            echo json_encode(['Comment'=>["user"=>$res["user"]["Comments"],"asso"=>$res["asso"]],"nbc"=>$res["user"]["nbc"]]);
        }
    }

    public static function recherchuser()
    {
        $nom = $_GET['nom'];
        $res=[];
        $res["user"]=USER_MODEL::Rcherch_user_nom($nom,$_SESSION['HASH']);
        $res["asso"]=ASSOCIATION_MODEL::Rcherch_Ass_nom($nom,$_SESSION['HASH']);
        echo json_encode($res);
    }

    public static function Message(){
        include ('App/Vue/User_Association/Message.php');
    }

    public static function envoimess(){
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            if (isset($_POST["Destinataire"])&&isset($_POST["Message"])) {
                $idconv=USER_MODEL::get_id_conver($_SESSION["HASH"],$_POST["Destinataire"]) ;
                if (! (bool)$idconv) {
                    $res = USER_MODEL::createConv($_SESSION["HASH"],$_POST["Destinataire"]);
                    if ($res) {
                        $idconv=USER_MODEL::get_id_conver($_SESSION["HASH"],$_POST["Destinataire"]) ;
                    }
                }
                $res =USER_MODEL::creatMessage($idconv->id,$_SESSION["HASH"],$_POST["Destinataire"],$_POST["Message"]);
            }
            if ($res) {
                echo json_encode(['res'=>1]);
            }else echo json_encode(['res'=>2]);
        }
    }

    public static function getDiscussions(){
        $convusers = USER_MODEL::get_convers($_SESSION['HASH']);
        $convass = ASSOCIATION_MODEL::get_convers($_SESSION['HASH']);
        if ((bool) $convusers || (bool) $convass){
            echo json_encode(["res"=>[$convusers,$convass]]);
        }else echo json_encode(["res"=>0]);
    }

    public static function get_suive(){
        $convusers = USER_MODEL::get_suive($_SESSION['HASH']);
        if ((bool) $convusers ){
            echo json_encode(["res"=>$convusers]);
        }else echo json_encode(["res"=>0]);
    }

    public static function get_Message(){
        if ($_SERVER['REQUEST_METHOD']=="GET") {
            if ($_GET['id']) {
                $res=USER_MODEL::get_Message($_GET['id'],$_SESSION['HASH']);
                if ((bool) $res) {
                    echo json_encode(["res"=>$res]);
                }else echo json_encode(["res"=>1]);
            }else echo json_encode(["res"=>0]);
        }
    }

    public static function get_info_user(){
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            if (isset($_POST["HASH"])) {
                $res = USER_MODEL::get_info_user($_POST["HASH"]);
                if ((bool) $res) {
                    $idconv=USER_MODEL::get_id_conver($_POST["HASH"],$_SESSION['HASH']);
                    if ((bool) $idconv) {
                        $res["id"]= $idconv->id;
                    }
                    echo json_encode(["res"=>$res]);
                }else echo json_encode(["res"=>1]);
            }
        }
    }

    public static function get_nb_msg(){
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            if (isset($_POST["idc"])){
                $idc=$_POST["idc"];
                $res = USER_MODEL::get_nb_msg($idc);
                if ((bool) $res) {
                    echo json_encode(["res"=>$res]);
                }
            }
        }
    }

    public static function get_dernier_msg(){
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            if (isset($_POST["idc"]) && isset($_POST["limt"])){
                $idc=$_POST["idc"];
                $limt=$_POST["limt"];
                $res = USER_MODEL::get_dernier_msg($idc,$limt);
                if ((bool) $res) {
                    echo json_encode(["res"=>$res]);
                }
            }
        }
    }

    public static function Get_disparus()
    
    {   
        $HASH=$_SESSION["HASH"]; 
        if((isset($_GET["ASS"]) || isset($_GET["USER"])) && isset($_GET["hash"])){
            $HASH=$_GET["hash"];
            if (isset($_GET["ASS"])) {
                $RES=ASSOCIATION_MODEL::get_indvs($HASH);
                $title = 'Individus';
                $msg="Il n'y a pas d'individus";
                $link="?action=creat_Indi";
            }elseif(isset($_GET["USER"])){
                $RES=USER_MODEL::get_Dispar($HASH);
                $title = 'Disparues';
                $msg ="Il n'y a pas des disparues";
                $link ="?action=creat_desparu";
            }
        }else{
            if (isset($_GET["id"])) {
                $id=$_GET["id"];
                ASSOCIATION_MODEL::delet_Disp($id,$_SESSION['HASH']);
                if (isset($_SESSION['user'])) {
                    header("location:http://localhost/Project/?action=Disparues");
                }else{
                    header("location:http://localhost/Project/?action=Individue");
                }
            }
            
            $msg="";
            if (isset($_SESSION["ass"])) {
                $RES=ASSOCIATION_MODEL::get_indvs($HASH);
                $title = 'Individus';
                $msg="Il n'y a pas d'individus";
                $link="?action=creat_Indi";
            }elseif(isset($_SESSION["user"])){
                $RES=USER_MODEL::get_Dispar($HASH);
                $title = 'Disparues';
                $msg ="Il n'y a pas des disparues";
                $link ="?action=creat_desparu";
            }
        }
        
        
        include_once "./App/Vue/User_Association/Disparue.php";
    }

    public static function creat_desparu()
    {   if (isset($_SESSION["ass"])) {
            $title = 'Individus';
        }elseif(isset($_SESSION["user"])){
            $title = 'Disparues';
        }
        function is_valid_image($file) {
            // Vérifiez si le type de fichier est une image
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            return in_array($file['type'], $allowed_types);
        }
        function upload_image($file) {
            if (isset($_SESSION['user'])) {
                $uploadDirectory = "Files/desparus/";
            }elseif(isset($_SESSION['ass'])){
                $uploadDirectory = "Files/individus/";
            }
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
        if (isset($_POST["sub"])) {
            if (
                isset($_POST["Nom"]) && isset($_POST["Prenom"]) &&
                isset($_POST["Naissance"]) && isset($_POST["dentree"]) &&
                isset($_POST["Villa"])&&isset($_POST["Genner"])
            ) {
                $Nom=$_POST["Nom"];$Prenom=$_POST["Prenom"];$Naissance=$_POST["Naissance"];$dentree=$_POST["dentree"];
                $Villa=$_POST["Villa"];$genner=$_POST["Genner"];
                    
                    $Photo=null;
                    $error=0;
                    if (isset($_FILES["Photo"])) {
                        $uploadedFile = $_FILES["Photo"];
                        if (is_valid_image($uploadedFile)) {
                            if ($uploadedFile['name'] != "" && $uploadedFile['error'] == 0) {
                                $Photo = upload_image($uploadedFile);
                                if ($Photo==null) {$error=2;}
                            }
                        } else $error=3;
                    }else $error=4;
                        if ($error==0 ) {
                            if (isset($_SESSION['user'])) {
                                USER_MODEL::Creat_disparu($Nom,$Prenom,$dentree,$Naissance,$Photo,$Villa,$_SESSION["HASH"],$genner);
                                $disc="Avis de disparition
                                Monsieur/Madame $Nom $Prenom a disparu le $dentree à $Villa. Né(e) le $Naissance. Nous vous prions de nous contacter si vous l'avez vu(e). Merci.";
                                USER_MODEL::Addpost($_SESSION["HASH"],$disc,$Photo);
                                header("location:http://localhost/Project/?action=Disparues");
                                
                            }elseif(isset($_SESSION['ass'])){
                                $nomass=$_SESSION['info']->nom;
                                $disc="Avis de découverte
                                $nomass annonce avoir retrouvé ";
                                if ($Nom!="" || $Prenom!="") $disc.="que M/Mme $Nom $Prenom, ";
                                else $disc.="la personne sur la photo, ";
                                $disc .="le $dentree à $Villa.";
                                if($Naissance != "") $disc.=" Né(e) le $Naissance";
                                $disc.=" Nous invitons toute personne connaissant sa famille à nous contacter. Merci.";
                                USER_MODEL::Addpost($_SESSION["HASH"],$disc,$Photo);
                                ASSOCIATION_MODEL::Creat_indiv($Nom,$Prenom,$dentree,$Naissance,$Photo,$Villa,$_SESSION["HASH"],$genner);
                                header("location:http://localhost/Project/?action=Individue");
                            }
                        }
                
            }else $error=4;
        }
        include_once "./App/Vue/User_Association/Creat_disparu.php";
    }

    public static function Modifier_desp(){
        if (isset($_GET["IDD"])) {
            $Disp=ASSOCIATION_MODEL::info_indiv($_GET["IDD"],$_SESSION["HASH"]);
            if ($Disp) {
                if (isset($_SESSION["user"])) $title="Disparue";
                if (isset($_SESSION["ass"])) $title="Indiv";
                include_once "./App/Vue/User_Association/Edit_disparue.php";
            }else header("location:http://localhost/Project");
        }else header("location:http://localhost/Project");
    }

    public static function Edit_Info_desparu()
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
    
    
    public static function Recherch_desparu() {
        $tablekey=[];
        if (isset($_GET["IDD"])) {
            $Disp=ASSOCIATION_MODEL::info_indiv($_GET["IDD"],$_SESSION["HASH"]);
            $tablekey["nom"]=$Disp->nom;
            $tablekey["prenom"]=$Disp->prenom;
            $tablekey["Gennre"]=$Disp->Gennre;
            
            if(isset($_SESSION["user"])){
                $tablekey["date_disparition"]=$Disp->date_disparition;
                $data=USER_MODEL::Recherch_disparu($tablekey);
            } 
            elseif(isset($_SESSION["ass"])) {
                
                $tablekey["date_entre"]=$Disp->date_entre;
                $data=ASSOCIATION_MODEL::Recherch_disparu($tablekey);
            }
            
        }
        if (isset($_POST["Rechercher"])) {
            if (isset($_POST["Nom"])&& isset($_POST["Prenom"]) &&
                isset($_POST["Gennre"])&& isset($_POST["Daten"])
                && isset($_POST["Ville"])&& isset($_POST["Dated"])
            ) {
                $Nom = htmlspecialchars($_POST["Nom"]);
                $Prenom = htmlspecialchars($_POST["Prenom"]); 
                $Gennre = htmlspecialchars($_POST["Gennre"]) ; 
                $Daten = htmlspecialchars($_POST["Daten"]);
                $Ville = htmlspecialchars($_POST["Ville"]);
                $Dated = htmlspecialchars($_POST["Dated"]);
                
                if(!empty($Nom))    $tablekey["nom"]=$Nom;
                if(!empty($Prenom)) $tablekey["prenom"]=$Prenom;
                if(!empty($Gennre)) $tablekey["Gennre"]=$Gennre;
                if(!empty($Daten))  $tablekey["date_N"]=$Daten;
                if(!empty($Ville))  $tablekey["ville"]=$Ville;
                if(!empty($Dated))  $tablekey["date_disparition"]=$Dated;
                if(count($tablekey)>0) {
                    if(isset($_SESSION["user"])) $data=USER_MODEL::Recherch_disparu($tablekey);
                    elseif(isset($_SESSION["ass"])) $data=ASSOCIATION_MODEL::Recherch_disparu($tablekey);
                }
            }
        }
        include_once "./App/Vue/User_Association/Recherch_disparu.php";
    }

    public static function get_info_disp(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["id"])&&isset($_POST["hash"])) {
                $Disp=ASSOCIATION_MODEL::info_indiv($_POST["id"],$_POST["hash"]);
                echo json_encode(["res"=>$Disp]);
            }elseif(isset($_POST["id"])){
                $Disp=ASSOCIATION_MODEL::info_indiv($_POST["id"]);
                echo json_encode(["res"=>$Disp]);
            }else echo json_encode(["res"=>1]);
        }
    }

    public static function get_info_Di(){
        /*$data=ASSOCIATION_MODEL::get_info_Disp(24);
        echo json_encode(["res"=>$data]);*/
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["id"])) {$Disp=ASSOCIATION_MODEL::get_info_Disp($_POST["id"]);
                echo json_encode(["res"=>$Disp]);
            }
        }
    }

    public static function Pubinfo(){
        $id=$_GET["id"];
        if (isset($_GET["user"])) {
            $hash=$_GET["user"];
        }else{
            $hash=$_SESSION["HASH"];
        }
        $nom="";
        $prenom="";
        $photo="";
        $commente = USER_MODEL::Commentair_Post_User($id,true);
        $user=USER_MODEL::get_user($hash);
        if (!$user) {
            $user=ASSOCIATION_MODEL::get_ass($hash);
        }
        $nom=$user->nom;
        $photo=$user->photo;
        $post = USER_MODEL::Post_User($hash,$id);
        include_once "./App/Vue/User_Association/pubinfo.php";
    }
}   