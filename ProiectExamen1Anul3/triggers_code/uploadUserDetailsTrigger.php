<?php
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
    
    ?>