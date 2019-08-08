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
                <li><a href="<?=cms_url()?>ip">IP Blocked</a> <span class="divider">/</span></li>
                <li class="active">Add</li>
            </ul>
            <form method="post" class="form-horizontal">
                <?php echo validation_errors();?>
                <div class="row-fluid">
                    <div class="span12">
                        <div>
                            <label>IP Address :</label>
                            <input class="span5" type="text" name="ip_address" placeholder="IP Address" value="<?=set_value('ip_address')?>">
                        </div>
                        <div class="top-20">
                            <button class="btn btn-primary" type="submit">Add IP Blocked</button>
                            <a href="<?=cms_url()?>ip" class="btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>
