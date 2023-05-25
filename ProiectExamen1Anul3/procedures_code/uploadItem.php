<?php

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
?>

<?php

$sql2 = "CALL uploadItem('{$title}','{$image}')";
$q = $con->query($sql2);

if ($q)
    header('location:collectionProc.php');
else
    echo "Problema upload";
?>