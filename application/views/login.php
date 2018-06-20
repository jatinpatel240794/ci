<script type="text/javascript">
     $(function() {
      
         $("#signin_but").click(function(){
            username1 = $("#username").val();
            password1 = $("#password").val();
            if($("#username").val() == ''){
              alert('PLease Enter UserName');
            }else if($("#password").val() == ''){
              alert('PLease Enter Password');
            }else{
              urldata="username="+username1+"&password="+password1;
              url="<?php echo base_url(); ?>index.php/register/check_validation?"+urldata;
              $.ajax({url,success: function(data) {
                
                  if(data == 'success'){
                    window.location.href="<?php echo base_url(); ?>index.php/mapview/map_view";
                    return false;                      
                  }else{
                    alert("Invalid USername or password");
                     $("#username").val('');
                    $("#password").val('');
                     return false;
                  }
                  
                }});
            }
         });
     });

</script>
<div class="login-form">
  
    <form>
        <h2 class="text-center">Sign in</h2>  
    
         <div class="form-group">
            <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control" id="username" placeholder="Username" required="required" value="">
              </div>
          </div>
           <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" placeholder="Password" required="required">
                </div>
            </div>        
          <div class="">
              <a id="signin_but" class="btn btn-success btn-block">Sign in</a>              
          </div>
              
      <div class="or"><i>or</i></div>
          <div class="text-center social-btn">
            <a href="<?php if(isset($authUrl))echo $authUrl; ?>" class="btn btn-danger btn-block"><i class="fa fa-google"></i> Sign in with <b>Google</b></a>
            
        </div>
          <div class="or"><i></i></div>
          <div class="text-center social-btn">
            <a href="<?php echo base_url(); ?>index.php/ExcelSheet" class="btn btn-danger btn-block"><i class="fa fa-google"></i> Technical Assignment Excel</b></a>
            
        </div>
                  
    </form>
    <div class="hint-text small">Don't have an account? <a href="<?php echo base_url(); ?>index.php/Register" class="text-success">Register Now!</a></div>
</div>


</body>
</html>
