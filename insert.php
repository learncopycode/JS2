<?php
$fullname = $_POST["fullname"];
$email= $_POST["email"];
$messages= $_POST["messages"];


if(!empty($username)||!empty($email)||!empty($messages)){

    $host="localhost";
    $dbUsername="thane_primary";
    $dbPassword="Thanex_2020";
    $dbname="thane_emailsThanex";

    $conn=new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if(mysqli_connect_error()){

        die('connect error ('.mysqli_connect_error().')'.mysqli_connect_error());   
    }

    else{

        $SELECT= "SELECT email From contactForm Where email=? Limit 1" ;
        $INSERT = "INSERT INTO contactForm (fullname, email, messages ) values(?,?,?)";

        $stmt=$conn ->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;

        if($rnum==0){
            $stmt->close();
            $stmt=$conn ->prepare($INSERT);
            $stmt->bind_param("sss", $fullname, $email, $messages);
            $stmt->exe  cute();
            echo "New record successfully inserted";

        }
        else{
            echo "You already contacted Thanex";


        }
        $stmt->close();
        $conn->close();





    }

}

else{

    echo "All fields are required to submit the form. Please try again.";
    die();
}