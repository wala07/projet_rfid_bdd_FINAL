<?php
//--------------------------------------------------------------------------
function retard($db,$idcours,$ideleve){
  
$idcarte="select id_carte from carte_rfid WHERE 
numero_carte=(SELECT `numero_carte` FROM `etudiant` WHERE `id_etudiant`=$ideleve);";
$idcarte=$db->excute($idcarte);
$idcarte=mysqli_fetch_array($idcarte);
$idcarte=$idcarte[0];
$req="SELECT `heur`,`type` FROM `presence` where `idcours`=$idcours and `idcarte`=$idcarte";


$res=$db->excute($req);
$res=mysqli_fetch_array($res);

if($res[1]==1){
  return FALSE;
}
else{
$req3="select debut from cours where id_cours=$idcours";
$resx=$db->excute($req3);
$h=mysqli_fetch_array($resx)[0];

include("../../services/date/date.php");
return comparetimes($res[0],$h);

}

}

//--------------------------------------------------------------------------

function etat($db,$ncarte,$idcours,$ideleve){
    $req ="SELECT * FROM `presence` WHERE `idcours`=$idcours and `idcarte`=(SELECT `id_carte` FROM `carte_rfid` WHERE `numero_carte`='$ncarte')";
    
    $res=$db->excute($req);
    if(mysqli_num_rows($res)==0){
      
        return  "<button class='pr-4 pl-3 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 text-blue-50 transition flex gap-1 items-center w-50 '
        value='changestate.php?to=0&ideleve=$ideleve&idcours=$idcours' onclick=' changerp(this);'>
        absent.
      </button>";
     
        
    }
    else{
      if(retard($db,$idcours,$ideleve)){ 
        return "<button class='pr-4 pl-3 py-2 bg-orange-600 hover:bg-orange-500 active:bg-orange-700 text-blue-50 transition flex gap-1 items-center w-50 '
        value='changestate.php?to=1&ideleve=$ideleve&idcours=$idcours' onclick=' changerp(this);'>
    retard
        </button>";
      }
      else{
        return "<button class='pr-4 pl-3 py-2 bg-green-600 hover:bg-green-500 active:bg-green-700 text-blue-50 transition flex gap-1 items-center w-50 '
        value='changestate.php?to=1&ideleve=$ideleve&idcours=$idcours' onclick=' changerp(this);'>
    présent
        </button>";
      }
    }
}
//--------------------------------------------------------------------------------------------------------------------------------------
include("../../services/db/db.php");
if(!isset($_GET["class"]) or !isset($_GET["idcours"]))
{
    exit();
}

include("../first.php");
include("navbar.php");
?>
<script>
function changerp(t){
  var x=t.value;
  x=x.split("to")[1][1];

  if(x==0){
    if (confirm("Êtes-vous sûr de vouloir changer l'état de l'élève à présent ?")) {
      window.location.href =t.value;
    
  }
  }
  else{
    if (confirm("Êtes-vous sûr de vouloir changer l'état de l'élève à absent ?")) {
      window.location.href =t.value;
    
  }
  }
  
  
  
  
 
}
</script>
<?php
$db=new db();
$db->connectdb();
$ic=$_GET["idcours"];

$req="select * from etudiant WHERE id_classe
=(SELECT `id_classe` FROM `cours` WHERE `id_cours`=$ic) order by (`nom_etudiant`);";

$res=$db->excute($req);
echo '
  <div class="w-full mt-10">
  <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead>
      <tr class="bg-gray-200 text-gray-600 uppercase text-s leading-normal">
        <th class="py-3 px-4 text-left">Nom</th>
        <th class="py-3 px-4 text-left"></th>
      </tr>
    </thead>
    <tbody class="text-gray-600 text-s font-light">
  
  
  ';
while ($t=mysqli_fetch_array($res)){
    $r1=$t[1];$r2=$t[2];
    echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>

    <td class='py-3 px-4'>$r1 $r2</td>
    <td class='py-3 px-4'>
    ".etat($db,$t[3],$ic,$t[0])."</td>
    </tr>";

}

?>