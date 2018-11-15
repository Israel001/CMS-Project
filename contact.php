<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>
    
    
<?php
    if(isset($_POST['submit'])){
        $to = "israelobanijesu2@gmail.com";
        $subject = wordwrap($_POST['subject'], 70);
        $body = $_POST['body'];
        $header = "From: " .$_POST['email'];
        //Sending email using PHP default function (this will only work when the website is live)
        mail($to, $subject, $body, $header);
    }
?>

 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" required id="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" required id="subject" class="form-control" placeholder="Enter Your Subject">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>


<script>
    function liveCheck(str){
        if(str.length == 0){
            document.getElementById("livecheck").innerHTML = "";
            return;
        }
        if(window.XMLHttpRequest){
            var xmlhttp = new XMLHttpRequest();
        } else {
            var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("livecheck").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "livecheck.php?q="+str, true);
        xmlhttp.send();
    }
</script>



<?php include "includes/footer.php";?>
