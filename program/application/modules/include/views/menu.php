<?php
$page = isset ($page) ? $page : 'home';

$dashboard = ($page == 'home') ? 'active' : '';
$admin = ($page == 'admin') ? 'active' : '';
$module = ($page == 'module') ? 'active' : '';
$preference = ($page == 'preference') ? 'active' : '';
?>

<div class="navbar <?=get_session('menu')?> navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

        <a class="brand logo" target="_blank" href="#"><img src="<?=base_url()?>assets/backend/img/logo-art.png" border="0" width="50px" height="25px" /></a>
        <div class="nav-collapse collapse">
        <p class="navbar-text pull-right">
            Logged in as <a href="<?=cms_url()?>account/profile" class="navbar-link"><span class="icon-user"></span> <?=username_en()?></a>
        </p>
        <ul class="nav">
            <li class="<?=$dashboard?>"><a href="<?=cms_url()?>"><span class="icon-home"></span> Dashboard</a></li>
            <?php if(user_role_en() == xml('role_dev')){?>
                <li class="dropdown <?=$admin?>">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="icon-user"></span> User Manager <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=cms_url()?>account"><span class="icon-list"></span> List user</a></li>
                        <li><a href="<?=cms_url()?>account/add"><span class="icon-plus"></span> Add new user</a></li>
                    </ul>
                </li>
            <?php }?>
                <li class="dropdown <?=$admin?>">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class=""></span> Maintenance <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php if(user_role_en() == xml('role_dev')){?>
                          <li><a href="<?=cms_url(FALSE)?>workstations/add"><span class="icon-plus"></span> Create Ticket (CM)</a></li>
                        <?php }?>
                        <!-- <li><a href="<?=cms_url(FALSE)?>company"><span class="icon-list-alt"></span> Company</a></li> -->
                        <li><a href="<?=cms_url(FALSE)?>machine_atm"><span class="icon-list-alt"></span> Machine ATM</a></li>
                        <li><a href="<?=cms_url(FALSE)?>workstations"><span class="icon-list"></span> Workstation's list</a></li>
                        <?php if(user_role_en() == xml('role_dev')){?>
                          <li><a href="<?=cms_url(FALSE)?>reports"><span class="icon-list-alt"></span> Report</a></li>
                        <?php }?>
                    </ul>
                </li>
            <!-- <li class="dropdown <?=$module?>">
                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"><span class="icon-book"></span> Menu <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=cms_url(FALSE)?>banners"><span class="icon-list"></span> Banners</a></li>
                    <li class="dropdown-submenu"><a href="#"><span class="icon-list-alt"></span> Services</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=cms_url(FALSE)?>categories_services"><span class="icon-list"></span>  Categories Services</a></li>
                            <li><a href="<?=cms_url(FALSE)?>services"><span class="icon-list"></span> Services</a></li>

                        </ul>
                    </li>
                    <li class="dropdown-submenu"><a href="#"><span class="icon-list-alt"></span> About</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=cms_url(FALSE)?>about"><span class="icon-list"></span>  About</a></li>
                            <li><a href="<?=cms_url(FALSE)?>timeline"><span class="icon-list"></span> Timeline</a></li>
                        </ul>
                    </li>


                    <li><a href="<?=cms_url(FALSE)?>clients"><span class="icon-list"></span> Clients</a></li>
                    <li><a href="<?=cms_url(FALSE)?>career"><span class="icon-list"></span> Career</a></li>
                    <li><a href="<?=cms_url(FALSE)?>blogs"><span class="icon-list"></span> Blogs</a></li>
                    <li><a href="<?=cms_url(FALSE)?>testimoni"><span class="icon-list"></span> Testimoni Client & Career</a></li>
                    <li><a href="<?=cms_url(FALSE)?>contact"><span class="icon-list"></span> Contact</a></li>
                    <li><a href="<?=cms_url(FALSE)?>messages"><span class="icon-list"></span> Messages</a></li>
                    <li><a href="<?=cms_url(FALSE)?>images"><span class="icon-picture"></span> Gallery Images</a></li>


                </ul>
            </li> -->
            <li><a href="<?=cms_url()?>logout"><span class="icon-off"></span> Logout</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
