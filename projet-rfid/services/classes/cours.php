<?php
function getnamecours($class,$start,$end,$db){
    $db->connectdb();
    $req="select * from cours where id_classe=(SELECT `idclasse` FROM `classe` where `nom_classe`='$class') and debut>='$start' and fin<='$end'";
    
    $res=$db->excute($req);

    if(mysqli_num_rows($res)==0){
        return "-";
    }
    else{
        $r=mysqli_fetch_array($res)[0];
        $x=idcourstonamme($r,$db);
        return "<a href='courpresence.php?class=$x&idcours=$r'>".$x."</a>";
    }

}
function idcourstonamme($idcours,$db){
    $req="SELECT `nom_matiere` from matiere WHERE `id_matiere`=(select `id__matiere` from enseignant WHERE cin_enseignant
    =(SELECT `id_enseignant` FROM `cours` WHERE `id_cours`=$idcours));";
    $res=$db->excute($req);
    return mysqli_fetch_array($res)[0];
}



?>