<script type="text/javascript">
    $(function() {       
        $("form[name='registration']").validate({
          rules: {
            username: "required",
            email: {
              required: true,
              email: true
            },
            pwd: {
              required: true,
              minlength: 5
            }
          },
          
          messages: {
            username: "Please enter your username",
            pwd: {
              required: "Please provide a password",
              minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
          },
          
          submitHandler: function(form) {
            form.submit();
          }
        });
      });
    </script>

<body>


<div class="container register-form">
  <h2>User Registration</h2>
  <?php if(isset($message)){ ?>
    <div class="alert alert-danger">
      <strong>Warning!</strong> <?php echo $message ?>
    </div>  
  <?php } ?>
  <form class="form-horizontal" name="registration" action="<?php echo base_url(); ?>index.php/register/insert_user">
    <div class="form-group">
      <label class="control-label col-sm-2" for="username">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd" >Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="submit_but" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>