<?php
include("../../pages/first.php");
include ("auth.php");


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
<?php

$name=$_POST["name"];
$pass=$_POST["password"];
include("../db/db.php");
$db=new db();
$db->connectdb();

$res=$db->excute("select id_utilisateur,typeacct  from utilisateur where nom_utilisateur ='$name' and mdp_utilisateur='$pass' ");
if($res->num_rows >0){
    $x=mysqli_fetch_array($res);
    echo "<script>b=true;</script>";
    login($x[0],$x[1],new db());

}
else{
    echo "<script>b=false;</script>";

}

?>
<script>
function verif(){
    if(b){
        window.location.href = "../../pages/home.php";
    }
    else{
        alert("something wrong");
        window.location.href = "../../index.php";
    }
}
setTimeout(function(){
    document.getElementById("rs").remove();
    setTimeout(
        verif,100
    )
    ;
}, 1000);

</script>
</html>
