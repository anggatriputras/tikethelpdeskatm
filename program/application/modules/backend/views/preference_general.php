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
                <li><a href="<?=cms_url()?>preference/general">General</a> <span class="divider">/</span></li>
                <li class="active">Setting</li>
            </ul>
            <form method="post" class="form-horizontal"  enctype="multipart/form-data">
                <div class="alert alert-info">
                    <strong>Info!</strong> Silahkan lengkapi data umum untuk website!
                </div>
                <?php if($update){?>
                    <div class="alert alert-success error">
                        <strong>Success!</strong> Update data success
                    </div>
                <?php }?>
                <div class="row-fluid">
                    <div class="span6">
                        <!-- <div class="control-group">
                            <label>Judul Website CMS :</label>
                            <input class="span4" type="text" name="head_title" placeholder="Masukkan judul" value="<?=$head_title?>">
                            <span class="help-inline">Judul atau nama website untuk CMS</span>
                        </div> -->
                        <div class="control-group">
                            <label>Slider Career Timer  :</label>
                            <input class="span4" type="number" name="slider_career_timer" placeholder="Masukkan judul" value="<?=$slider_career_timer?>">
                            <span class="help-inline">1000 = 1 detik </span>
                        </div>
                    </div>
                </div>


                <div class="control-group">
                  <label>Sitemaps banners : <a data-toggle="lightbox" href="#box"><?=$c=($sitemaps_banners) ? $sitemaps_banners  : 'no picture';?></a></label>
                  <div id="box" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class='lightbox-content'>
                          <img src="<?=base_url().'clients/sitemap/'.$sitemaps_banners?>" />
                      </div>
                  </div>
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-append">
                          <div class="uneditable-input"><i class="icon-file fileupload-exists"></i>
                             <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span>
                             <span class="fileupload-exists">Change</span><input type="file" name="file_upload" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                      </div>
                      <span class="help-inline">Format file adalah : .jpg .png .gif</span>
                  </div>
              </div>

                <div class="control-group">
                    <input type="hidden" name="run" value="run" />
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>

            </form>
        </div><!--/.image-->

        <?php $this->load->view('include/footer');?>
    </body>
</html>
