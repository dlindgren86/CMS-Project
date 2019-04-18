<?php
    if(isset($_GET['id'])){
        $post_id = $_GET['id'];
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $edit_post = mysqli_query($connection, $query);
        query_error($edit_post);

        while($row = mysqli_fetch_assoc($edit_post)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_status = $row['post_status'];
            $post_img = $row['post_img'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

        }
    }

    if(isset($_POST['submit'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_img = $_FILES['post_img']['name'];
        $post_img_tmp = $_FILES['post_img']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        move_uploaded_file($post_img_tmp, "../img/$post_img");
        if(empty($post_img)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id ";
            $get_img = mysqli_query($connection, $query);
            query_error($get_img);

            while($row = mysqli_fetch_array($get_img)){
                $post_img = $row['post_img'];
            }
        }
        $query = "UPDATE posts SET ";
        $query .= "post_category_id = '$post_category_id', ";
        $query .= "post_title = '$post_title', ";
        $query .= "post_author = '$post_author', ";
        $query .= "post_img = '$post_img', ";
        $query .= "post_content = '$post_content', ";
        $query .= "post_tags = '$post_tags', ";
        $query .= "post_date = now(), ";
        $query .= "post_status = '$post_status' ";
        $query .= "WHERE post_id = $post_id";
        $updatePost = mysqli_query($connection, $query);
        query_error($updatePost);
        header('Location: posts.php');
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="title">Category</label> <br>
        <select name="post_category" id="post_category">
        <?php
        $query = "SELECT * FROM categories";
        $editCategory = mysqli_query($connection, $query);
        query_error($editCategory);

        while ($row = mysqli_fetch_assoc($editCategory)){
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

        echo "<option value='$cat_id'>$cat_title</option>";
        }
        ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="title">Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <div class="form-group">
        <img width="100px" src="../img/<?php echo $post_img;?>" alt="">
        <input type="file" name="post_img">
    </div>
    </div>
    <div class="form-group">
        <label for="title">Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="title">Content</label>
        <textarea type="text" rows="10" class="form-control" name="post_content"><?php echo $post_content; ?></textarea>
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Update">




</form>