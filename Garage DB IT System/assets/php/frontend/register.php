<!-- Registration Section -->

<?php 
  if($_SESSION['role'] == 4){
    $type = "Customer";
    $hide = "hiddenfields";
    $d = "disabled";
  }else{
    $type = "User";
  }
?>

<div class="card text-center center btmcenter btmlogin">
  <div class="card-body btmregcard">
    <h5 class="card-title">Register <?php echo $type; ?></h5>
    <img class="register btm logo" src="/assets/images/btmlogo.png" alt="" width="180" height="180">
    <p class=card-text>Required fields are marked with a red Asterisk <span class="required">*</span></p>

    <form action="assets/php/rback.php" method="POST">

      <div class="btmlreg btmcenter">
          <label for="inputEmail" class="sr-only">Email</label>
          <small id="emailHelp" class="form-text text-muted">Enter E-Mail Address. <span class="required">*</span></small>
          <input type="email" id="inputEmail" class="form-control" placeholder="email@provider.com" name="email" required autofocus>
      </div>      

      <div class="<?php echo $hide; ?> btmlreg btmcenter">
          <label for="inputPassword" class="sr-only">Password</label>
          <small id="passwordHelp" class="form-text text-muted">Enter a Password. <span class="required">*</span></small>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" <?php echo $d; ?> required>
      </div>

      <div class="<?php echo $hide; ?> btmlreg btmcenter roleselect" id="addrole">
          <label for="userChangeRole" class="sr-only">Password</label>
          <small id="userChangeRole" class="form-text text-muted">Add Role to User. <span class="required">*</span></small>
          <div class='input-group mb-3'>
              <div class='input-group-prepend'>
                    <label class='input-group-text' for='inputGroupSelect01'>Role</label>
              </div>
                <select class='custom-select' type="<?php echo $d; ?>" name='userChangeRole' id='userChangeRole' >
                      <option selected >Choose...</option>
                      <option value='1'>Receptionist</option>
                      <option value='2'>Mechanic</option>
                      <option value='3'>Foreperson</option>
                      <option value='4'>Franchisee</option>
                      <option value='5'>Administrator</option>
                </select>
          </div>
      </div>

      <div class= "row">

        <div class="col btmlreg btmcenter hiddenfields" id="addfields0">
            <label for="inputName" class="sr-only">Name</label>
            <small id="nameHelp" class="form-text text-muted">Enter Name.</small>
            <input type="name" id="inputName" class="form-control" placeholder="Name" name="name_first">
        </div>

        <div class="col btmlreg btmcenter hiddenfields" id="addfields1">
            <label for="inputLast" class="sr-only">Last Name</label>
            <small id="lastHelp" class="form-text text-muted">Enter Last Name.</small>
            <input type="name" id="inputLast" class="form-control" placeholder="Last Name" name="name_last">
        </div>

      </div>

      <div class= "row">

        <div class="col btmlreg btmcenter hiddenfields" id="addfields2">
            <label for="tel" class="sr-only">Tel. Number</label>
            <small id="tel" class="form-text text-muted">Enter Tel. Number.</small>
            <input type="tel" id="tel" class="form-control" placeholder="Tel. Number" name="tel">
        </div>

        <div class="col btmlreg btmcenter hiddenfields" id="addfields3">
            <label for="fax" class="sr-only">Fax. Number</label>
            <small id="fax" class="form-text text-muted">Enter Fax Number.</small>
            <input type="tel" id="fax" class="form-control" placeholder="Fax Number" name="fax">
        </div>
      
      </div>

      <div class= "row">
        <div class="col btmlreg addfields btmcenter hiddenfields" id="addfields4">
            <label for="address" class="sr-only">Address</label>
            <small id="address" class="form-text text-muted">Enter Address.</small>
            <input type="address" id="address" class="form-control" placeholder="Address" name="address">
        </div>

        <div class="col btmlreg btmcenter hiddenfields" id="addfields5">
            <label for="postcode" class="sr-only">Post Code</label>
            <small id="postcode" class="form-text text-muted">Enter Postcode.</small>
            <input type="postcode" id="postecode" class="form-control" placeholder="Postecode" name="postcode">
        </div>
      </div>

        <p class="card-text"></p>
        <a onclick="hiddenFields()" class="btn btn-outline-primary">Add Details</a>
        <button type="submit" name="submit" class="btn btn-black display-4">Register</button>
    </form>
  </div>
</div>
