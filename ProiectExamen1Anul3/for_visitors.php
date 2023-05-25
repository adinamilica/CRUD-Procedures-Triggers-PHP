<?php
//include connection file
include 'connection.php';
$sql = 'SELECT * FROM images;';
$query = mysqli_query($con, $sql)or die(mysqli_error($con));
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Collection </title>
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
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

            <div style=" display:flex; flex-direction: column; margin:auto;">

                <h3 style="margin:auto; padding:10px; font-size: 30px; ">Gallery</h3>
                <br><br>

                <table style="margin:auto; display:flex; flex-direction: row; flex-wrap:wrap;"width="100%" cellpadding="4" cellspace="4" >


                    <?php while ($row = mysqli_fetch_array($query)) { ?>



                        <td style="margin:auto;">

                            <?php echo $row['title']; ?>

                            <br><br>

                            <img style="width:200px; height:200px;" src="<?php echo $row['image']; ?>">

                            <br><br>

                            <button class="gallery-button"><?php echo "<a href=\"view.php?id=" . $row['id'] . "\">View</a>" ?></button>

                        </td>




                    <?php } ?>


                </table>


            </div>


            <br>


        </div>





    </body>

</html>