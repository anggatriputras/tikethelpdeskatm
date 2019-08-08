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
                <li><a href="<?=cms_url()?>preference/google_analytics">Google Analytics</a> <span class="divider">/</span></li>
                <li class="active">Setting</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="alert alert-info">
                    <strong>Info!</strong> Silahkan isi script (javascript) untuk Google Analytics!
                </div>
                <?php if($update){?>
                    <div class="alert alert-success error">
                        <strong>Success!</strong> Update data success
                    </div>
                <?php }?>
                <div class="row-fluid">
                    <div class="span12">
                        
                        <div class="control-group">
                            <label>Script google analytics :</label>
                            <textarea class="span12" rows="13" name="google_analytics" placeholder="Insert script google analytics"><?=$google_analytics?></textarea>
                        </div>
                        <div class="control-group">
                            <input type="hidden" name="run" value="run" />
                            <button class="btn btn-primary btn-large" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>