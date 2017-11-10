 
 <aside class="col-sm-3 ml-sm-auto blog-sidebar">
           
    <div class="sidebar-module sidebar-module-inset">
        <h4><a href="#">Latest posts</a></h4>
        
    <?php
try {
        $conn = new PDO('mysql:host=127.0.0.1;dbname=novi_blog', 'root', 'vivify');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
       $sqlLast = "SELECT * FROM posts ORDER BY Created_at DESC LIMIT 5";
       $statementCom = $conn->prepare($sqlLast);
       $statementCom->execute();
       $statementCom->setFetchMode(PDO::FETCH_ASSOC);
       $latestPosts = $statementCom->fetchAll();
       // print_r($latestPosts);
       foreach ($latestPosts as $lastPost) {
     ?>
     <h6><a href="singl-post.php?post_id=<?php echo ($lastPost['Id']);?>"><?php echo $lastPost['Title'] ?></a></h6>

     <?php
     }
     ?>
    </div>
           
         
</aside><!-- /.blog-sidebar -->
 
