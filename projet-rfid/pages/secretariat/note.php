<?php
include("../../services/db/db.php");

include("../first.php");
include("navbar.php");
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