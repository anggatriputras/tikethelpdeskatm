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
                <li><a href="<?=cms_url()?>account">User</a> <span class="divider">/</span></li>
                <li class="active">List</li>
            </ul>
            <a class="btn" href="<?=cms_url()?>account/add"><span class="icon-plus"></span> Add New User</a>
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Full Name</th>
                            <th>NIK</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Birthday</th>
                            <th>Address</th>
                            <th>Last loggedin date</th>
                            <th>Is lock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;?>
                        <?php foreach ($rows as $r){?>
                        <?php $i++;?>
                            <tr>
                                <td><?=$i?></td>
                                <td><a class="set_tooltip" title="Edit - <?=$r['full_name']?>" href="<?=cms_url()?>account/edit/<?=$r['id']?>"><?=$r['full_name']?></a></td>
                                <td><?=$r['username']?></td>
                                <td><?php
                                      if ($r['role']==1) {
                                        echo "Helpedesk";
                                      } elseif ($r['role']==2) {
                                        echo "Company";
                                      } else {
                                        echo "Enginer";
                                      }
                                    ?>


                                </td>
                                <td><?=$r['email']?></td>
                                <td><?=$r['phone']?></td>
                                <td><?=$r['birthday']?></td>
                                <td><?=$r['address']?></td>
                                <td><?=$x=(!empty($r['last_loggedin_date'])) ? format_date($r['last_loggedin_date'],'F d, Y H:i:s') : '-'?></td>
                                <td><?=$v = $r['is_lock'] ? 'Yes' : 'No'?></td>
                                <td><?php if($r['role']==1) { echo "-";} else {?><a class="set_tooltip" title="Delete" href="<?=cms_url()?>account/delete/<?=$r['id']?>" onClick="return confirm('Apakah anda yakin akan menghapus data.?')"><span class="icon-remove"></span></a><?php }?></td>
                            </tr>
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
    </body>
</html>
