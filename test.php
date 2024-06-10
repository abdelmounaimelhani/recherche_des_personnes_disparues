<?php 

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
}