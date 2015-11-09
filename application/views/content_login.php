<div id="login">

  <form role="form" action=" <?php echo base_url()."login/process" ?> " method="post">
    <div class="form-group">
      <label for="inputUsername">Username</label>
      <input type="text" class="form-control" id="inputUsersname" name="username" placeholder="Username">
    </div>
    <div class="form-group">
      <label for="inputPassword">Password</label>
      <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
    </div>
    <?php
      if(isset($msg))
      {
        echo $msg;
      }
      else
      {
    ?>
    <div class="blank">
    </div>  
    <?php 
      }
    ?>
    
    <button type="submit" class="btn-login">LOGIN</button>
  </form>

</div>