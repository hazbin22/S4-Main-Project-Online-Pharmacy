<?php
session_start();
include('db_config.php');

if(isset($_GET['token']))
{
    $token=$_GET['token'];
    $verify_query = "SELECT reset_token,verify_status FROM customer_details WHERE reset_token='$token' LIMIT 1 ";
    $verify_query_run = mysqli_query($conn,$verify_query);

    if(mysqli_num_rows($verify_query_run)>0)
    {
        $row = mysqli_fetch_array($verify_query_run);
        //echo $row['verify_token'];
        if($row['verify_status'] == "0")
        {
            $clicked_token = $row['reset_token'];
            $update_query = "UPDATE customer_details SET verify_status='1' WHERE reset_token='$clicked_token' AND verify_status='0' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if($update_query_run)
            {
                $_SESSION["message"] = "Your Account has been verified successfully!";
                header('Location: login.php');
                exit(0);
            }
            else
            {
                $_SESSION["message"] = "Verification failed!";
                header('Location: login.php');
                exit(0);
            }
        }

        else
        {
            $_SESSION["message"] = "Email Already verified.please Login";
            header('Location:login.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION["message"] = "This token does not Exists";
        header('Location:login.php');
    }
}
else{
    $_SESSION["message"] = "Not Allowed";
     header('Location: login.php');
}

?>