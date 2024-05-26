<?php 
class ASSOCIATION_MODEL
{
    public static function getindivid(){
        $st = Connexion::Connexion()->prepare("SELECT MAX(id) as 'id' from individus ");
        $st->execute();
        $res = $st->fetch(PDO::FETCH_OBJ);
        return $res;
    }
    public static function Creat_association($nom,$email,$tele,$ville,$adress,$passw,$photo){
        //
        $st = Connexion::Connexion()->prepare("INSERT INTO association(nom,email,tele,ville,adress,pass,photo) VALUES ( ?, ?, ?, ?, ?, ?, ?);");
        $st->bindParam(1, $nom);
        $st->bindParam(2, $email);
        $st->bindParam(3, $tele);
        $st->bindParam(4, $ville);
        $st->bindParam(5, $adress);
        $st->bindParam(6, $passw);
        $st->bindParam(7, $photo);
        $res = $st->execute();
        
        return $res;
        
    }
    public static function Editeass($nom,$email,$Adress,$tele,$Ville){
        //Modifier les informations d'un utilisateur.
        $st = Connexion::Connexion()->prepare("UPDATE association SET nom = ? ,adress=? ,email =? ,tele=? ,Ville=? WHERE id = ? ;");
        $st->bindParam(1, $nom);
        $st->bindParam(2, $Adress);
        $st->bindParam(3, $email);
        $st->bindParam(4, $tele);
        $st->bindParam(5, $Ville);
        $st->bindParam(6, $_SESSION["ass"]);
        
        $res = $st->execute();
        return $res;
    }

    public static function UpdateassPassword($pass,$id){
        $st = Connexion::Connexion()->prepare("UPDATE association SET pass = ? WHERE id = ? ;");
        $st->bindParam(1, $pass);
        $st->bindParam(2, $id);
        $res = $st->execute();
        return $res;
    }

