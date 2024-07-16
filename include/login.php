<?php

session_start();


?>

<div style="padding-top: 5%;" class="login-box">
  <div class="card">
    <div class="card-header">
      <h3><?= $_please_login ?></h3>
    </div>
    <div class="card-body">
      <div class="text-center pd-5">
        <img src="img/favicon.png" alt="Sistema Logo" style="width:35%">
      </div>
      <div class="text-center">
        <span style="font-size: 25px; margin: 10px;">Sistema</span>
      </div>
      <center>
        <form autocomplete="off" action="" method="post">
          <table class="table" style="width:90%">
            <tr>
              <td class="align-middle text-center">
                <input style="width: 100%; height: 35px; font-size: 16px;" class="form-control" type="text" name="user"
                  id="_username" placeholder="Username" required="1" autofocus>
              </td>
            </tr>
            <tr>
              <td class="align-middle text-center">
                <input style="width: 100%; height: 35px; font-size: 16px;" class="form-control" type="password"
                  name="pass" placeholder="Password" required="1">
              </td>
            </tr>
            <tr>
              <td class="align-middle text-center">
                <input style="width: 100%; margin-top:20px; height: 35px; font-weight: bold; font-size: 17px;"
                  class="btn-login bg-primary pointer" type="submit" name="login" value="Login">
              </td>
            </tr>
            <tr>
              <td class="align-middle text-center">
                <?= $error; ?>
              </td>
            </tr>
          </table>
        </form>
      </center>
    </div>
  </div>
</div>

</body>

</html>