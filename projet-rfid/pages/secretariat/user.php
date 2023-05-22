<?php
function changename($n){
    include("../../services/db/db.php");
    session_start();
    $db=new db();
    $db->connectdb();
    $req1="SELECT * FROM `utilisateur` WHERE `nom_utilisateur`='$n'";
    $res=$db->excute($req1);
    if(mysqli_num_rows($res)!=0){
        return "le nom existe deja";
    }
    else{
        $id=$_SESSION["id"];
        $req2="UPDATE `utilisateur`  set `nom_utilisateur`='$n' WHERE `id_utilisateur`=$id";
        $res=$db->excute($req2);
    return "le nom est change";    }


    


    session_write_close();
}
if(isset($_POST["name"])){

    echo changename($_POST["name"]);
    exit();
}
if(isset($_POST["pass"])){

    echo "le mdp est change";
    exit();
}

include("../first.php");
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

<body class="bg-gray-100" onload>

<div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50  hidden">
  <div class="bg-white p-4 rounded shadow-lg">
    <p id="popupMessage" class="text-gray-800"></p>
    <button id="closeButton" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Close</button>
  </div>
</div>
<div id="r"></div> 
</body>
<script>
function sendData(data) {
  var xhr = new XMLHttpRequest();
  
  var dataString = Object.keys(data).map(function(key) {
    return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
  }).join('&');

  xhr.open('POST', 'user.php', true); // securité
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function() {
    if (xhr.status === 200) {

        show();
        showPopup(xhr.responseText);
      var response = xhr.responseText;
      console.log(response);
    } else {
        show();
        showPopup("erreur dans cette action");
      console.log('Error: ' + xhr.status);
      
    }
  };

  xhr.send(dataString);
}










function changepass(){
v=prompt("nv mot de pass:")
if(v!=null && v.length>=4){
        
        sendData({pass:v});
    }
}
function changename(){
    
    v=prompt("nv nom:")
    
    if(v!=null && v.length>3){
        
        sendData({name:v});
    }
    
}
//----------------------------------------------------en-tete
    const popup = document.getElementById('popup');
const popupMessage = document.getElementById('popupMessage');
const closeButton = document.getElementById('closeButton');

function showPopup(message) {
  popupMessage.textContent = message;
  popup.classList.remove('hidden');
}

function closePopup() {
  popup.classList.add('hidden');
}

closeButton.addEventListener('click', closePopup);
//----------------------------------------      
     function showloading(){//loading attente quoi
        //del()
        const loading=`<div id="rs" class="h-1 bg-gray-200 rounded-full overflow-hidden">
  <div class="h-full bg-indigo-600 rounded-full animate-loading-bar"></div>
</div>`;
c=document.getElementById("r");
        c.innerHTML=loading;

     }
     
     
    function show(){ //loading attente quoi / contraire
        //dellloading()
        const string = `<?php include("navbar.php");?><div class="flex  items-center justify-center"><div class="bg-white p-8 rounded shadow-md w-full "><h2 class="text-2xl font-bold mb-6">changer le donne</h2><button onclick='changename()' class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"> change le nom</button><button onclick="changepass()" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">change le mot de passe</button>`;
        c=document.getElementById("r");
        c.innerHTML=string;
        
    }
    show();
</script>
</html>
