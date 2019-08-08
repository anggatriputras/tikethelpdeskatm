<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('include/head');?>
    </head>
    <body>
        <?php $this->load->view('include/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">User Manager</a> <span class="divider">/</span></li>
                <li><a href="<?=cms_url()?>account">User</a> <span class="divider">/</span></li>
                <li class="active">Edit</li>
            </ul>
            <form method="post" class="form-horizontal">
                <?php if(!empty ($status)){?>
                    <?php if($status=='username'){?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong> Username sudah diguakan
                        </div>
                    <?php }?>
                <?php } ?>

                <?php echo validation_errors();?>
                <div class="row-fluid">
                    <div class="span12">
                        <div>
                            <label>Full Name :</label>
                            <input class="span5" type="text" name="full_name" placeholder="Full name" value="<?=$row->full_name?>">
                        </div>
                        <div class="top-10">
                            <label>Username :</label>
                            <input class="span5" type="text" name="username" placeholder="Username" value="<?=$row->username?>">
                        </div>
                        <div class="top-10">
                            <label>Password :</label>
                            <input class="span5" type="password" name="password" placeholder="Password">
                        </div>
                        <div class="top-10">
                            <label>Role :</label>
                            <label class="radio">
                                <input type="radio" name="role" value="<?=xml('role_dev')?>" <?=$v = $row->role==xml('role_dev') ? 'checked' :''?>>
                                Helpdesk
                            </label>
                            <label class="radio">
                                <input type="radio" name="role" value="<?=xml('role_com')?>" <?=$v = $row->role==xml('role_com') ? 'checked' :''?>>
                                Company
                            </label>
                            <label class="radio">
                                <input type="radio" name="role" value="<?=xml('role_eng')?>" <?=$v = $row->role==xml('role_eng') ? 'checked' :''?>>
                                Enginer
                            </label>
                        </div>
                        <div class="top-10">
                            <label>Lock :</label>
                            <label class="checkbox">
                                <input name="is_lock" <?=$v = $row->is_lock ? 'checked' :''?> type="checkbox" value="on">
                                Is lock
                            </label>
                        </div>

                        <div class="top-10">
                            <label>Kota :</label>
                            <input class="span5" type="text" name="kota" placeholder="Kota" value="<?=$row->kota?>">
                        </div>

                        <div class="top-20">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="<?=cms_url()?>account" class="btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>
