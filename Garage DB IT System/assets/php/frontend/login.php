<!-- Login Section -->

<div class="card text-center center btmcenter btmlogin">
  <div class="card-body lformcard">
    <h5 class="card-title">Login</h5>
    <img class="login btm logo" src="/assets/images/btmlogo.png" alt="" width="180" height="180">
    <p class=card-text>Required fields are marked with a red Asterisk <span class="required">*</span></p>
    <form action="assets/php/lback.php" method="POST">
      <div class="btmlreg btmcenter">
          <label for="inputEmail" class="sr-only">Email</label>
          <small id="emailHelp" class="form-text text-muted">Enter your E-Mail Address.<span class="required">*</span></small>
          <input type="email" id="inputEmail" class="form-control" placeholder="email@provider.com" name="email" required autofocus>
      </div>

      <div class="btmlreg btmcenter">
          <label for="inputPassword" class="sr-only">Password</label>
          <small id="passwordHelp" class="form-text text-muted">Enter your Password.<span class="required">*</span></small>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
      </div>  
        <p class="card-text"></p>
        <button type="submit" name="submit" class="btn btn-black display-4">Login</button>
    </form>
  </div>
</div>