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
                <li><a href="<?=cms_url(FALSE)?>workstations">workstations</a> <span class="divider">/</span></li>
                <li class="active">Add</li>
            </ul>
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <?php echo validation_errors();?>
                <?php if(isset ($error)){?>
                    <div class="alert alert-error"><strong>Error!</strong> <?=$error?></div>
                <?php }?>
                <div class="row-fluid">
                    <div class="span12">
                      <div class="control-group">
                          <label>MACHINE ATM:</label>
                          <select class="span5" name="id_machine_atm">
                            <option value="">--SELECT MACHINE ATM--</option>
                            <?php if ($machines) { ?>
                            <?php foreach ($machines as $object) { ?>
                              <option value="<?=$object["id"]?>"> <?=strtoupper($object["id_atm"])?> (<?=strtoupper($object["name_company"])?>)</option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>

                      <div class="control-group">
                          <label>ENGINERS:</label>
                          <select class="span5" name="id_enginer">
                            <option value="">--SELECT ENGINERS--</option>
                            <?php if ($enginers) { ?>
                            <?php foreach ($enginers as $object) { ?>
                              <option value="<?=$object["id"]?>"> <?=strtoupper($object["full_name"])?>  (<?=strtoupper($object["kota"])?> )</option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>



                      <!-- <div class="control-group">
                          <label>STATUS:</label>
                          <select class="span5" name="status">
                            <option value="">-- STATUS --</option>
                            <option value="proses" > PROSES</option>
                            <option value="selesai" > SELESAI</option>
                          </select>
                      </div> -->

                      <div class="row-fluid">
                        <div class="span6">
                          <div class="control-group">
                              <label>Keluhan :</label>
                              <textarea name="keluhan" rows="5" cols="10"  class="input-block-level"><?=set_value('keluhan')?></textarea>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="control-group">
                          <label>Image: </label>
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="input-append">
                                  <div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="file_upload" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                              </div>
                              <span class="help-inline">Size file: (780 x 640 px), </span>
                              <span class="help-inline">Format: .png .gif;</span>
                          </div>
                      </div> -->



                        <!-- <div class="control-group">
                            <label>Urutan Tampilan/ Sort View:</label>
                            <select class="span1" name="sort">
                                <?php for($i=1;$i<=20;$i++) {?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                        </div> -->

                        <!-- <div class="control-group">
                            <label>Urutan Tampilan / Sort View:</label>
                            <select class="span1" name="sort">
                                <?php for($i=1;$i<=20;$i++) {?>
                                <option <?=$c=($banner_length==$i) ? 'selected="selected"' : ''?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                        </div> -->

                        <!-- <div class="control-group">
                            <label>Publish:</label>
                            <label class="checkbox">
                                <input type="checkbox" name="is_active" /> Published
                            </label>
                        </div> -->

                        <div class="top-20">
                            <button class="btn btn-primary" type="submit">Create</button>
                            <a href="<?=cms_url(FALSE)?>workstations" class="btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>
