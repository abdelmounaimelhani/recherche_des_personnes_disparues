<?php 

if (isset($_POST["dentree"]) && isset($_POST["Prenom"]) 
&& isset($_POST["Villa"])&&isset($_POST["Naissance"])
&&isset($_POST["nom"])&&isset($_POST["Genner"])) {
    
    if (!empty($_POST["dentree"]) && !empty($_POST["Prenom"]) && !empty($_POST["Villa"])&&!empty($_POST["Naissance"])&&!empty($_POST["nom"])&&!empty($_POST["Genner"])) {
        $dentree = DateTime::createFromFormat('Y-m-d', $_POST["dentree"]);
        $Naissance = DateTime::createFromFormat('Y-m-d', $_POST["Naissance"]);
            $id=$_POST["INDI"];
            $id=$_POST["Genner"];
            $asso=$_SESSION["ass"];
            $res=ASSOCIATION_MODEL::info_indiv($id,$asso);
            if ((bool) $res) {
                $res=ASSOCIATION_MODEL::edite_indiv($_POST["nom"],$_POST["Prenom"],$_POST["dentree"],$_POST["Naissance"],$_POST["Villa"],$id,$asso);
                if ($res) {
                    $code=0;
                }else $code=5;
            }else $code=4;
    }else $code=2;
}