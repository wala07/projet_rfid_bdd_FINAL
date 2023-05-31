
<?php 
include("../../services/auth/auth.php");
include("../../services/date/date.php");
loginact("../home.php");


?>

<?php
include("../first.php");
if(!isset($_GET["ideleve"])){
exit();
}
include("../../services/db/db.php");
$id=$_GET['ideleve'];
$reqinfo="SELECT `nom_etudiant`,`prenom_etudiant`,`nom_classe` FROM `etudiant` e,classe c WHERE `id_etudiant`=$id and e.id_classe=c.idclasse;";
$reqnbcours="SELECT count(`id_cours`) FROM `cours` WHERE `id_classe`=(SELECT id_classe FROM `etudiant`
where id_etudiant=$id) and debut < (select CURDATE())";
$reqabb="select * from presence where idcours  in (SELECT `id_cours` FROM `cours` WHERE `id_classe`=(SELECT id_classe FROM `etudiant`
where id_etudiant=$id)) and idcarte=(select `id_carte` from carte_rfid WHERE `numero_carte`
=(SELECT `numero_carte` FROM `etudiant` WHERE `id_etudiant`=$id));";







//get data 
$db=new db();
$db->connectdb();

$res=$db->excute($reqinfo);
$t1=mysqli_fetch_array($res);
$res2=$db->excute($reqnbcours);
$r2=mysqli_fetch_array($res2);
$res3=$db->excute($reqabb);
$r3=mysqli_num_rows($res3);
?>
<body onload="window.print()">
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Fiche d'élève</h1>
    <div class="flex">
      <div class="w-1/2">
        <div class="mb-4">
          <label class="block font-bold">Nom:</label>
          <span class="text-gray-800"><?php echo $t1[0]?></span>
        </div>
        <div class="mb-4">
          <label class="block font-bold">Prénom:</label>
          <span class="text-gray-800"><?php echo $t1[1]?></span>
        </div>
        <div class="mb-4">
          <label class="block font-bold">Classe:</label>
          <span class="text-gray-800"><?php echo $t1[2]?></span>
        </div>
      </div>
      <div class="w-1/2">
        <div class="mb-4">
          <label class="block font-bold">Nombre de séances:</label>
          <span class="text-gray-800"><?php echo $r2[0] ?></span>
        </div>
        <div class="mb-4">
          <label class="block font-bold">Nombre de séances de présence:</label>
          <span class="text-gray-800"><?php echo $r3 ?></span>
        </div>
      </div>
    </div>
    <h1 class="text-2xl font-bold mb-4">les notes:</h1>



<?php
function showall($id){
    echo '
    <div class="w-full mt-10" id="item">
    <div class="flex justify-center items-center ">
  </div>
    
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-s leading-normal">
          <th class="py-3 px-4 text-left">matiere</th>
          <th class="py-3 px-4 text-left">note</th>
          
        </tr>
      </thead>
      <tbody class="text-gray-600 text-s font-light">
    
    
    ';
    $db=new db();
    $db->connectdb();
    $req="select * FROM note where id_etudiant=$id";
    
    $res=$db->excute($req);

    
    while($t=mysqli_fetch_array($res)){
        
        $req2="SELECT `nom_matiere` FROM `matiere` WHERE `id_matiere`=(SELECT `id__matiere` FROM `enseignant` WHERE `cin_enseignant`='$t[1]');";
        
        $x2=$db->excute($req2);
        $x2=mysqli_fetch_array($x2);
        $x2=$x2[0];
        echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
  
        <td class='py-3 px-4'>$x2</td>
        <td class='py-3 px-4'>$t[2]</td>";

    
    }
    
    
    echo '</table></div>
    
    
';
}
if(isset($_GET["ideleve"])){
    showall( $_GET["ideleve"]);
}





?>