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
                <li><a href="<?=cms_url()?>preference/email">Email</a> <span class="divider">/</span></li>
                <li class="active">Setting</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="alert alert-info">
                    <strong>Info!</strong> Jika email kosong, maka data yang dikirim dari form akan masuk cms saja.
                </div>
                <?php if($update){?>
                    <div class="alert alert-success error">
                        <strong>Success!</strong> Update data success
                    </div>
                <?php }?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label>Email Hubungan Investor :</label>
                                    <input class="span6" type="email" name="email_hubungan_investor" placeholder="Insert email address" value="<?=$email_hubungan_investor?>">
                                </div>
                                <div class="control-group">
                                    <label>Alamat Hubungan Investor :</label>
                                    <textarea name="hubungan_investor_description" rows="7" class="input-block-level htmlarea" rows="4"><?=$hubungan_investor_description?></textarea>
                                </div>
                            </div>
                            <?php if(is_two_language()){?>
                            <div class="span6">
                                <div class="control-group" style="margin-top:54px;"></div>
                                <div class="control-group">
                                    <label>Alamat Hubungan Investor (EN) :</label>
                                    <textarea name="hubungan_investor_description_en" rows="7" class="input-block-level htmlarea" rows="4"><?=$hubungan_investor_description_en?></textarea>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <hr>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label>Email Hubungi Kami :</label>
                                    <input class="span6" type="email" name="email_hubungi_kami" placeholder="Insert email address" value="<?=$email_hubungi_kami?>">
                                </div>
                                <div class="control-group">
                                    <label>Alamat Hubungi Kami :</label>
                                    <textarea name="hubungi_kami_description" rows="7" class="input-block-level htmlarea" rows="4"><?=$hubungi_kami_description?></textarea>
                                </div>
                            </div>
                            <?php if(is_two_language()){?>
                            <div class="span6">
                                <div class="control-group" style="margin-top:54px;"></div>
                                <div class="control-group">
                                    <label>Alamat Hubungi Kami (EN) :</label>
                                    <textarea name="hubungi_kami_description_en" rows="7" class="input-block-level htmlarea" rows="4"><?=$hubungi_kami_description_en?></textarea>
                                </div>
                            </div>
                            <?php }?>
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