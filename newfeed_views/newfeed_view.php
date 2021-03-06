<?php
require_once "../templates/header.php";
require_once('../models/post.php');
$user_profile = get_user_profile();


?>
<div class="profile_body">
    <div class="to_post">
        <form action="../newfeed_controllers/create_post.php" method="post" class="form_post" enctype="multipart/form-data">
            <div class="post_title">Do you want to post something?</div>
            <div class="d-flex align-items-center " >
                <img src="../user_profile/<?=$user_profile["user_profile"]?>" alt="" width="35" height="35" class=" rounded-circle me-2">
                <input type="text"name="post_content"class="post_content" placeholder="content..."  >
            </div>
            <div>
                <input class="file_post"  type="file" name="image" >
            </div>
            <div>   
                <input class="button_post" type="submit"name="submit" value="Post">
            </div>
        </form>
        <div class="show_hide_comment">
            <button id="hide_comment">hide comment</button>
            <button id="show_comment">show comment</button>
        </div>
        <div class="container" mt-3>
            <?php
                require_once "../models/post.php";
                $posts = get_posts();
                foreach ($posts as $post):
            ?>


               
                <div class="card_post">
                    <div class="card-body_post">
                        <div class=" d-flex align-items-center ">
                            <img src="../user_profile/<?=$user_profile["user_profile"]?>" alt="" width="60" height="60" class=" rounded-circle" >
                            <p class="ms-2"> <?=$user_profile["user_first_name"].' '.$user_profile["user_last_name"]?> </p>
                        </div>
                        <p class="card-text"><?= $post['post_content'] ?></p> 
                        <div class=" d-flex justify-content-end ">
                            <a href="edit_view.php?id=<?php echo $post['post_id']?>"><i class="	fas fa-pencil-alt 	fas me-2"></i></a>
                            <a href="../newfeed_controllers/delete_post.php?id=<?php echo $post['post_id']?>"> <i class="fa fa-trash"></i></a>
                        </div>
                        <div class="image_post d-flex justify-content-center">
                            <img src="../images/<?= $post['post_image']?>" alt="" width="400">
                        </div>
                        <div class="number_like d-flex justify-content-around">
                            <p >
                                    <?php
                                        require_once "../models/like.php";
                                        $likes =  get_likes();
                                        $like_number = 0;
                                        foreach ($likes as $like):
                                            if($post['post_id'] == $like['post_id']){
                                                $like_number +=1;
                                                
                                    ?>  
                                            <?php
                                                }
                                                endforeach;
                                            ?>
                                    <p><?=$like_number?>likes</p>
                                
                            </p>
                            
                            <p>
                                <?php
                                    require_once "../models/comment.php";
                                    $comments =  get_comments();
                                    $number_comment = 0;
                                    foreach ($comments as $comment):
                                        if($post['post_id'] == $comment['post_id']){
                                            $number_comment +=1;
                                ?>  
                                        <?php
                                            }
                                            endforeach;
                                        ?>
                                <p><?=$number_comment?>comments</p>
                            </p>
                        </div>   
                        <!-- place to like and comment the post -->
                        <div class="like_comment_post d-flex">
                            <!-- To like the post -->
                            <form action="../newfeed_controllers/like_post.php" method="post">
                                <input class="form-control" value="<?php echo $post['post_id']?>" type="hidden" name="post_id">
                                <input class="form-control" value="<?php echo $post['user_id']?>" type="hidden" name="user_id">
                                <button type="submit" name="submit"class="far fa-thumbs-up fs-3" style="border:none;background:none"></button>
                            </form>
                            <!-- To comment the post -->
                            <div class="comment_post">
                                <?php 
                                    require "comment_view.php";
                                ?>  
                            </div> 
                        </div>
                    </div><br>
                </div><br>
            <?php endforeach; ?>    
        </div>
    </div>
</div>

<?php 
require_once "../templates/footer.php";
?>