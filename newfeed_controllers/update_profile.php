<?php 
require_once('../models/post.php');
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_profile=$_FILES['profile']['name'];
    $folder ="../user_profile/".$user_profile;
    move_uploaded_file($_FILES['profile']['tmp_name'],$folder);
    if(!empty("$user_profile")){
        change_profile($user_profile);
           header('Location:../newfeed_views/newfeed_view.php');

    }else{
           header('Location:../newfeed_views/newfeed_view.php');

    }
    
}
?>