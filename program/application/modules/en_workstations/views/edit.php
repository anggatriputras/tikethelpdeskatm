<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('include/head');?>
    </head>
    <body>
        <?php $this->load->view('include/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Modules</a> <span class="divider">/</span></li>
                <li><a href="<?=cms_url(FALSE)?>workstations">Workstations</a> <span class="divider">/</span></li>
                <li class="active">Edit</li>
            </ul>
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <?php echo validation_errors();?>
                <?php if(isset ($error)){?>
                    <div class="alert alert-error"><strong>Error!</strong> <?=$error?></div>
                <?php }?>
                <div class="alert alert-info">
                    <strong>Info!</strong> Jika anda upload file, maka file sebelumnya akan dihapus.
                </div>
                <div class="row-fluid">
                    <div class="span12">
                      <div class="control-group">
                          <label>CODE:</label>
                          <input maxlength="200" class="span5" type="text" name="code_tiket" placeholder="Code" value="<?=$row->code_tiket?>" readonly>
                          <!-- <span class="help-inline">Gunakan tanda titik sebagai pemisah text. Contoh: Product .(E-proc , Mobile Catalogue)</span> -->
                      </div>

                      <div class="control-group">
                          <label>Machine ATM:</label>
                          <select class="span5" name="id_machine_atm"     <?=(user_role_en() == xml('role_eng') ? "readonly" : "" ) ?>>
                            <option value="">--SELECT MACHINE ATM--</option>
                            <?php if ($machines) { ?>
                            <?php foreach ($machines as $object) { ?>
                              <option <?=($row->id_machine_atm==$object["id"]) ? 'selected="selected"' : ''?> value="<?=$object["id"]?>"><?=strtoupper($object["name_company"])?> (<?=strtoupper($object["id_atm"])?>) </option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>


                      <div class="control-group">
                          <label>Enginer:</label>
                          <select class="span5" name="id_enginer" <?=(user_role_en() == xml('role_eng') ? "readonly" : "" ) ?>>
                            <option value="">--SELECT ENGINER--</option>
                            <?php if ($enginers) { ?>
                            <?php foreach ($enginers as $object) { ?>
                              <option <?=($row->id_enginer==$object["id"]) ? 'selected="selected"' : ''?> value="<?=$object["id"]?>"><?=strtoupper($object["full_name"])?> (<?=strtoupper($object["username"])?>) </option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>


                      <div class="row-fluid">
                        <div class="span6">
                          <div class="control-group">
                              <label>Note :</label>
                              <textarea name="keterangan" rows="5" cols="10"  class="input-block-level"><?=$row->keterangan?></textarea>
                          </div>
                        </div>
                        <!-- <div class="span6">
                          <div class="control-group">
                              <label>Demo :</label>
                              <textarea name="demo" rows="5" cols="10"  class="input-block-level htmlarea"><?=$row->demo?></textarea>
                          </div>
                        </div> -->
                      </div>

                        <div class="control-group">
                            <label>Image:
                                <?php
                                    if(empty($row->image)){
                                        echo 'no image';
                                    }else{
                                        echo '<a data-toggle="lightbox" href="#box2">view image</a>';
                                    }
                                ?></label>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="file_upload" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                                <span class="help-inline">Size file: (780 x 640 px), </span>
                                <span class="help-inline">Format: .png .gif;</span>
                            </div>
                        </div>

<!--

                        <div class="control-group">
                            <label>Urutan Tampilan / Sort View:</label>
                            <select class="span1" name="sort">
                                <?php for($i=1;$i<=20;$i++) {?>
                                <option <?=$c=($row->sort==$i) ? 'selected="selected"' : ''?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="control-group">
                            <label>Publish :</label>
                            <label class="checkbox">
                                <input type="checkbox" <?=$a = ($row->is_active) ? 'checked="checked"' : ''?> name="is_active" /> Mengaktifkan
                            </label>
                        </div> -->

                        <div class="top-20">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="<?=cms_url(FALSE)?>workstations" class="btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
            <div id="box" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class='lightbox-content'>
                    <img src="<?=base_url().xml('dir_workstations').$row->icon?>" />
                </div>
            </div>
            <div id="box2" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class='lightbox-content'>
                    <img src="<?=base_url().xml('dir_workstations').$row->thumbnail?>" />
                </div>
            </div>
            <div id="box3" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class='lightbox-content'>
                    <img src="<?=base_url().xml('dir_workstations').$row->banner?>" />
                </div>
            </div>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>
