<form action="" method="post">
    <div class="form-group">
       <label for="catTitle">Edit Category</label>

       <?php
        if(isset($_GET['edit'])){
            $catId = escape($_GET['edit']);
            $query = "SELECT * FROM categories ";
            $query .= "WHERE cat_id = $catId ";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result)){
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];
        ?>

        <input value="<?php if(isset($catTitle)){ echo $catTitle; } ?>" type="text" class="form-control" name="catTitle">

        <?php  }} ?>

        <?php
        if(filter_input(INPUT_POST, 'cat_update')){
            $catTitle = escape($_POST['catTitle']);
            $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ?");
            mysqli_stmt_bind_param($stmt, "si", $catTitle, $catId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            redirect("categories.php");
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="cat_update" value="Update Category">
    </div>
</form>