<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('include/head');?>
    </head>
    <body>
        <?php $this->load->view('include/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="<?=cms_url()?>account/profile">Profile</a> <span class="divider">/</span></li>
                <li class="active">Edit</li>
            </ul>
            <form method="post" class="form-horizontal">
                <?php if($status=='success'){?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> Update data success.
                    </div>
                <?php }?>

                <?php echo validation_errors();?>
                <div class="row-fluid">
                    <div class="span12">
                        <div>
                            <label>Username :</label>
                            <strong><?=username_en()?></strong>
                        </div>
                        <div class="top-10">
                            <label>Full Name :</label>
                            <input class="span5" type="text" name="full_name" placeholder="Full name" value="<?=$row->full_name?>">
                        </div>
                        <div class="top-10">
                            <label>Password :</label>
                            <input class="span5" type="password" name="password" placeholder="Password">
                        </div>

                        <div class="top-10">
                            <label>Birthday :</label>
                            <input class="span5 datepicker" type="text" name="birthday" placeholder="Full name" value="<?=$row->birthday?>">
                        </div>
                        <div class="top-10">
                            <label>Email :</label>
                            <input class="span5" type="text" name="email" placeholder="Full name" value="<?=$row->email?>">
                        </div>
                        <div class="top-10">
                            <label>Phone :</label>
                            <input class="span5" type="text" name="phone" placeholder="Full name" value="<?=$row->phone?>">
                        </div>
                        <div class="top-10">
                            <label>Kota :</label>
                            <input class="span5" type="text" name="kota" placeholder="Full name" value="<?=$row->kota?>">
                        </div>

                        <div class="top-10">
                          <div class="control-group">
                              <label>Note :</label>
                              <textarea name="address" rows="5" cols="10"  class="input-block-level" style="width: 500px;"><?=$row->address?></textarea>
                          </div>
                        </div>

                        <div class="top-20">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>
