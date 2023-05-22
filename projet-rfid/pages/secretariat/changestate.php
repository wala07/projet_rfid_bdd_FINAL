<?php
include("../../services/db/db.php");

include("../../services/auth/auth.php");
permesion("../home.php",1);
//present 
function setpresent($ideleve,$idcours){
    
    
    $db=new db();
    $db->connectdb();

    $req="select id_carte from carte_rfid WHERE 
    numero_carte=(SELECT `numero_carte` FROM `etudiant` WHERE `id_etudiant`=$ideleve);";
    $res=$db->excute($req);
    $res=mysqli_fetch_array($res)[0];
    
    include("../../services/date/date.php");
    $date=getdth();
    $req2="insert into `presence`  VALUES($idcours,$res,'$date',1)";
    
    
    $db->excute($req2);
    $db->close();

}
//set abs
function setideleve($ideleve,$idcours){
    $db=new db();
    $db->connectdb();

    $req="select id_carte from carte_rfid WHERE 
    numero_carte=(SELECT `numero_carte` FROM `etudiant` WHERE `id_etudiant`=$ideleve);";
    $res=$db->excute($req);
    $res=mysqli_fetch_array($res)[0];
    $req="DELETE FROM `presence` WHERE `presence`.`idcours` = $idcours AND `presence`.`idcarte` = $res";
    $db->excute($req);

}

//verif si eleve p ou abs
if(isset($_GET["to"]) and isset($_GET["ideleve"]) and isset($_GET["to"]) ){
    if($_GET["to"]==0){
        
        setpresent($_GET["ideleve"],$_GET["idcours"]);
        

    }
    else{
        setideleve($_GET["ideleve"],$_GET["idcours"]);

    }

    
    
    
}


?>




<?php
include("../first.php");
$ref = $_SERVER['HTTP_REFERER'];
?>
<style >
    @keyframes loading-bar {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.animate-loading-bar {
  animation: loading-bar 4s linear infinite;
}

</style>
<body class="bg-gray-100">
<div id="rs" class="h-1 bg-gray-200 rounded-full overflow-hidden">
  <div class="h-full bg-indigo-600 rounded-full animate-loading-bar"></div>
</div>
</body>
<script>
function verif(){
    
       window.location.href = "<?php echo $ref; ?>";
    
        
    
}
setTimeout(function(){
    
    setTimeout(
        verif,100
    )
    ;
}, 1000);



</script>


