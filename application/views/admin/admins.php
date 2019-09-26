<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title">
            <h2><strong><?php echo $this->lang->line('admin'); ?></strong></h2>
        </div>
        <div class="table-options clearfix">
            <div class="btn-group btn-group-sm pull-right">
                <a href="<?php echo site_url(); ?>admin/AddAdmin" class="btn btn-primary" data-toggle="tooltip" title="Add New Admin"><?php echo $this->lang->line('addAdmin'); ?></i></a>
            </div>
        </div>
        <?php
        if($this->session->flashdata('Message') != null)
        {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-<?php echo $this->session->flashdata('MessageType'); ?>"><?php echo $this->session->flashdata('Message'); ?></div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="table-responsive">
            <table id="general-table" bordered class="table table-striped table-vcenter table-bordered">
                <thead>
                <tr>
                    <th class="text-center"><?php echo $this->lang->line('id'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('name'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('email'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('status'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('addedDate'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($admin as $row){
                    ?>
                    <tr>
                        <!--<td class="text-center"><img src="<?php echo base_url(); ?>
                    assets/admin/img/placeholders/avatars/avatar16.jpg" alt="avatar" class="img-circle"></td>-->
                        <th class="text-center"><?php echo $row->Id; ?></th>
                        <td class="text-center"><?php echo $row->Name; ?></td>
                        <td class="text-center"><?php echo $row->Email; ?> </td>
                        <?php
                        if($row->Status == EnumStatus::ACTIVE)
                        {
                            ?>
                            <td class="text-center"><a href="javascript:void(0)" class="label label-success"><?php echo $this->lang->line('active'); ?></a></td>
                            <?php
                        }
                        else{
                            ?>
                            <td class="text-center"><a href="javascript:void(0)" class="label label-danger"><?php echo $this->lang->line('blocked'); ?></a></td>
                            <?php
                        }
                        ?>
                        <td class="text-center"><?php echo $row->AddedDate; ?> </td>
                        <td class="text-center">
                            <a href="<?php echo site_url(); ?>admin/UpdateAdmin/<?php echo $row->Id; ?>" class="btn btn-primary btn-sm btn btn-warning" title="Delete Admin"><?php echo $this->lang->line('update'); ?></a>
                            <a href="javascript:void(0)" onclick="showDeleteModal('<?php echo $row->Id; ?>','<?php echo site_url(); ?>admin/DeleteAdmin/<?php echo $row->Id; ?>');" class="btn btn-primary btn-sm btn btn-danger" title="Update Admin"><?php echo $this->lang->line('delete'); ?></a>
                        </td>
                    </tr>
                <?php } ?></tbody>
            </table>
        </div>
        <!-- END Table Styles Content -->
    </div>
</div>

