<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>Contact</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap4/css/bootstrap.css"> <!-- Using Bootstrap 4 -->
        <link rel="stylesheet" href="bookaday/style.css"> <!-- Original Stylesheet -->
        <script src="https://kit.fontawesome.com/2eeb0a3584.js" crossorigin="anonymous"></script> <!-- Fontawesome Icons -->
    </head>
    <section class = "contactMain">
      <body> 

        <?php
        include("bookaday/php/header.php");
        ?>

        <section class = "contactSection">  
            <div class="py-5 text-center">
                <h2>Contact Us</h2>
                <p class="lead">Looking to get in touch? Look no further, find ways to reach us below.</p>
            </div>
            
            <!-- Cards -->
            <div class="contact-cards">
                <!-- Card 1 Phone -->
                <div class="card" style="width: 20rem;"> <!-- Using Bootstrap 4 cards to create a contact section -->
                    <span class="card-icon"><i class="fas fa-phone-alt"></i></span>
                    <div class="card-body">
                    <h5 class="card-title">Call us</h5>
                    <p class="card-text">Give us a call or leave us a message to find out more.</p><br>
                    <a href="tel:123-456-7890" class="btn btn-primary">Call 123-456-789</a>
                    </div>
                </div>
                <!-- Card 2 Email -->
                <div class="card" style="width: 20rem;"> <!-- Using Bootstrap 4 cards to create a contact section -->
                    <span class="card-icon"><i class="fas fa-envelope"></i></span>
                    <div class="card-body">
                    <h5 class="card-title">Email us</h5>
                    <p class="card-text">Send us a quick email to find out more.</p><br>
                    <a href="mailto:info@bookaday" class="btn btn-primary">Email info@bookaday</a>
                    </div>
                </div>
                <!-- Card 3 Adddress -->
                <div class="card black-link" style="width: 40rem;"> <!-- Using Bootstrap 4 cards to create a contact section -->
                    <span class="card-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <div class="card-body">
                    <h5 class="card-title">Stop by our Office</h5>
                    <p class="card-text">Opening hours: </p>
                    <p class="card-text">Mon-Fri:  09:00 AM - 02:00 PM</p>
                    <p class="card-text"><a href="https://goo.gl/maps/vDE2kq82vYsBtDNM9" target="blank">Address:  420 W 4th St #35, Los Angeles, CA 90013, United States</a></p>
                    <a href="" class="btn btn-primary loggedin">Book an Appointment</a>
                    </div>
                </div>
            </div>

            <!-- Contact Book using Bootstrap 4 -->
            <div class="card contact-book ">
                <div class="col-md-12 order-md-1 contact-form">
                    <h4 class="mb-3">Request an Appointment</h4>
                    <p class="mb-3">Please pick a time slot within business hours.</p>

                    <form class="needs-validation" method="POST" action="bookaday/php/cback.php" >
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="name">First name</label>
                          <input type="text" class="form-control" id="name" name="name_first" placeholder="John" value="" required>
                          <div class="invalid-feedback">
                            Valid first name is required.
                          </div>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label for="lastname">Last name</label>
                          <input type="text" class="form-control" id="namelast" name="name_last" placeholder="Doe" value="" required>
                          <div class="invalid-feedback">
                            Valid last name is required.
                          </div>
                        </div>
                      </div>
          
                      <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="" required>
                        <div class="invalid-feedback">
                          Please enter a valid email address for shipping updates.
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="title">Reason for Appointment</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="To discuss a booking" value="" required>
                        <div class="invalid-feedback">
                          Please enter a valid appointment title.
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="mm/dd/yyyy" value="" required>
                        <div class="invalid-feedback">
                          Please pick a date within business hours.
                        </div>
                      </div>
          
                      <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time" placeholder="time" value="" required>
                            <div class="invalid-feedback">
                              Please pick a valid time slot within business hours.
                            </div>
                        </div>
                      </div>
                      <hr class="mb-4">
                      <button class="btn btn-primary btn-lg btn-block" type="submit" name='submit'>Request Appointment</button>
                    </form>
                  </div>
                </div>
            </div>
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
            headerCurrent("contact");
          </script>
    </body>
  </html>