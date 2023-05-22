<?php 

include("../../services/date/date.php");
include("../first.php");
include("navbar.php");
include("../../services/classes/classes.php");
include("../../services/db/db.php");
include("../../services/classes/cours.php");
if(isset($_GET["nb"])){
  $s=$_GET["nb"];
  $x=getalldays(deff(getdt(),$s*7));
  
}
else{
  $s=0;
  $x=getalldays(getdt());
}?>
<script>
    function setniveau(l){
        x=document.getElementById("niveau");
        for(var i=0;i<l.length;i++){
            var n=new Option();
            n.innerHTML=l[i];
            n.value=l[i];
            x.appendChild(n);
        }
    }
    function setclass(e){
        x=document.getElementById("class");
        while (x.firstChild) {
        x.removeChild(x.lastChild);
            }
        l=new Option()
        l.value="";
        l.innerHTML="-----";
        x.appendChild(l);    
        if(e.value!=""){
            c=ni[1][Number(e.value)-1]
            for(i=0;i<c.length;i++){
                l=new Option()
                l.value=c[i];
                l.innerHTML=c[i];
                x.appendChild(l);
            }
        }        
    }
    
</script>
<center>
    <form action="" type="POST" onsubmit="sub()" >
<table>
    <th><label for="countries" class="block mb-2 text-sm font-medium text-black-900 dark:text-black">Niveau</label>
<div class="w-36">
<select id="niveau" name="niveau" onchange="setclass(this)"  class="w-36 bg-indigo-600 border border-indigo-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-indigo-600 dark:border-indigo-600 dark:placeholder-indigo-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option selected value="">-----</option>
  
</select>
</div>
</th>
<th>
<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">classe</label>
<div class="w-36">
<select id="class"  name="class"class="w-36 bg-indigo-600 border border-indigo-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-indigo-600 dark:border-indigo-600 dark:placeholder-indigo-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option selected value="">-----</option>
  
</select>
</div>
</th>
<th>

</th>
</table>

<button type="submit"class=" text-white w-36 h-9 bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50       absolute ">
 Search
</button></form>
  </center>
  <script> 
    function sub(){
        
        if(document.getElementById("niveau").value=="" || document.getElementById("class").value==""){
            return false;
        }
    }
    var ni=[<?php niveau(new db);?>];setniveau(ni[0]);
</script>
<?php
if(!isset($_GET["class"] ) or $_GET["class"]=="" ){
exit();
}
?>

<center>
<p class="text-3xl mt-20"><?php echo $_GET["class"]; ?></p></center>
<div class="">
<button class="px-3 py-2 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 rounded w-50 absolute left-0">
  <a href="?niveau=<?php echo $_GET["niveau"];?>&class=<?php echo $_GET["class"];?>&nb=<?php echo $s-1;?>">précédent</a>
</button>

<button class="px-3 py-2 text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 rounded w-50 absolute right-0">
<a href="?niveau=<?php echo $_GET["niveau"];?>&class=<?php echo $_GET["class"];?>&nb=<?php echo $s+1;?>">Suivant</a>
</button>

