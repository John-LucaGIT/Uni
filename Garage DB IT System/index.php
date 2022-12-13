<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>BTM | GARITS : Login</title>
        <?php
            include_once('assets/php/includes.php');
        ?>
    </head>
    <body>
        <header>
            <?php
                include_once('assets/php/header.php');
            ?>
        </header>

        <?php
            include_once('assets/php/frontend/login.php');
            $type = "warning";
            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case "loginFailure":
                        $type = "danger";
                        $errorMsg = "User not found";
                        break;
                    case "loginFailure password": 
                        $type = "danger";
                        $errorMsg = "No user found with this username & password combination!";
                        break;
                    case "invalidEmail":
                        $errorMsg = "Please enter a valid email address!";
                        break;
                    case "stmtfailure":
                        $type = "danger";
                        $errorMsg = "Server issue. Please contact site administrator!";
                    case "emptyinput":
                        $errorMsg = "Please enter a valid email address and your password!";
                        break;
                    case "insufficient permissions":
                        $type = "primary";
                        $errorMsg = "You do not have sufficient permissions to view this page!";
                        break;
                    default: 
                        $errorMsg = "OOPS! Some problem.";

                }
                echo "
                <div class='center alert alert-".$type."'>
                    <strong>Error:</strong> ".$errorMsg."
                </div>
                ";
            }
            if(isset($_GET['status'])){
                switch($_GET['status']){
                        case "goodbye":
                            $type = "success";
                            $msg = "You have successfully logged out. Goodbye.";
                            break;
                }
                echo "
                <div class='center alert alert-".$type."'>
                        <strong>Info:</strong> ".$msg."
                </div>
                ";
            }           
        ?>



        <?php
            include_once('assets/php/frontend/footer.php');
        ?>
    </body>
</html>