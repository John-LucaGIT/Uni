<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap4/css/bootstrap.css"> <!-- Using Bootstrap 4 -->
        <link rel="stylesheet" href="bookaday/style.css"> <!-- Original Stylesheet -->
        <script src="https://kit.fontawesome.com/2eeb0a3584.js" crossorigin="anonymous"></script> <!-- Fontawesome Icons -->
    </head>
    <section class = "myAccountMain">
      <body> 
        <?php
        include("bookaday/php/header.php");
        include("bookaday/php/connectdb.php");
            if(empty($_SESSION["email"])){
                header("location: /index");
            }
        ?>
        <section class="accountAppt">
            <div class="acc card">
                <h3 class="center">My Appointments</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Reason for Appointment</th>
                            <th scope="col">Date of Appointment</th>
                            <th scope="col">Time of Appointment</th>
                            <th scope="col">Name on Appointment</th>
                            <th scope="col">Last name on Appointment</th>
                            <th scope="col">Email on Appointment</th>
                            <th scope="col">Appointment Status</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                if(isset($_SESSION["email"])){
                    $query = mysqli_query($conn,"SELECT * FROM bookings WHERE email LIKE '{$_SESSION['email']}' ORDER BY BID DESC");
                    $result = mysqli_num_rows($query);
                    if($result >= 1){
                        while($row = mysqli_fetch_assoc($query)){
                            $bid = $row["BID"];
                            $name_last = $row["lastName"];
                            $name_first = $row["firstName"];
                            $email = $row["email"];
                            $title = $row["title"];
                            $date = $row["date"];
                            $time = $row["time"];
                            $confirmed = $row["confirmed"];
                            echo "
                            <tr>
                                <th scope='row'>{$bid}</th>
                                    <td>{$title}</td>
                                    <td>{$date}</td>
                                    <td>{$time}</td>
                                    <td>{$name_first}</td>
                                    <td>{$name_last}</td>
                                    <td>{$email}</td>
                                    <td>{$confirmed}</td>
                                </tr>
                            ";
                        }
                    }
                    else{
                        echo "<p class = 'black-link center'>You have no appointments. Click <a href='contact'>here</a> to schedule one.</p>";
                    }
                }
            ?>
                </tbody>
            </table>
            <div>
        </section>
        
        <?php
        include("bookaday/php/footer.php");
        ?>

    </section>
        <!-- Including necessary scripts for bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tether@2.0.0-beta.5/js/tether.min.js"></script>
        <script src="bootstrap4/js/bootstrap.min.js"></script>
        <script src="bootstrap4/js/bootstrap.js"></script>
        <!-- My Validation Script -->
        <script src="bookaday/js/validate.js"></script>         
        <script>
          headerCurrent("account");
        </script>
  </body>
</html>