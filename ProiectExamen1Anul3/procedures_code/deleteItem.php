<?php

$sql0 = "DROP PROCEDURE IF EXISTS deleteItem";
$sql1 = "CREATE PROCEDURE deleteItem(
IN strId int(11)
)
BEGIN
DELETE FROM images WHERE id=strId;
END; ";

$stmt0 = $con->prepare($sql0);
$stmt1 = $con->prepare($sql1);

$stmt0->execute();
$stmt1->execute();
?>

<?php

$sql2 = "CALL deleteItem('{$id}')";
$q = $con->query($sql2);

if ($q)
    header('Location: collectionProc.php');
?>