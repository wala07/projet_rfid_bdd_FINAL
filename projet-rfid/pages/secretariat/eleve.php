
<?php

include("../first.php");
include("navbar.php")

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
include("elev.php");

if(isset($_GET["ideleve"])){
echo '<div class="w-full mt-10">
<table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
  <thead>
    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
      <th class="py-3 px-4 text-left">eleve</th> 
      <th class="py-3 px-4 text-left">l"etat</th>
      </tr>
      </thead>
      <tbody class="text-gray-600 text-s font-light">';
$x=showstate($_GET["ideleve"]); // donne le id seance , nom seance , date debut et fin , abs ou p
for($i=0;$i<count($x);$i++){
    $a1=$x[$i][1];$a2=$x[$i][2];$a3=$x[$i][3];
    echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>

    <td class='py-3 px-4'><b>$a1</b>  $a2-----> $a3</td>
    <td class='py-3 px-4'>";
    if($x[$i][4]){

      if(retard($x[$i][0],$_GET["ideleve"],$a2)){
        $r=$_GET["ideleve"];$r2=$x[$i][0];$r3=$x[$i][0];
        echo "<button class='pr-4 pl-3 py-2 bg-orange-600 hover:bg-orange-500 active:bg-orange-700 text-blue-50 transition flex gap-1 items-center w-50 '
        value='changestate.php?to=1&ideleve=$r&idcours=$r2' onclick=' changerp(this);'>
    retard
        </button>";

      }
      else{
      $r=$_GET["ideleve"];$r2=$x[$i][0];$r3=$x[$i][0];
        echo "<button class='pr-4 pl-3 py-2 bg-green-600 hover:bg-green-500 active:bg-green-700 text-blue-50 transition flex gap-1 items-center w-50 '
        value='changestate.php?to=1&ideleve=$r&idcours=$r2' onclick=' changerp(this);'>
    présent
        </button>";
      }
    }
    else{
      $r=$_GET["ideleve"];$r2=$x[$i][0];
        echo "<button class='pr-4 pl-3 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 text-blue-50 transition flex gap-1 items-center w-50 '
        value='changestate.php?to=0&ideleve=$r&idcours=$r2' onclick=' changerp(this);'>
        absent.
      </button>";

    }echo "</td>
    </tr>";
}
    }
else{
    
}
echo '</div>

</body>';
?>

</html>