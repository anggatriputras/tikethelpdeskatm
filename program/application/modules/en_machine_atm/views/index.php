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
                <li><a href="<?=cms_url(FALSE)?>Banner">Machine atm</a> <span class="divider">/</span></li>
                <li class="active">List</li>
            </ul>
            <div class="input-prepend input-append">
                <form class="margin-none">
                    <a class="btn" href="<?=cms_url(FALSE)?>machine_atm"><span class="icon-refresh"></span> Refresh</a>
                    <?php if(user_role_en() == xml('role_dev')){?>
                      <a class="btn" href="<?=cms_url(FALSE)?>machine_atm/add"><span class="icon-plus"></span> Add</a>
                      <a class="btn" href="javascript:;" id="remove"><span class="icon-remove"></span> Delete</a>
                    <?php } ?>
                    <input class="input-medium" name="id_atm" value="<?=$id_atm?>" placeholder="Search by ID ATM" type="text">
                    <button class="btn" type="submit"><span class="icon-search"></span></button>
                </form>
            </div>
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all" /></th>
                            <th>No</th>
                            <th>ID ATM</th>
                            <th>SN ATM</th>
                            <th>Jam operasional</th>
                            <th>Type ATM</th>
                            <th>Alamat lokasi</th>
                            <th>Kota</th>
                            <th>Company</th>
                            <th>Active</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=($this->input->get('per_page')!="") ? $this->input->get('per_page') : 1; foreach ($rows as $r){?>
                            <tr>
                                <td><input type="checkbox" class="check-del" value="<?=$r['id']?>" /></td>
                                <td><?=$i++?></td>
                                <td><?=$r['id_atm']?></td>
                                <td><?=$r['sn_atm']?></td>
                                <td><?=$r['jam_operational']?></td>
                                <td><?=$r['type_atm']?></td>
                                <td><?=$r['lokasi']?></td>
                                <td><?=$r['kota']?></td>
                                <td><?=$r['name_company']?></td>
                                <td><?=$v = $r['is_active'] ? 'Yes' : 'No'?></td>
                                <td><?=format_date($r['created'],'F d, Y')?></td>
                                <td>
                                <?php if(user_role_en() == xml('role_dev')){?>
                                  <a class="set_tooltip" title="Edit / View" href="<?=cms_url(FALSE)?>machine_atm/edit/<?=$r['id']?>"><span class="icon-edit"></span> Edit</a></td>
                                <?php } ?>
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
                    location.href = '<?=cms_url(FALSE)?>machine_atm/delete?id='+data;
                 });
            });
       </script>
    </body>
</html>