    public static function Info_ass($id){
        $st = Connexion::Connexion()->prepare("SELECT * FROM association WHERE id=?");
        $st->bindParam(1, $id,PDO::PARAM_INT);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function EmailAsssexist($email)
    {
        //Vérifier l'existence d'une adresse e-mail.
        $st = Connexion::Connexion()->prepare("SELECT count(*) as 'nb' FROM `association` a, `usertable` u WHERE a.email = '$email' OR u.email = '$email'");
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function PassAss($email){
        //mote de pass 
        $st = Connexion::Connexion()->prepare("SELECT pass , id FROM association WHERE email=? ");
        $st->bindParam(1, $email,PDO::PARAM_STR);
        $st->execute();
        $res=$st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Creat_indiv($nom, $prenom, $date_entre, $date_N, $photo, $ville, $HASH,$Gen)
    {
        $conn = Connexion::Connexion();
        $st = $conn->prepare("INSERT INTO disparu (`nom`, `prenom`, `date_entre`, `date_N`, `photo`, `ville`, `HASH`, `Gennre`, `type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?,'IND')");
        
        $st->bindParam(1, $nom ,PDO::PARAM_STR);
        $st->bindParam(2, $prenom ,PDO::PARAM_STR);
        $st->bindParam(3, $date_entre ,PDO::PARAM_STR);
        $st->bindParam(4, $date_N ,PDO::PARAM_STR);
        $st->bindParam(5, $photo ,PDO::PARAM_STR);
        $st->bindParam(6, $ville ,PDO::PARAM_STR);
        $st->bindParam(7, $HASH ,PDO::PARAM_STR);
        $st->bindParam(8, $Gen ,PDO::PARAM_STR);
        
        return $st->execute();
    }
    
    public static function get_indvs($HASH)
    {
        $st = Connexion::Connexion()->prepare("SELECT d.* FROM ass_hash a ,disparu d WHERE a.HASH_ID=d.`HASH` AND a.HASH_ID=:HASH_id ORDER BY d.id");
        $st->bindParam(':HASH_id', $HASH, PDO::PARAM_STR);
        $st->execute();
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    
    public static function info_indiv($idind,$HASH=null){
        $conn=Connexion::Connexion();
        if ($HASH!=null) {
            $st=$conn->prepare("SELECT * FROM disparu WHERE id=:id AND `HASH`=:HASHID");
            $st->bindParam(':id', $idind);
            $st->bindParam(':HASHID', $HASH);
        }else {
            $st=$conn->prepare("SELECT D.nom,D.prenom,D.date_N,D.Gennre,D.photo,D.ville,
                                A.nom as 'Nomass',A.email,A.tele,A.ville,A.adress
                                FROM disparu D,association A, ass_hash AH
                                WHERE D.`HASH`=AH.HASH_ID AND AH.id_ASS=A.id AND D.id=:id ");
            $st->bindParam(':id', $idind);
        }
        $st->execute();
        $res = $st->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public static function edite_indiv($nom, $prenom, $date_entre, $date_N, $ville, $id, $Asso){
        $conn=Connexion::Connexion();
        $sql = "UPDATE individus 
                SET nom = :nom, prenom = :prenom, date_entre = :date_entre, date_N = :date_N, ville = :ville
                WHERE id = :id AND Asso = :Asso";
        $st = $conn->prepare($sql);
        $st->bindParam(':nom', $nom);
        $st->bindParam(':prenom', $prenom);
        $st->bindParam(':date_entre', $date_entre);
        $st->bindParam(':date_N', $date_N);
        $st->bindParam(':ville', $ville);
        $st->bindParam(':id', $id);
        $st->bindParam(':Asso', $Asso);
        return $st->execute();

    }
    public static function Update_img($photo,$id,$Asso){
        $conn=Connexion::Connexion();
        $sql = "UPDATE individus 
                SET  photo = :photo
                WHERE id = :id AND Asso = :Asso";
        $st = $conn->prepare($sql);
        $st->bindParam(':photo', $photo);
        $st->bindParam(':id', $id);
        $st->bindParam(':Asso', $Asso);
        $st->execute();
    }

    public static function delet_indiv($id,$asso){
        $conn=Connexion::Connexion();
        $st=$conn->prepare("DELETE FROM `individus` WHERE `id`=:id AND Asso=:Asso");
        $st->bindParam(':id', $id);
        $st->bindParam(':Asso', $asso);
        return $st->execute();
    }

    public static function Commentair_Post_Ass($idP){
        $st = Connexion::Connexion()->prepare(
            "SELECT p.*,ass.nom FROM publication_comment p, association ass,ass_hash ah
            WHERE ass.id=ah.id_ASS AND ah.HASH_ID=p.`HASH` AND id_publication = ?
            ORDER BY p.date_comment DESC"
        );
        $st->bindParam(1, $idP ,PDO::PARAM_INT);
        $st->execute();
        $res= $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    public static function Rcherch_Ass_nom($nom,$HASH){
        if (!empty($nom)) { 
            $st = Connexion::Connexion()->prepare(
                "SELECT HASH_ID,nom,photo FROM `association` , ass_hash 
                WHERE id_ASS=id AND HASH_ID <> :HASH_ID AND nom LIKE :nom");
            $nomParam = '%' . $nom . '%';
            $st->bindValue(':nom', $nomParam, PDO::PARAM_STR);
        }else $st=Connexion::Connexion()->prepare(
            "SELECT HASH_ID,nom,photo FROM `association` , ass_hash 
            WHERE id_ASS=id AND HASH_ID <> :HASH_ID LIMIT 10"
            );
        $st->bindValue(':HASH_ID', $HASH, PDO::PARAM_STR);
        $st->execute();
        $res=$st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    
    public static function GetHash($id){
        $conn=Connexion::Connexion();
        $st=$conn->prepare("SELECT * FROM ass_hash WHERE id_ASS = ? ");
        $st->bindParam(1,$id,PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function Check_Hach($hash){
        $conn=Connexion::Connexion();
        $st=$conn->prepare("SELECT * FROM ass_hash WHERE HASH_ID = ? ");
        $st->bindParam(1,$hash,PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function Infoass_comment($HASH){
        
            //Récupérer les informations d'un utilisateur.
            $st = Connexion::Connexion()->prepare(
                "SELECT nom, HASH_ID,photo FROM association ass , ass_hash ah 
                WHERE ass.id=ah.`id_ASS` and HASH_ID=?"
            );
            $st->bindParam(1, $HASH,PDO::PARAM_STR);
            $st->execute();
            $res=$st->fetch(PDO::FETCH_OBJ);
            return $res;
        
    }

    public static function get_convers($HASH_1){
        $st = Connexion::Connexion()->prepare(
            "SELECT c.id,ah.HASH_ID,nom,a.photo FROM conversations c,ass_hash ah ,association a
            WHERE (c.HASH_ID1=ah.HASH_ID OR c.HASH_ID2=ah.HASH_ID ) AND ah.id_ASS=a.id
            AND (c.HASH_ID1=? OR c.HASH_ID2=?)
            AND ah.HASH_ID<>?
            ");
        $st->bindParam(1, $HASH_1, PDO::PARAM_STR);
        $st->bindParam(2, $HASH_1, PDO::PARAM_STR);
        $st->bindParam(3, $HASH_1, PDO::PARAM_STR);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public static function get_ass($HASH){
        $st=Connexion::Connexion()->prepare(
            "SELECT nom, photo ,ass.HASH_ID,adress,email,tele,ville FROM ass_hash ass,association a
            WHERE ass.id_ASS =a.id AND ass.HASH_ID=?
            ");
        $st->bindParam(1,$HASH,PDO::PARAM_STR);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    
    public static function Recherch_disparu($tablekey){
        $requte="SELECT d.*, CONCAT(us.nom, ' ', us.prenom) AS 'nomC', us.tele, us.email 
                FROM disparu d, usertable us ,user_hash uh 
                WHERE d.HASH=uh.HASH_ID AND us.id=uh.`id-user` ";
        foreach ($tablekey as $key => $value) {
            if ($key == "date_entre") $requte.="AND d.date_disparition <= '$value'  ";
            elseif ($key == "date_N") $requte.="AND d.date_N >= '$value'  ";
            elseif ($key == "Gennre") $requte.="AND d.Gennre = '$value'  ";
            else $requte.="AND d.$key LIKE '%$value%'";
        }
        $st = Connexion::Connexion()->prepare($requte);
        $st->execute();
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    
    public static function get_info_Disp($id) {
        $requte = "SELECT d.*, CONCAT(u.nom, ' ', u.prenom) AS 'nomC', u.email, u.tele
                   FROM disparu d
                   JOIN user_hash uh ON d.HASH = uh.HASH_ID
                   JOIN usertable u ON uh.`id-user` = u.id
                   WHERE d.id = :id ";
        $st = Connexion::Connexion()->prepare($requte);
        //$st->bindParam()
        $st->execute([":id" => $id]);
        $res = $st->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    
}
