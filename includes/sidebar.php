<script>
    function showResult(str){
        if(str.length == 0){
            document.getElementById("live_search").innerHTML = "";
            document.getElementById("live_search").style.border = "0px";
            return;
        }
        if(window.XMLHttpRequest){
            var xmlhttp = new XMLHttpRequest();
        } else {
            var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("live_search").innerHTML = this.responseText;
                document.getElementById("live_search").style.border = "1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET", "livesearch.php?q="+str, true);
        xmlhttp.send();
    }
</script>
  
  <?php

    if(isMethod('post')){
        if(isset($_POST['login'])){   
            if(isset($_POST['username']) && isset($_POST['password'])){
                login($_POST['username'], $_POST['password']);
            } else {
                redirect('index.php');
            }
        }
    }

 ?>
   
    <div class="col-md-4">

    <!-- Blog Search Well -->

    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post" autocomplete="off">
        <div class="input-group">
            <input name="search" type="text" class="form-control" onkeyup="showResult(this.value)"><div id="live_search" style="width: 52%;padding: 1%;color: #000;border-bottom-right-radius: 4px;border-bottom-left-radius: 4px;"></div>
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        </form> <!-- search form -->
        <!-- /.input-group -->
    </div>
    
        <!-- Login -->

    <div class="well">
       <?php if(isset($_SESSION['user_role'])): ?>
           <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
           <a href="includes/logout.php" class="btn btn-primary">Logout</a>
        <?php else: ?>
        <h4>Login</h4>
        <form method="post" autocomplete="off">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Enter Username">
        </div>
        
        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
                <button name="login" class="btn btn-primary" type="submit">Submit</button>
            </span>
        </div>
        
        <div class="form-group">
            <a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password?</a>
        </div>
        </form> <!-- login form -->
        <!-- /.input-group -->
        <?php endif; ?>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

       <?php

            $query = "SELECT * FROM categories";
            $result = mysqli_query($connection, $query);

        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php

                        while($row = mysqli_fetch_assoc($result)){
                            $categoryId = $row['cat_id'];
                            $categoryTitle = $row['cat_title'];
                            echo "<li><a href='category.php?id={$categoryId}'>{$categoryTitle}</a></li>";

                        }

                    ?>

                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>
