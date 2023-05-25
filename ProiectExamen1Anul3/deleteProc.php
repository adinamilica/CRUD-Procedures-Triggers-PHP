<?php

require_once 'connectionPDO.php';

//obtinerea id-ului itemului pe care vrem sa-l stergem

$id = $_GET['id'];

//procedura de stergere item

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

//trigger de inregistrare a stergerii

$sql3 = "DROP TRIGGER IF EXISTS DeleteRegisterTrigger";
$sql4 = "CREATE TRIGGER DeleteRegisterTrigger BEFORE DELETE ON images FOR EACH ROW
    BEGIN
      INSERT INTO deleted_items(title, delete_date) VALUES(OLD.title, NOW());
    END;";

$stmt3 = $con->prepare($sql3);
$stmt4 = $con->prepare($sql4);

$stmt3->execute();
$stmt4->execute();

//Call procedura de stergere

$sql2 = "CALL deleteItem('{$id}')";
$q = $con->query($sql2);

if ($q)
    header('Location: collectionProc.php');

?>
