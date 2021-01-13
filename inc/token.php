<?php
function settoken($etoken){
   session_start();
   $_SESSION['e_token'] = $etoken;  
   return false;
}

?>