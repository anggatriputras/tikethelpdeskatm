<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('include/head');?>
    </head>
    <body>
        <div class="navbar <?=get_session('menu')?> navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="<?=base_url()?>">Artajasa</a>
            </div>
          </div>
        </div>
        <div class="container min-content">
            <?php if(!empty ($msg)){?>
                <div class="alert alert-error">
                    <strong>Warning!</strong> <?=$msg?>
                </div>
            <?php } ?>
            <?=validation_errors()?>
            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Please sign in</h2>
                <div class="input-prepend">
                    <div class="add-on"><span class="icon-user"></span></div>
                    <input name="<?=form_username_en()?>" type="text" class="input-large" placeholder="Username">
                </div>
                <div class="input-prepend">
                    <div class="add-on"><span class="icon-wrench"></span></div>
                    <input name="<?=form_password_en()?>" type="password" class="input-large" placeholder="Password">
                </div>
                <button class="btn btn-large btn-primary" type="submit">Sign in</button>
            </form>
        </div>
        <?php $this->load->view('include/footer');?>
    </body>
</html>
