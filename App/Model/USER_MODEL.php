<?php
class USER_MODEL{

    public static function GetHash($id){
        $conn=Connexion::Connexion();
        $st=$conn->prepare("SELECT * FROM user_hash WHERE `id-user` = ? ");
        $st->bindParam(1,$id,PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function Check_Hach($hash){
        $conn=Connexion::Connexion();
        $st=$conn->prepare("SELECT * FROM user_hash WHERE HASH_ID = ? ");
        $st->bindParam(1,$hash,PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function Emailexist($email){
        //Vérifier l'existence d'une adresse e-mail.
        $st = Connexion::Connexion()->prepare("SELECT count(*) as 'nb' FROM userTable WHERE email=? ");
        $st->bindParam(1, $email,PDO::PARAM_STR);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }
    public static function Passuser($email){
        //Vérifier l'existence d'une adresse e-mail.
        $st = Connexion::Connexion()->prepare("SELECT pass , id FROM userTable WHERE email=? ");
        $st->bindParam(1, $email,PDO::PARAM_STR);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Register($nom, $prenom, $email, $gender, $pass,$tele , $photo) {
        //Créer un compte.
        $st = Connexion::Connexion()->prepare("INSERT INTO userTable VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);");
        $st->bindParam(1, $nom);
        $st->bindParam(2, $prenom);
        $st->bindParam(3, $gender);
        $st->bindParam(4, $email);
        $st->bindParam(5, $pass);
        $st->bindParam(6, $tele);
        $st->bindParam(7, $photo);
        $res = $st->execute();
        return $res;
    }
    
    public static function Login($email,$pass){
        //Connexion::Connexionn à un compte.
        $st = Connexion::Connexion()->prepare("SELECT id FROM userTable WHERE email=? and pass=? ");
        $st->bindParam(1, $email);
        $st->bindParam(2, $pass);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    } 

    public static function Infouser($id){
        //Récupérer les informations d'un utilisateur.
        $st = Connexion::Connexion()->prepare("SELECT * FROM userTable WHERE id=?");
        $st->bindParam(1, $id,PDO::PARAM_STR);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Verifierpass ($id){
        //Vérifier le mot de passe.
        $st = Connexion::Connexion()->prepare("SELECT pass FROM userTable WHERE id=? ");
        $st->bindParam(1, $id);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Editeuser($nom, $prenom, $email, $gender, $id ,$tele,$Ville){
        //Modifier les informations d'un utilisateur.
        $st = Connexion::Connexion()->prepare("UPDATE usertable SET nom = ? ,prenom = ? ,genner=? ,email =? ,tele=? ,Ville=? WHERE id = ? ;");
        $st->bindParam(1, $nom);
        $st->bindParam(2, $prenom);
        $st->bindParam(3, $gender);
        $st->bindParam(4, $email);
        $st->bindParam(5, $tele);
        $st->bindParam(6, $Ville);
        $st->bindParam(7, $id);
        
        $res = $st->execute();
        return $res;
    }

    public static function UpdateUserPassword($pass,$id){
        //Modifier le mote de pass
        $st = Connexion::Connexion()->prepare("UPDATE usertable SET pass = ? WHERE id = ? ;");
        $st->bindParam(1, $pass);
        $st->bindParam(2, $id);
        $res = $st->execute();
        return $res;
    }

    public static function Addpost($id,$disc,$photo){
        //Ajouter un Post
        $st = Connexion::Connexion()->prepare("INSERT INTO `publication` (`id`, `HASH`, `discription`, `photo`, `datepub`) VALUES (NULL, ?, ?, ?, current_timestamp());");
        $st->bindParam(1, $id);
        $st->bindParam(2, $disc);
        $st->bindParam(3, $photo);
        $res = $st->execute();
        return $res;
    }

    public static function All_Post_User($HASH){
        $st = Connexion::Connexion()->prepare("SELECT * FROM publication WHERE `HASH`=? ORDER BY datepub DESC ");
        $st->bindParam(1, $HASH);
        $st->execute();
        $res=$st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Post_User($HASH,$idP){
        $st = Connexion::Connexion()->prepare("SELECT * FROM publication WHERE `HASH`=? AND id=? ");
        $st->bindParam(1, $HASH);
        $st->bindParam(2, $idP);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }
    public static function Delet_Post_User($idP,$HASH){
        $st = Connexion::Connexion()->prepare("DELETE FROM `publication` WHERE id = ? AND `HASH` = ? ");
        $st->bindParam(1, $idP);
        $st->bindParam(2, $HASH);
        return $st->execute();
    }

    public static function Infouser_comment($HASH){
        //Récupérer les informations d'un utilisateur.
        $st = Connexion::Connexion()->prepare(
            "SELECT nom,prenom , HASH_ID,photo FROM usertable u , user_hash uh 
            WHERE u.id=uh.`id-user` and HASH_ID=?"
        );
        $st->bindParam(1, $HASH,PDO::PARAM_STR);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Addcomment($HASH,$idpost,$comment){
        $st = Connexion::Connexion()->prepare("INSERT INTO publication_comment (`HASH`,id_publication,discription) VALUES(?,?,?)");
        $st->bindParam(1, $HASH,PDO::PARAM_STR); 
        $st->bindParam(2, $idpost,PDO::PARAM_STR); 
        $st->bindParam(3, $comment,PDO::PARAM_STR); 
        return $st->execute();
    }

    public static function check_comment($HASH,$idC){
        $st = Connexion::Connexion()->prepare(
            "SELECT count(*) as 'nb' FROM publication_comment pc,publication p 
            WHERE pc.id_publication=p.id AND p.HASH=? AND pc.id=?"
            );
        $st->bindParam(1, $HASH,PDO::PARAM_STR); 
        $st->bindParam(2, $idC,PDO::PARAM_STR); 
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }



    public static function Suppcomment($idcomment,$HASH=null){
        if (is_null($HASH)) {
            $st = Connexion::Connexion()->prepare("DELETE FROM publication_comment WHERE `publication_comment`.`id` = ? ");  
        }else {
            $st = Connexion::Connexion()->prepare("DELETE FROM publication_comment WHERE `publication_comment`.`id` = ? AND `publication_comment`.HASH=? ");
            $st->bindParam(2, $HASH,PDO::PARAM_STR);
        }
        $st->bindParam(1, $idcomment,PDO::PARAM_STR);
        return $st->execute();
    }

    public static function Commentair_Post_User($idP,$nbc=null){
        $st2 = Connexion::Connexion()->prepare(
            "SELECT p.*,u.nom,u.prenom FROM publication_comment p , usertable u ,user_hash uh
            WHERE u.id=uh.`id-user` AND uh.HASH_ID=p.`HASH` AND id_publication = ?
            ORDER BY p.date_comment DESC"
        );
        $st2->bindParam(1, $idP);
        $st2->execute();
        if (is_null($nbc)) {
            $st1 = Connexion::Connexion()->prepare("SELECT count(*) as nbC FROM `publication_comment` WHERE id_publication = ? ");
            $st1->bindParam(1, $idP);
            $st1->execute();
            $res = ['nbc'=>$st1->fetch(PDO::FETCH_OBJ),'Comments'=>$st2->fetchAll(PDO::FETCH_OBJ)];
        }else $res= $st2->fetchAll(PDO::FETCH_OBJ);
        return $res;

    }


    public static function Rcherch_user_nom($nom,$HASH){
        if (!empty($nom)) { 
            $st = Connexion::Connexion()->prepare(
                "SELECT HASH_ID,nom,prenom,photo FROM `usertable` u, user_hash uh
                WHERE id=`id-user` AND HASH_ID <> :HASH_ID  AND concat(nom, ' ', prenom) LIKE :nom"
                );
            $nomParam = '%' . $nom . '%';
            
            $st->bindValue(':nom', $nomParam, PDO::PARAM_STR);
        }else $st=Connexion::Connexion()->prepare(
            "SELECT HASH_ID,nom,prenom,photo FROM `usertable` u, user_hash uh
            WHERE id=`id-user` AND HASH_ID <> :HASH_ID LIMIT 10"
            );
        $st->bindValue(':HASH_ID', $HASH, PDO::PARAM_STR);
        $st->execute();
        $res=$st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    
    public static function Get_posts($debut, $fin) {
        $st = Connexion::Connexion()->prepare(
            "SELECT p.* ,nom,prenom,u.photo as 'userphoto' 
            FROM publication p ,usertable u ,user_hash uh 
            WHERE p.HASH=uh.HASH_ID AND uh.`id-user`=u.id 
            ORDER BY datepub DESC LIMIT :debut, :fin"
            );

        $st->bindParam(':debut', $debut, PDO::PARAM_INT);
        $st->bindParam(':fin', $fin, PDO::PARAM_INT);
        $st->execute();
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    
    public static function get_suive($hash){
        $st = Connexion::Connexion()->prepare(
            "SELECT uh.HASH_ID,CONCAT(us.nom,' ',us.prenom) AS 'nom',us.photo 
            FROM table_suivi u ,user_hash uh,usertable us
            WHERE u.HASH_ID_SUIVI=uh.HASH_ID AND uh.`id-user`=us.id AND u.HASH_ID = ? ");
        $st->bindParam(1,$hash);

        $st2 = Connexion::Connexion()->prepare(
            "SELECT ah.HASH_ID,ass.nom,ass.photo 
            FROM table_suivi u ,ass_hash ah,association ass
            WHERE u.HASH_ID_SUIVI=ah.HASH_ID AND ah.id_ASS=ass.id AND u.HASH_ID = ? ");
        $st2->bindParam(1,$hash);

        $st->execute();
        $st2->execute();
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        $res2 = $st2->fetchAll(PDO::FETCH_OBJ);
        return [$res,$res2];
    }

    public static function usersuive($id,$user){
        $st = Connexion::Connexion()->prepare("SELECT * FROM table_suivi u WHERE HASH_ID=:HASH_ID AND HASH_ID_SUIVI=:HASH_ID_SUIVI ");
        $st->bindParam(':HASH_ID', $user, PDO::PARAM_STR);
        $st->bindParam(':HASH_ID_SUIVI', $id, PDO::PARAM_STR);
        $st->execute();
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    
    public static function Addusersuive($HASH_ID_SUIVI,$HASH_ID){
        $st = Connexion::Connexion()->prepare("INSERT INTO table_suivi VALUES(null,:HASH_ID , :HASH_ID_SUIVI)");
        $st->bindParam(':HASH_ID_SUIVI', $HASH_ID_SUIVI, PDO::PARAM_STR);
        $st->bindParam(':HASH_ID', $HASH_ID, PDO::PARAM_STR);
        $res = $st->execute();;
        return $res;
    }
    public static function Deletsersuive($HASH_ID_SUIVI,$HASH_ID){
        $st = Connexion::Connexion()->prepare("DELETE FROM table_suivi WHERE HASH_ID=:HASH_ID AND HASH_ID_SUIVI=:HASH_ID_SUIVI");
        $st->bindParam(':HASH_ID', $HASH_ID, PDO::PARAM_STR);
        $st->bindParam(':HASH_ID_SUIVI', $HASH_ID_SUIVI, PDO::PARAM_STR);
        $res = $st->execute();;
        return $res;
    }

    public static function get_id_conver($HASH_1,$HASH_2){
        $st = Connexion::Connexion()->prepare(
            "SELECT id FROM conversations c
            WHERE (c.HASH_ID1=:HASH_1 AND c.HASH_ID2=:HASH_2) 
            OR (c.HASH_ID1=:HASH_2 AND c.HASH_ID2=:HASH_1)
            ");
        $st->bindParam(':HASH_1', $HASH_1, PDO::PARAM_STR);
        $st->bindParam(':HASH_2', $HASH_2, PDO::PARAM_STR);
        $st->execute();;
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function get_convers($HASH_1){
        $st = Connexion::Connexion()->prepare(
            "SELECT c.id,uh.HASH_ID,CONCAT(u.nom,' ',u.prenom) AS 'nom',u.photo FROM conversations c,user_hash uh ,usertable u
            WHERE (c.HASH_ID1=uh.HASH_ID OR c.HASH_ID2=uh.HASH_ID ) AND uh.`id-user`=u.id
            AND (c.HASH_ID1=? OR c.HASH_ID2=?)
            AND uh.HASH_ID<>?
            ");
        $st->bindParam(1, $HASH_1, PDO::PARAM_STR);
        $st->bindParam(2, $HASH_1, PDO::PARAM_STR);
        $st->bindParam(3, $HASH_1, PDO::PARAM_STR);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public static function createConv($HASH_1,$HASH_2){
        $st=Connexion::Connexion()->prepare('INSERT INTO conversations VALUES (null, :HASH_1 ,:HASH_2 ,null )');
        $st->bindParam(':HASH_1', $HASH_1, PDO::PARAM_STR);
        $st->bindParam(':HASH_2', $HASH_2, PDO::PARAM_STR);
        $res=$st->execute();
        return $res;
    }

    public static function get_Message($id,$HASH){
        $st=Connexion::Connexion()->prepare(
            'SELECT * FROM messages m
            WHERE m.id_Conv=? AND (m.Expediteur=? OR m.Destinataire=? )
            ORDER BY m.Dateenvoi
            ');
        $st->bindParam(1,$id);
        $st->bindParam(2,$HASH);
        $st->bindParam(3,$HASH);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public static function creatMessage($idconv,$HASH_1,$HASH_2,$Message){
        $st=Connexion::Connexion()->prepare('INSERT INTO messages VALUES (null, :idconv , :HASH_1 ,:HASH_2,:Msg ,current_timestamp() )');
        $st->bindParam(':idconv', $idconv, PDO::PARAM_STR);
        $st->bindParam(':HASH_1', $HASH_1, PDO::PARAM_STR);
        $st->bindParam(':HASH_2', $HASH_2, PDO::PARAM_STR);
        $st->bindParam(':Msg', $Message, PDO::PARAM_STR);
        $res=$st->execute();
        return $res;
    }

    public static function get_user($HASH){
        $st=Connexion::Connexion()->prepare(
            "SELECT concat(u.nom,'',u.prenom) AS 'nom', u.photo ,us.HASH_ID FROM user_hash us,usertable u
            WHERE us.`id-user`=u.id AND us.HASH_ID=?
            ");
        $st->bindParam(1,$HASH,PDO::PARAM_STR);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function get_nb_msg($idC){
        $st=Connexion::Connexion()->prepare(
            "SELECT count(*) AS 'nbmsg' FROM messages m 
            WHERE m.id_Conv= ? "
        );
        $st->bindParam(1,$idC);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function get_dernier_msg($idc,$limit){
        $st=Connexion::Connexion()->prepare(
            "SELECT * FROM messages m 
            WHERE id_Conv=?
            ORDER BY m.Dateenvoi DESC
            LIMIT ?");
        $st->bindParam(1,$idc,PDO::PARAM_INT);
        $st->bindParam(2,$limit,PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public static function Creat_disparu($nom, $prenom, $date_entre, $date_N, $photo, $ville, $HASH, $Gen)
    {
        $type = "DIS";
        $conn = Connexion::Connexion();
        $st = $conn->prepare("INSERT INTO disparu (`nom`, `prenom`, `date_entre`, `date_N`, `photo`, `ville`, `HASH`, `Gennre` , `type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $st->bindParam(1, $nom);
        $st->bindParam(2, $prenom);
        $st->bindParam(3, $date_entre);
        $st->bindParam(4, $date_N);
        $st->bindParam(5, $photo);
        $st->bindParam(6, $ville);
        $st->bindParam(7, $HASH, PDO::PARAM_STR);
        $st->bindParam(8, $Gen);
        $st->bindParam(9, $type);
        
        return $st->execute();
    }


    public static function get_Dispar($HASH){
        $st = Connexion::Connexion()->prepare("SELECT d.* FROM user_hash u ,disparu d WHERE u.HASH_ID=d.`HASH` AND u.HASH_ID=:HASH_id ORDER BY d.id");
        $st->bindParam(':HASH_id', $HASH, PDO::PARAM_STR);
        $st->execute();
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Recherch_disparu($tablekey){
        $requte="SELECT * FROM disparu WHERE ";
        foreach ($tablekey as $key => $value) {
            if ($key == "date_disparition") {
                $requte.="date_entre > $value AND ";
            }elseif ($key == "date_N") {
                $requte.="date_N > $value AND ";
            }elseif ($key == "Gennre") {
                $requte.="Gennre = '$value' AND ";
            }else {
                $requte.=$key." LIKE '%".$value."%' AND ";
            }
        }
        $requte=substr($requte,0,-5);
        $st = Connexion::Connexion()->prepare($requte);
        $st->execute();
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
}
