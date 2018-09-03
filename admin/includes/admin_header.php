<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
    if(isset($_SESSION['user_role'])){
       /* if($_SESSION['user_role'] == "subscriber"){
            
            <script>
                alert("This page is only accessible by the admin");
                window.location = "../index.php";
            </script>
                
        }*/
    } elseif(!isset($_SESSION['user_role'])){
        ?>
        <script>
            alert("You have to login to access this page");
            window.location = "../index.php";
        </script>
        <?php
    } else {
        header("Location: ../index.php");
    }
    ?>
    
    <?php
   /* if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'subscriber'){
            $expireMinutes = 30;
            if(isset($_SESSION['last_activity'])){
                $expireSeconds = $expireMinutes * 60;
                $inactiveSeconds = time() - $_SESSION['last_activity'];
                if($inactiveSeconds > $expireSeconds){
                    session_unset();
                    session_destroy();
                    ?>
                    <script>
                        alert("Your session has expired. Pls log in again");
                        window.location = "../index.php";
                    </script>
                    <?php
                }
            }
            $_SESSION['last_activity'] = time();
        }
    }*/
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
    
    <script src="js/jquery.js"></script>
    
    <link href="css/styles.css" rel="stylesheet">
    
    <style>
        
    </style>
    
</head>

<body>
