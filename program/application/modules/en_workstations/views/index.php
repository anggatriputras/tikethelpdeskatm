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
                <li><a href="<?=cms_url(FALSE)?>Workstations">workstations</a> <span class="divider">/</span></li>
                <li class="active">List</li>
            </ul>
            <div class="input-prepend input-append">
                <form class="margin-none">
                    <a class="btn" href="<?=cms_url(FALSE)?>workstations"><span class="icon-refresh"></span> Refresh</a>
                    <?php if(user_role_en() == xml('role_dev')){?>
                      <a class="btn" href="<?=cms_url(FALSE)?>workstations/add"><span class="icon-plus"></span> Add</a>
                      <a class="btn" href="javascript:;" id="remove"><span class="icon-remove"></span> Delete</a>
                    <?php } ?>
                    <input class="input-medium" name="code"  placeholder="Search by Code" type="text">
                    <button class="btn" type="submit"><span class="icon-search"></span></button>
                </form>
            </div>
            <?php if($rows){?>
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
                            <th>Keterangan</th>
                            <th>Images</th>
                            <th>End Date</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=($this->input->get('per_page')!="") ? $this->input->get('per_page') : 1; foreach ($rows as $r){?>
                            <tr>
                                <td><input type="checkbox" class="check-del" value="<?=$r['id']?>" /></td>
                                <td><?=$i++?></td>
                                <td><?=$r['code_tiket']?></td>
                                <td><?=$r['machines_id']?></td>
                                <?php $company = $this->workstations_mod->get_company_by_id($r['id_company']);?>
                                <td><?=$company->full_name?></td>
                                <td><?=$r['full_name']?></td>
                                <td><?=$r['nik']?></td>
                                <?php if ($r['status'] == "pending") {?>
                                  <td style="color:green;"><?=$r['status']?></td>
                                <? }elseif ($r['status'] == "in progress") { ?>
                                  <td style="color:red;"><?=$r['status']?></td>
                                <? } else { ?>
                                  <td style="color:blue;"><?=$r['status']?></td>
                                <? } ?>
                                <td><?=$r['keterangan']?></td>
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

                                <td><?=format_date($r['end_date'] == "0000-00-00" ? "": $r['end_date'] ,'F d, Y')?></td>
                                <td><?=format_date($r['created'],'F d, Y')?></td>
                                <td>
                                    <!-- <a class="btn" href=""> Preview</a> -->
                                    <?php if(user_role_en() == xml('role_eng')){?>
                                      <?php if (($r['status'] == "pending")) { ?>
                                        <a  class="btn btn-primary"  title="process" href="<?=cms_url(FALSE)?>workstations/working/<?=$r['id']?>"> Process</a>
                                      <?php } ?>
                                      <?php if($r['status'] == "in progress"){?>
                                        <a  class="btn btn-danger"  title="completed" href="<?=cms_url(FALSE)?>workstations/edit/<?=$r['id']?>"> Completed</a>
                                      <?php }  ?>

                                    <?php }  ?>
                                    <?php if(user_role_en() == xml('role_dev')){?>
                                      <a class="set_tooltip" title="Edit / View" href="<?=cms_url(FALSE)?>workstations/edit/<?=$r['id']?>"><span class="icon-edit"></span> Edit</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
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
    </body>
</html>
