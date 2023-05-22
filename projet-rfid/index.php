
<?php

include("services/auth/auth.php");
if(islogin()){
header("Location: pages/home.php");
exit();

}else{
include("pages/first.php");
include("pages/login.php");
}

?>