<div class="w-full mt-10">
  <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead>
      <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
        <th class="py-3 px-4 w-30 "></th>
        <th class="py-3 px-4 w-30">8:00 -> 9:00</th>
        <th class="py-3 px-4 w-30">9:00 -> 10:00</th>
        <th class="py-3 px-4 w-30">10:00 -> 11:00</th>
        <th class="py-3 px-4 w-30">11:00 -> 12:00</th>
        <th class="py-3 px-4 w-30">12:00 -> 13:00</th>
        <th class="py-3 px-4 w-30">13:00 -> 14:00</th>
        <th class="py-3 px-4 w-30">14:00 -> 15:00</th>
        <th class="py-3 px-4 w-30">15:00 -> 16:00</th>
        <th class="py-3 px-4 w-30">16:00 -> 17:00</th>
        <th class="py-3 px-4 w-30">17:00 -> 18:00</th>
        <th class="py-3 px-4 w-30"></th>
      </tr>
    </thead>
   <tbody class="text-gray-600 text-sm font-light">
      <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-4 font-bold w-30">Lundi <br><?php $rn=0;echo $x[$rn]; ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 08:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 09:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 10:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 11:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 12:00:00","$x[$rn]"." 13:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 13:00:00","$x[$rn]"." 14:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 14:00:00","$x[$rn]"." 15:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 15:00:00","$x[$rn]"." 16:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 16:00:00","$x[$rn]"." 17:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 17:00:00","$x[$rn]"." 18:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"></td>
        
      </tr>
      <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-4 font-bold">Mardi<br><?php echo $x[1]; ?></td>
        <td class="py-3 px-4 w-30"><?php $rn++;echo getnamecours($_GET["class"],"$x[$rn]"." 08:00:00","$x[$rn]"." 09:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 09:00:00","$x[$rn]"." 10:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 10:00:00","$x[$rn]"." 11:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 11:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 12:00:00","$x[$rn]"." 13:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 13:00:00","$x[$rn]"." 14:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 14:00:00","$x[$rn]"." 15:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 15:00:00","$x[$rn]"." 16:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 16:00:00","$x[$rn]"." 17:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 17:00:00","$x[$rn]"." 18:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"></td>
      </tr>
      <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-4 font-bold">Mercredi<br><?php echo $x[2]; ?></td>
        <td class="py-3 px-4 w-30"><?php $rn++;echo getnamecours($_GET["class"],"$x[$rn]"." 08:00:00","$x[$rn]"." 09:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 09:00:00","$x[$rn]"." 10:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 10:00:00","$x[$rn]"." 11:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 11:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 12:00:00","$x[$rn]"." 13:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 13:00:00","$x[$rn]"." 14:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 14:00:00","$x[$rn]"." 15:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 15:00:00","$x[$rn]"." 16:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 16:00:00","$x[$rn]"." 17:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 17:00:00","$x[$rn]"." 18:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"></td>
      </tr>
      <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-4 font-bold">Jeudi<br><?php echo $x[3]; ?></td>
        <td class="py-3 px-4 w-30"><?php $rn++;echo getnamecours($_GET["class"],"$x[$rn]"." 08:00:00","$x[$rn]"." 09:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 09:00:00","$x[$rn]"." 10:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 10:00:00","$x[$rn]"." 11:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 11:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 12:00:00","$x[$rn]"." 13:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 13:00:00","$x[$rn]"." 14:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 14:00:00","$x[$rn]"." 15:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 15:00:00","$x[$rn]"." 16:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 16:00:00","$x[$rn]"." 17:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 17:00:00","$x[$rn]"." 18:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"></td>
      </tr>
      <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-4 font-bold">Vendredi<br><?php echo $x[4]; ?></td>
        <td class="py-3 px-4 w-30"><?php $rn++;echo getnamecours($_GET["class"],"$x[$rn]"." 08:00:00","$x[$rn]"." 09:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 09:00:00","$x[$rn]"." 10:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 10:00:00","$x[$rn]"." 11:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 11:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 12:00:00","$x[$rn]"." 13:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 13:00:00","$x[$rn]"." 14:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 14:00:00","$x[$rn]"." 15:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 15:00:00","$x[$rn]"." 16:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 16:00:00","$x[$rn]"." 17:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 17:00:00","$x[$rn]"." 18:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"></td>
      </tr>
      <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-4 font-bold">Samdi<br><?php echo $x[5]; ?></td>
        <td class="py-3 px-4 w-30"><?php $rn++;echo getnamecours($_GET["class"],"$x[$rn]"." 08:00:00","$x[$rn]"." 09:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 09:00:00","$x[$rn]"." 10:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 10:00:00","$x[$rn]"." 11:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 11:00:00","$x[$rn]"." 12:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 12:00:00","$x[$rn]"." 13:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 13:00:00","$x[$rn]"." 14:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 14:00:00","$x[$rn]"." 15:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 15:00:00","$x[$rn]"." 16:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 16:00:00","$x[$rn]"." 17:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"><?php echo getnamecours($_GET["class"],"$x[$rn]"." 17:00:00","$x[$rn]"." 18:00:00",new db()); ?></td>
        <td class="py-3 px-4 w-30"></td>
      </tr>
    </tbody>
  </table>
</div>
</div>