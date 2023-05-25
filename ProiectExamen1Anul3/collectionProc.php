<?php
require_once 'connectionPDO.php';

$sql0 = "DROP PROCEDURE IF EXISTS GetImages";
$sql1 = "CREATE PROCEDURE GetImages()
BEGIN
SELECT * FROM images;
END;";

$stmt0 = $con->prepare($sql0);
$stmt1 = $con->prepare($sql1);

$stmt0->execute();
$stmt1->execute();

$sql2 = "CALL GetImages()";
$q = $con->query($sql2);
$q->setFetchMode(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Collection cu Proceduri </title>
        <link rel="stylesheet" type="text/css" href="./css/stylesCollectionProc.css">
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

                <table>

                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>

                    <?php while ($res = $q->fetch()): ?>
                        <tr>
                            <td><?php echo $res['title']; ?></td>
                            <td><?php echo "<img src=" . $res['image'] . ">"; ?></td>
                            <td><?php echo "<a href=\"deleteProc.php?id=" . $res['id'] . "\">Delete item</a>" ?></td>
                        </tr>
                    <?php endwhile; ?>

                </table>

                <br/><br/>

                <a href="uploadProc.php">Upload </a>
                <a href="update.php">Edit</a>
                <a href="delete.php">Delete </a>

                <a href="getFlower.php">Get a certain id</a>




            </div>


            <br>


        </div>





    </body>

</html>

