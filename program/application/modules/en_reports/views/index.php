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
                <li><a href="<?=cms_url(FALSE)?>reports">Reports</a> <span class="divider">/</span></li>
                <li class="active">List</li>
            </ul>
            <div class="input-prepend input-append">
                <form class="margin-none">
                    <div class="control-group">
                      <input class="input-medium span4" name="code"  value="<?=$code?>" placeholder="Search by code" type="text">
                    </div>
                    <!-- <div class="control-group">
                      <input class="input-medium datepicker span4" value="<?=$dari;?>" name="dari"  placeholder="Dari" type="text">
                    </div>
                    <div class="control-group">
                      <input class="input-medium datepicker span4" value="<?=$sampai;?>" name="sampai"  placeholder="Sampai" type="text">
                    </div> -->
                    <div class="control-group">
                      <select class="span4" name="id_machine_atm">
                        <option value="">--FIND BY MACHINE ATM--</option>
                        <?php if ($machines) { ?>
                        <?php foreach ($machines as $object) { ?>
                          <option value="<?=$object["id"]?>" <?=$id_machine_atm == $object["id"] ? "selected" : "" ?>> <?=strtoupper($object["id_atm"])?> (<?=strtoupper($object["name_company"])?>) - (<?=strtoupper($object["kota"])?>)</option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="control-group">
                      <select class="span4" name="id_enginer">
                        <option value="">--FIND BY ENGINERS--</option>
                        <?php if ($enginers) { ?>
                        <?php foreach ($enginers as $object) { ?>
                          <option value="<?=$object["id"]?>" <?=$id_enginer == $object["id"] ? "selected" : "" ?>> <?=strtoupper($object["full_name"])?> (<?=strtoupper($object["kota"])?>) </option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="control-group">
                      <select class="span4" name="status">
                        <option value="">--FIND BY STATUS--</option>
                        <option value="pending" <?=$status == "pending" ? "selected" : "" ?> > Pending</option>
                        <option value="in progress" <?=$status == "in progress" ? "selected" : "" ?> > In progress</option>
                        <option value="completed" <?=$status == "completed" ?  "selected" : "" ?> > Completed</option>
                      </select>
                    </div>
                    <button class="btn" type="submit"><span class="icon-search"></span> Search</button>
                    <a class="btn" href="<?=cms_url(FALSE)?>reports"><span class="icon-refresh"></span> Refresh</a>
                    <button onclick="printDiv('printableArea')" value="Print" class="btn" type="submit"><span class="icon-print"></span></button>
                </form>
            </div>
            <br>
            <?php if($rows){?>
                <div id="printableArea">
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all" /></th>
                            <th>No</th>
                            <th>Code</th>
                            <th>ID ATM</th>
                            <th>Company</th>
                            <th>Enginer</th>
                            <th>NIK</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th>Keterangan</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=($this->input->get('per_page')!="") ? $this->input->get('per_page') : 1; foreach ($rows as $r){?>
                            <tr>
                                <td><input type="checkbox" class="check-del" value="<?=$r['id']?>" /></td>
                                <td><?=$i++?></td>
                                <td><?=$r['code_tiket']?></td>
                                <td><?=$r['machines_id']?></td>
                                <?php $company = $this->reports_mod->get_company_by_id($r['id_company']);?>
                                <td><?=$company->full_name?></td>
                                <td><?=$r['full_name']?></td>
                                <td><?=$r['nik']?></td>
                                <td><?=$r['status']?></td>
                                <td>
                                    <?php if (!empty($r['image'])) { ?>
                                      <a data-toggle="lightbox" href="#box-<?=$r['id']?>"><span class="icon-picture"></span></a>
                                      <div id="box-<?=$r['id']?>" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
                                          <div class='lightbox-content'>
                                              <img src="<?=url_client().xml('dir_workstations_folder').$r['image']?>" />
                                          </div>
                                      </div>
                                    <?php } ?>
                                </td>
                                <td><?=$r['keterangan']?></td>
                                <td><?=format_date($r['start_date'] == "0000-00-00" ? "": $r['start_date'] ,'h:m F d, Y')?></td>
                                <td><?=format_date($r['end_date'] == "0000-00-00" ? "": $r['end_date'] ,'h:m F d, Y')?></td>
                                <td><?=format_date($r['created'],'F d, Y')?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                </div>
            <?php }else{?>
                <div class="alert alert-info top-10">No data</div>
            <?php }?>
            <div class="pagination"><?=$pagination?></div>
        </div>

        <?php $this->load->view('include/footer');?>
        <script type="text/javascript">
            $(function(){
                $('#check-all:checkbox').change(function(){
                    if($(this).attr("checked")){
                        $('input:checkbox').attr('checked','checked');
                    }else {
                        $('input:checkbox').removeAttr('checked');
                    }
                 });
                 $('#remove').click(function(){
                    var i = 0;
                    var data = new Array();
                    $('.check-del').each(function(){
                        if($(this).is(':checked')){
                            data[i] = $(this).val();
                            i++;
                        }
                    });
                    if(data == '' || data == undefined){
                        alert('Silahkan pilih data yang akan dihapus!');return false;
                    }
                    if(confirm('Anda yakin akan menghapus data ini?'))
                    location.href = '<?=cms_url(FALSE)?>workstations/delete?id='+data;
                 });
            });
       </script>

       <script type="text/javascript">
 function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;
   document.body.innerHTML = printContents;
   window.print();
   document.body.innerHTML = originalContents;
 }
 </script>
    </body>
</html>
