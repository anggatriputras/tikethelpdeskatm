<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('include/head');?>
    </head>
    <body>
        <?php $this->load->view('include/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Users Manager</a> <span class="divider">/</span></li>
                <li><a href="<?=cms_url()?>account">User</a> <span class="divider">/</span></li>
                <li class="active">Add</li>
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
                        <div class="control-group">
                            <label>NIK/USERNAME :</label>
                            <input class="span5" type="text" name="username" placeholder="NIK" value="<?=set_value('user_name')?>">
                        </div>
                        <div class="control-group">
                            <label>Password :</label>
                            <input class="span5" type="password" name="password" placeholder="Password">
                        </div>

                        <div class="control-group">
                            <label>Full Name :</label>
                            <input class="span5" type="text" name="full_name" placeholder="Full name" value="<?=set_value('full_name')?>">
                        </div>

                        <div class="control-group">
                            <label>Email :</label>
                            <input class="span5" type="email" name="email" placeholder="Email" value="<?=set_value('email')?>">
                        </div>

                        <div class="control-group">
                            <label>Phone :</label>
                            <input class="span5" type="text" name="phone" placeholder="0838833282" value="<?=set_value('phone')?>">
                        </div>

                        <div class="control-group">
                            <label>Role :</label>
                            <label class="radio">
                                <input type="radio" name="role" value="<?=xml('role_dev')?>" class="test">
                                Helpdesk
                            </label>
                            <label class="radio">
                                <input type="radio" name="role" value="<?=xml('role_com')?>" class="test">
                                Company
                            </label>
                            <label class="radio">
                                <input type="radio" name="role" value="<?=xml('role_eng')?>" class="test">
                                Enginer
                            </label>
                        </div>
                        <div class="control-group" id="showOne" class="myDiv">
                            <label>Birthday :</label>
                            <input class="span5 datepicker" type="text" name="birthday" placeholder="Birthday" value="<?=set_value('birthday')?>">
                        </div>
                        <div class="control-group">
                            <label>Kota :</label>
                            <input class="span5" type="text" name="kota" placeholder="Kota" value="<?=set_value('kota')?>">
                        </div>
                        <div class="row-fluid">
                          <div class="span6">
                            <div class="control-group">
                                <label>Address :</label>
                                <textarea name="address" rows="5" cols="10"  class="input-block-level"><?=set_value('address')?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="control-group">
                            <button class="btn btn-primary" type="submit">Add New</button>
                            <a href="<?=cms_url()?>account" class="btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>

<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
    	var demovalue = $(this).val();
      if (demovalue == 2) {
        // $("#showOne").css("display", "none");
        $("#showOne").hide();

      }else{
        $("#showOne").show();
      }
        // $("div.myDiv").hide();
        // $("#show"+demovalue).show();
    });
});
</script>
