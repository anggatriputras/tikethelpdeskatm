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
                <li><a href="<?=cms_url()?>preference/seo">SEO</a> <span class="divider">/</span></li>
                <li class="active">Setting</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="alert alert-info">
                    <strong>Info!</strong> Silahkan lengkapi data SEO untuk website!
                </div>
                <?php if($update){?>
                    <div class="alert alert-success error">
                        <strong>Success!</strong> Update data success
                    </div>
                <?php }?>
                <div class="row-fluid">
                    <div class="span12">
                        
                        <div class="control-group">
                            <label>Meta Keywords :</label>
                            <textarea class="span12" rows="5" name="meta_keywords" placeholder="Meta Keywords"><?=$meta_keywords?></textarea>
                        </div>
                        <div class="control-group">
                            <label>Meta Description :</label>
                            <textarea class="span12" rows="5" name="meta_description" placeholder="Meta Description"><?=$meta_description?></textarea>
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