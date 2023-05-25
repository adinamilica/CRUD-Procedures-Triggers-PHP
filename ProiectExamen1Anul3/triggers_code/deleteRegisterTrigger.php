<?php

$sql3 = "DROP TRIGGER IF EXISTS DeleteRegisterTrigger";
$sql4 = "CREATE TRIGGER DeleteRegisterTrigger BEFORE DELETE ON images FOR EACH ROW
    BEGIN
      INSERT INTO deleted_items(title, delete_date) VALUES(OLD.title, NOW());
    END;";

$stmt3 = $con->prepare($sql3);
$stmt4 = $con->prepare($sql4);

$stmt3->execute();
$stmt4->execute();

?>