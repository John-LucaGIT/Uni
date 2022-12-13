<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>BTM - GARITS : Database Management</title>
    </head>

    <body>
        <!-- Page Title -->

        <div class="btm black-link pageTitle">
                <a href="../admin.php">
                    <i class="btm backButton fa-2x fa-solid fa-circle-left"></i>
                </a>
                <h2 class="btmTitle">Database Management</h2>
        </div>

        <!-- Error Messages -->

        <?php
            $type = "warning";
            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case "insufficient permissions":
                        $type = "primary";
                        $errorMsg = "You do not have sufficient permissions to view this page!";
                        break;
                    case "no file selected":
                        $errorMsg = "No file was selected! Please select a .sql file to restore the database!";
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
                        case "success db":
                            $msg = "You have successfully downloaded a database backup!";
                            break;
                }
                echo "
                <div class='center alert alert-".$type."'>
                        <strong>Info:</strong> ".$msg."
                </div>
                ";
            }                               
        ?>

        <section class="db section">
            <h3 class="db title center">Database Actions</h3>
            <div class="btm admin db card">
                <form action='assets/php/dbback.php' method='POST'>
                    <div class="row justify-content-center">
                        <div class="card col-3 bg-dark text-white ">
                            <label class="btmcenter center" for="dbpull" >Pull Database</label>
                            <button type="submit" id="dbpull" name='dbpull' class="btmcenter block btn btn-warning"><i class="fa-solid fa-3x fa-code-pull-request"></i></button>
                        </div>

                        <div class="card col-3 bg-dark text-white ">
                            <label class="btmcenter center" for="dbpush" >Push to Database</label>
                            <label class="btmcenter center" for="myfile">Select a file: <span class="required">*</span></label>
                            <input class="btmcenter center" type="file" id="myfile" name="myfile">
                            <button type="submit" id="dbpush" name='dbpush' class="btmcenter block btn btn-info"><i class="fa-solid fa-3x fa-cloud-arrow-up"></i></button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </body>
</html>

<script type="text/javascript">
$(document).ready(function() {
    $("input[type=file]").nicefileinput();
});
</script>
