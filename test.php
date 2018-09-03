<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<?php

echo isLoggedIn();

if (userLikedThisPost(10)){
    echo "USER LIKED IT";
} else {
    echo "USER DIDN'T LIKED IT";
}