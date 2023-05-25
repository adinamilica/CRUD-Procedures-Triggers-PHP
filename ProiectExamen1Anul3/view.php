
<html>
    <head>
        <meta charset="UTF-8">
        <title> Collection </title>
        <link rel="stylesheet" type="text/css" href="./css/view-styling.css">
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

            <div style="margin:auto; width: fit-content;
                 block-size: fit-content;
                 ">

                <a href="index.php">Back</a> 


                <?php
                include 'connection.php';
                $sql = "SELECT * FROM images WHERE ID='{$_GET['id']}'";
                $query = mysqli_query($con, $sql)or die(mysqli_error($con));
                $row = mysqli_fetch_array($query);

                echo "Nume: <br>" . $row["title"] . "<br/>";
                echo "<a href=\"edit.php?id=" . $row['id'] . "\">Edit</a>";
                echo "<a href=\"delete.php?id=" . $row['id'] . "\" onclick=\"return confirm('Are you sure?')\">Delete</a>";
                //echo "Size: " . $row["size"] . "<br/>";
                echo "Preview: <br> <img src=" . $row['image'] . "><br/>";
                ?>



            </div>


            <br>


        </div>





    </body>

</html>