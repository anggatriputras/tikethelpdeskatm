<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('include/head');?>
    </head>
    <body>
        <?php $this->load->view('include/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Preference</a> <span class="divider">/</span></li>
                <li><a href="<?=cms_url()?>preference/social_media">Social Media</a> <span class="divider">/</span></li>
                <li class="active">Setting</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="alert alert-info">
                    <strong>Info!</strong> Silahkan lengkapi data social media untuk website!
                </div>
                <?php if($update){?>
                    <div class="alert alert-success error">
                        <strong>Success!</strong> Update data success
                    </div>
                <?php }?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="control-group">
                            <label>Link Facebook :</label>
                            <input class="span4" type="text" name="link_facebook" placeholder="Insert link facebook" value="<?=$link_facebook?>">
                        </div>
                        <div class="control-group">
                            <label>Link Twitter :</label>
                            <input class="span4" type="text" name="link_twitter" placeholder="Insert link twitter" value="<?=$link_twitter?>">
                        </div>
                        <div class="control-group">
                            <label>Link Instagram :</label>
                            <input class="span4" type="text" name="link_instagram" placeholder="Insert link instagram" value="<?=$link_instagram?>">
                        </div>
                        <div class="control-group">
                            <label>Link linkedin :</label>
                            <input class="span4" type="text" name="link_linkedin" placeholder="Insert link linkedin" value="<?=$link_linkedin?>">
                        </div>
                        <div class="control-group">
                            <input type="hidden" name="run" value="run" />
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>
