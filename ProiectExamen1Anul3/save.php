
<?php

require_once "connection.php";
$msg="";

if(isset($_POST['upload'])){
    
    //$_FILES is an associative array containing items uploaded via HTTP POST method
    //introducem file-urile din post in folder-ul local "images" cu nume encryptat cu md5
    //luam path-ul imaginii de abia introduse si il memoram in $target
    
    $target="./images/". md5(uniqid(time())). basename($_FILES['image']['name']);

    $text=$_POST['text'];
    
    //avand salvate in cele doua variabile, $target si $text...
    //...pentru incarcarea imaginii in database,
    // facem acest lucru 
    //specificiam tabelul si field-urile modificate cu valorile din variabile
   
    $sql="INSERT INTO images(title, image)VALUES('$text','$target')";
    
    mysqli_query($con,$sql);
    
    if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
        
       //daca s-a uploadat corect,redirect la alta pagina 
       header('location:for_visitors.php');
       
    }
    
    else{
        
       //daca NU s-a uploadat corect, mesaj 
        $msg="Vai! Vai! Vai!!!";
        echo $msg;
        
    }
}