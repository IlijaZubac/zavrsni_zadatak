 <?php

try {
        $conn = new PDO('mysql:host=127.0.0.1;dbname=novi_blog', 'root', 'vivify');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    $statement = $conn->prepare("SELECT * FROM posts WHERE Id = {$_GET['post_id']}");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $post = $statement->fetch();
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>

<?php include ('header.php');
?> 
 


<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">
 
                
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="singl-post.php?post_id=<?php echo($post['Id']) ?>"><?php echo $post['Title']?></a></h2>

                <p class="blog-post-meta"><?php echo $post['Created_at']?> <a href="#"><?php echo $post['Author']?> </a></p>


             <?php echo $post['Body'];?>
            </div><!-- /.blog-post -->

                <form action="creat-comments.php" method="POST">
                    <label name="Author" placeholder="Author">Author:</label><br>
                    <input type="text" name="Author"><br>
                    <textarea name="Text" row="10" cols="30" placeholder="Ostavite svoj komentar"></textarea><br>
                    <input type="hidden" name="Post_id" value="<?php echo $_GET['post_id']?>">
                    <input type="submit">
    <!--               <input type="button" onclick ="hide()" value="Hide-Show comments"> -->

                </form> 
            <div class ="removecomm">

             <input type="button" onclick ="hide()" value="Hide-Show">
             
            </div>
             <div class ="comments" id="comments">
                <ul>
            <?php 
                $statement = $conn->prepare("SELECT * FROM comments WHERE Post_id = {$_GET['post_id']}");
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $comments = $statement->fetchall();

            foreach ($comments as $singleCom){
            ?>
           
 
             
                    <li> <?php echo $singleCom['Author'];?> </li> <br>
                    <li> <?php echo $singleCom['Text'];?> </li> <hr>
             <button type="button" class="btn btn-default">Delete</button>     
            <?php
            } 
            ?>
      </ul>
            </div>
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>
 
        </div><!-- /.blog-main -->
         <?php include ('sidebar.php'); ?>
        </div><!-- /.row -->
   
</main><!-- /.container -->
 

<?php include ('footer.php'); ?>
<script src=file.js></script>
</body>
</html>
