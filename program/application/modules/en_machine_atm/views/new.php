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
                <li><a href="<?=cms_url(FALSE)?>machine_atm">Machine Atm</a> <span class="divider">/</span></li>
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
                          <label>ID ATM :</label>
                          <input maxlength="200" class="span5" type="number" name="id_atm" placeholder="ID ATM" value="<?=set_value('id_atm')?>">
                      </div>

                      <div class="control-group">
                          <label>SN ATM :</label>
                          <input maxlength="200" class="span5" type="text" name="sn_atm" placeholder="SN ATM" value="<?=set_value('sn_atm')?>">
                      </div>

                      <div class="control-group">
                          <label>Jam operasional :</label>
                          <input maxlength="200" class="span5" type="text" name="jam_operational" placeholder="08.00 - 17.00" value="<?=set_value('jam_operational')?>">
                      </div>

                      <div class="control-group">
                          <label>Type ATM :</label>
                          <input maxlength="200" class="span5" type="text" name="type_atm" placeholder="Hyosung 5600 s" value="<?=set_value('type_atm')?>">
                      </div>

                      <div class="control-group">
                          <!-- <label>:</label> -->
                          <select class="span5" name="id_company">
                            <option value="">--SELECT COMPANY--</option>
                            <?php if ($company) { ?>
                            <?php foreach ($company as $object) { ?>
                              <option value="<?=$object["id"]?>"> <?=strtoupper($object["full_name"])?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>
                      <div class="row-fluid">
                        <div class="span6">
                          <div class="control-group">
                              <label>Lokasi :</label>
                              <textarea name="lokasi" rows="5" cols="10"  class="input-block-level"><?=set_value('lokasi')?></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="control-group">
                          <label>Kota :</label>
                          <input maxlength="200" class="span5" type="text" name="kota" placeholder="" value="<?=set_value('kota')?>">
                      </div>


                        <div class="control-group">
                            <label>Active:</label>
                            <label class="checkbox">
                                <input type="checkbox" name="is_active" /> Active
                            </label>
                        </div>

                        <div class="top-20">
                            <button class="btn btn-primary" type="submit">Create</button>
                            <a href="<?=cms_url(FALSE)?>machine_atm" class="btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('include/footer');?>
    </body>
</html>
