<div class="page login-page">
  <div class="container">
    <div class="form-outer text-center d-flex align-items-center">
      <div class="form-control form-inner" style=" box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);">
        <!-- <div>
          <i class="fa fa-wordpress fa-5x text-primary" aria-hidden="true" ></i>
        </div>-->
        <div >
          <img src="<?php echo base_url();?>/assets/img/fca-logo-xprt_400.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="logo text-uppercase"><strong class="text-primary" id="blinkme">WIP</strong></div>
          <div id="wait">
            <?php
              echo validation_errors();
              echo form_open(site_url('Home/verifyLogIn'));
            ?>
            <div class="form-group">
                <label for="login-username" class="label-custom" style="text-align: left;">User Name</label>
                <input id="login-username" type="text" name="loginUsername" required="" autofocus>
            </div>
            <div class="form-group">
              <label for="login-password" class="label-custom" style="text-align: left;">Password</label>
              <input id="login-password" type="password" name="loginPassword" required="">
            </div>
              <input type="submit" class="btn btn-primary" name="btnSubmit" value="Login"/>
            </form>
          </div>
          <div class="copyrights text-center">
            <p>Developed by: <a href="http://klipp.tv/" class="external">ICT Department of Dr. Klippe Phil. Co.</a></p>
        </div>
      <div>
    </div>
  </div>
</div>











    <script>
    // $( document ).ready(function() {
    //   var bool = "";
    //   $('#wait').hide();
    //   function blinker(){
    //     $('#blinkme').fadeOut(122);
    //     $('#blinkme').fadeIn(122);
    //     setTimeout(done, 1);
    //   }

    //   var bool = setInterval(blinker, 500);
    //   function done(){
    //       clearInterval(bool);
    //       setTimeout(getready, 1500);

    //   }
    //   function getready() {
    //     $('#wait').show(500);
    //   }
    // });

    </script>    