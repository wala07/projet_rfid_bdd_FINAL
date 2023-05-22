<?php

function getlistusers($db){

    
    $db->connectdb();
    $r=$db->excute("SELECT DISTINCT niveau FROM `classe` ;");
    $t=[];
    while ($x=mysqli_fetch_array($r)){
        array_push($t,$x[0]);
    }
    $nom=[];
    for($i=0;$i<count($t);$i++){
        $s=[];
        $r=$db->excute("SELECT nom_classe FROM `classe` WHERE niveau=".$t[$i].";");
       
        while ($c=mysqli_fetch_array($r)){
            array_push($s,$c[0]);
        }
        array_push($nom,$s);
        
    }
    /*
    for($i=0;$i<count($t);$i++){
        echo "<h1>".$t[$i]."</h1>";
        for($j=0;$j<count($nom[$i]);$j++){
            echo "<p>".$nom[$i][$j]."</p>";
        }
    }*/
    $info= [$t,$nom];
    $db->close();
    return $info;



    
}

function niveau($db){
    $r=getlistusers($db);
    $t=$r[0];
    echo "[";
    for($i=0;$i<count($t);$i++){
        $s=$t[$i];
        echo "$s";
        if($i!=count($t)-1){
            echo ",";
        }
    }
    echo "],[";
    
    $t2=$r[1];
    for($i=0;$i<count($t2);$i++){
        $s=$t2[$i];
        echo "[";
        for($j=0;$j<count($s);$j++){
            echo "'$s[$j]'";
            if($j!=count($s)-1){
                echo ",";
            }
        }
        echo "]";
        if($i!=count($t2)-1){
            echo ",";
        }
    }
    echo "]";
 
}





?>