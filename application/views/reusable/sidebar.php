<style type="">
  @media print {
    .no-print, .no-print *{
      display: none !important;
    }
  }
</style>
<nav class="side-navbar no-print">
  <div class="side-navbar-wrapper">
    <div class="sidenav-header d-flex align-items-center justify-content-center" style="font-size: 13px;">
      <div class="sidenav-header-inner text-center" >
        <?php
          if($this->session->has_userdata('userSession')){
            $userprofile="";
            $userprofile = $this->session->userdata['userSession']['user_profpic'];
            if($userprofile!="" && file_exists($userprofile)){
              echo '
              <img src="'.base_url().$userprofile.'?ts='.date("h:i:s").'" alt="person" class="img-fluid rounded-circle">';
            }else{
              echo '
              <img src="'.base_url().'assets/img/nodp.png?ts='.date("h:i:s").'" alt="person" class="img-fluid rounded-circle">';
            }
          }
          else{
            redirect(base_url() . 'Welcome/logIn');
          }
        ?>
        <h2 class="h4 text-uppercase" style="font-size: 15px;">
        <?php
          if($this->session->has_userdata('userSession')){
            $usID = $this->session->userdata['userSession']['user_ID'];
            $usName = $this->session->userdata['userSession']['user_WholeName'];
            $usPos = $this->session->userdata['userSession']['user_pos'];
            echo $usName;
          }
          else{
            redirect(base_url() . 'Welcome/logIn');
          }
        ?>
        </h2><span class="text-uppercase" style="color:white;">
        <?php
          echo $usPos;
        ?>
        </span>
      </div>
      <div class="sidenav-header-logo"><a href="<?php echo site_url();?>Welcome/dashboard" class="brand-small text-center"> <strong>F</strong><strong class="text-primary">C</strong><strong class="text-primary">A</strong></a></div>
    </div>
    <div class="admin-menu">
      <ul id="side-admin-menu" class="side-menu list-unstyled">

        <li> <a href="<?php echo base_url('Inventory/deliveryDash');?>"> <i class="fas fa-truck"></i><span>Delivery</span></a></li>
        <li> <a href="<?php echo base_url('Inventory/mainDash');?>"> <i class="far fa-clipboard"></i><span>Inventory</span></a></li>
        <li> <a href="<?php echo site_url();?>ProductsV2"> <i class="fas fa-clipboard-list"></i><span>Productsv2</span></a></li>
        <li> <a href="<?php echo site_url();?>Products"> <i class="fas fa-clipboard-list"></i><span>Products</span></a></li>
        <li> <a href="#pages-nav-list2" data-toggle="collapse" aria-expanded="false"><i class="far fa-address-book"></i><span>User Settings</span>
              <div class="arrow pull-right"><i class="fa fa-angle-down"></i></div>
             </a>
          <ul id="pages-nav-list2" class="collapse list-unstyled">
            <li> <a href="<?php echo base_url('Admin/perUserEdit');?>"><i class="far fa-edit"></i></i>Edit Account</a></li>
            <li> <a href="<?php echo base_url('Admin/changePass');?>"><i class="fas fa-key"></i>Change Password</a></li>
          </ul>
        </li>
        <?php
        $id = $this->session->userdata['userSession']['user_groupId'];
        if($id<2){
          echo '<li><a href="'.base_url('Admin/index').'"><i class="fas fa-user-plus"></i><span>Admin Dashboard</span>  </a></li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<div class="page home-page">
  <!-- navbar-->
  <header class="header no-print" style="position: sticky; width: 100%;">
    <nav class="navbar no-print">
      <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between">
          <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="<?php echo site_url();?>Welcome/dashboard" class="navbar-brand">
              <div class="brand-text d-none d-md-inline-block"><span style="color:white;">Flood Control Asia </span><strong class="text-primary">   WIP</strong></div></a></div>
          </span><ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center no-print">
            <li class="nav-item">
            <li>
              &emsp;
            </li>
            <li class="nav-item"><a href="<?php echo base_url('Welcome/logout');?>"><span id="logout">Logout  <i class="fas fa-sign-out-alt"></i></span></a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        