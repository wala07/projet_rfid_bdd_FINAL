<?php
//start

function islogin(){
    
    session_start();
    $v=isset($_SESSION["name"]);
    session_write_close();
    return $v==TRUE;
}
function login($l,$l2,$db){
if(islogin()){
    return FALSE;
}
else{
    session_start();
    $_SESSION["id"]=$l;
    $_SESSION["type"]=$l2;
    
    session_write_close();
    getname($l,$db);
}
}
function logout(){
    session_start();
    session_unset();
    session_write_close();
}
function loginact($url){
    if(!islogin()){
        header("Location: $url");
    }
}
function permesion($url,$n){
session_start();
if($_SESSION["type"]!=$n){
    header("Location: $url");
}
session_write_close();
}


function getname($id,$db){
    $db->connectdb();
    
    $req="SELECT nom_enseignant FROM `enseignant` WHERE `id_utilisateur`=$id";
    $res1=$db->excute($req);
    $req="SELECT nom_secretaire FROM `secretaire` WHERE `id_utilisateur`=$id";
    $res2=$db->excute($req);
    if((mysqli_num_rows($res1)+mysqli_num_rows($res2))==0){
        echo"<script>alert('Ce compte est désactivé')</script>";
        logout();
    }
    else{
        session_start();
if(mysqli_num_rows($res1)>0){

    $_SESSION["name"]=  (mysqli_fetch_array($res1))[0];
}
else{
    $_SESSION["name"]=  (mysqli_fetch_array($res2))[0];
}
session_write_close();
    }
}
?>