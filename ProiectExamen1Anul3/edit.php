<?php
//include connection file
include 'connection.php';
if (!isset($_POST['submit'])) {
    $sql = "SELECT * FROM images WHERE ID='{$_GET['id']}'";
    $result = mysqli_query($con, $sql);
    $record = mysqli_fetch_array($result);
} else {
    $sql2 = "SELECT * FROM images WHERE ID='{$_POST['id']}'";
    $result2 = mysqli_query($con, $sql2);
    $rec = mysqli_fetch_array($result2);

    $title = $_POST['title'];
    if (isset($_POST['image'])) {
        $target = "./images/" . basename($_FILES['image']['name']);
    } else {
        $target = $rec['image'];
        echo $target;
    }
    $sql1 = "UPDATE images SET title='{$title}', image='{$target}' WHERE id='{$_POST['id']}'";
    mysqli_query($con, $sql1) or die(mysqli_error($con));
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    header('Location:for_visitors.php');
}
?>

<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Upload Page </title>
        <link rel="stylesheet" type="text/css" href="./css/upload_styling.css">
    </head>
    <body>
        <div class="main-container">

            <div class="nav-container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="for_visitors.php">Collection</a></li>
                    <li><a href="upload.php">Upload</a><li>
                </ul>
            </div>
            <div class="center-stuff-upload">


                <h1>Editati inregistrarea:</h1>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>

                    Titlu:<br/><input type="text" name="title" value="<?php echo $record['title']; ?>"/><br><br>

                    Image: <br/><input type="file" name="image" value="<?php echo $record['image']; ?>"><br><br>

                    <input type="submit" name="submit" value="Edit"/><br><br>

                    <img style="width:40%;" src="<?php echo $record['image']; ?>"><br/>



                </form>



            </div>
        </div>
    </body>
</html>