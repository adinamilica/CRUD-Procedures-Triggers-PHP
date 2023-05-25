<?php

$sql3 = "DROP TRIGGER IF EXISTS FormattingTrigger";
$sql4 = "CREATE TRIGGER FormattingTrigger BEFORE INSERT ON images FOR EACH ROW
    BEGIN
    SET NEW.title = UPPER(NEW.title);
    END;";

$stmt3 = $con->prepare($sql3);
$stmt4 = $con->prepare($sql4);

$stmt3->execute();
$stmt4->execute();

?>