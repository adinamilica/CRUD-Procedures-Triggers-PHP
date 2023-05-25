<?php

$sql0 = "DROP PROCEDURE IF EXISTS GetImages";
$sql1 = "CREATE PROCEDURE GetImages()
BEGIN
SELECT * FROM images;
END;";

$stmt0 = $con->prepare($sql0);
$stmt1 = $con->prepare($sql1);

$stmt0->execute();
$stmt1->execute();

?>

<?php

$sql2 = "CALL GetImages()";
$q = $con->query($sql2);
$q->setFetchMode(PDO::FETCH_ASSOC);

?>