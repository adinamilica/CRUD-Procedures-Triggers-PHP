<?php
require_once 'connectionPDO.php';

if (isset($_POST['submit'])) {

    // encriptarea imaginii din requestul de post
    $image = "./images/" . md5(uniqid(time())) . basename($_FILES['image']['name']);

    // mutare in folder
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    //luarea titlului din request-ul de post
    $title = $_POST['title'];

    // procedura de inserare

    $sql0 = "DROP PROCEDURE IF EXISTS uploadItem";
    $sql1 = "CREATE PROCEDURE uploadItem(
IN strTitle varchar(100),
IN strImage varchar(100)
)
BEGIN 
INSERT INTO images
(title, image)
VALUES (strTitle, strImage);
END;";

    $stmt0 = $con->prepare($sql0);
    $stmt1 = $con->prepare($sql1);

    $stmt0->execute();
    $stmt1->execute();

    // trigger care transforma litere mici in mari inainte de inserare

    $sql3 = "DROP TRIGGER IF EXISTS FormattingTrigger";
    $sql4 = "CREATE TRIGGER FormattingTrigger BEFORE INSERT ON images FOR EACH ROW
    BEGIN
    SET NEW.title = UPPER(NEW.title);
    END;";

    $stmt3 = $con->prepare($sql3);
    $stmt4 = $con->prepare($sql4);

    $stmt3->execute();
    $stmt4->execute();

    // trigger care adauga ip-ul user-ului si data la care incarca ceva in new_items table

    // the IP address obtained from $_SERVER['REMOTE_ADDR'] may not always be the actual IP address of the visitor due to the presence of proxies or load balancers.
    $visitorIP = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $visitorIP = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $visitorIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    

    $sql5 = "DROP TRIGGER IF EXISTS uploadUserDetailsTrigger";
    $sql6 = "CREATE TRIGGER uploadUserDetailsTrigger AFTER INSERT ON images FOR EACH ROW
    BEGIN
    INSERT INTO new_items(user_ip, new_date) VALUES( '$visitorIP' , NOW());
    END;";

    $stmt5 = $con->prepare($sql5);
    $stmt6 = $con->prepare($sql6);

    $stmt5->execute();
    $stmt6->execute();

    //Call procedura de inserare

    $sql2 = "CALL uploadItem('{$title}','{$image}')";
    $q = $con->query($sql2);

    if ($q)
        header('location:collectionProc.php');
    else
        echo "Problema upload";
}
?>

<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Upload Page cu Proceduri </title>
        <link rel="stylesheet" type="text/css" href="./css/upload_styling.css">
    </head>
    <body>
        <div class="main-container">

            <div class="nav-container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="for_visitors.php">Collection</a></li>
                    <li><a href="upload.php">Upload</a></li>
                </ul>
            </div>
            <div class="center-stuff-upload">

                <h1>Incarcati articol:</h1>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                    Titlu:<br/><input type="text" name="title" placeholder="Introdu un titlu"/><br><br>

                    Image: <br/><input type="file" name="image" ><br><br>

                    <input type="submit" name="submit" value="Upload item"/><br><br>

                </form>

            </div>
        </div>
    </body>
</html>
