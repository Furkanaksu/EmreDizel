<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title">
            <h2><strong><?php echo $this->lang->line('contacts'); ?></strong></h2>
        </div>
        <div class="table-options clearfix">
            <div class="btn-group btn-group-sm pull-right">
                <a href="<?php echo site_url(); ?>admin/AddContact" class="btn btn-primary" data-toggle="tooltip" title="Add New Admin"><?php echo $this->lang->line('addAdmin'); ?></i></a>
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
                    <th class="text-center">İsim</th>
                    <th class="text-center">Fiyat</th>
                    <th class="text-center">Telefon Numarası</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Mesaj</th>
                    <th class="text-center">Tarih</th>
                    <th class="text-center"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($contacts as $row){
                    ?>
                    <tr>
                        <!--<td class="text-center"><img src="<?php echo base_url(); ?>
                    assets/admin/img/placeholders/avatars/avatar16.jpg" alt="avatar" class="img-circle"></td>-->
                        <th class="text-center"><?php echo $row->Id; ?></th>
                        <td class="text-center"><?php echo $row->Name; ?> </td>
                        <td class="text-center"><?php echo $row->Price; ?> </td>
                        <td class="text-center"><?php echo $row->PhoneNumber; ?> </td>
                        <td class="text-center"><?php echo $row->Mail; ?> </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" onclick="showMessageModal('<?php echo $row->Id; ?>','<?php echo site_url(); ?>AdminAjax/DetailContact/<?php echo $row->Id; ?>');" class="btn btn-primary btn-sm btn btn-warning" title="Show Message"><?php echo $this->lang->line('message'); ?></a>
                        </td>
                        <td class="text-center"><?php echo $row->AddedDate; ?> </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" onclick="showDeleteModal('<?php echo $row->Id; ?>','<?php echo site_url(); ?>admin/DeleteContact/<?php echo $row->Id; ?>');" class="btn btn-primary btn-sm btn btn-danger" title="Delete Admin"><?php echo $this->lang->line('delete'); ?></a>
                        </td>
                    </tr>
                <?php } ?></tbody>
            </table>
        </div>
        <!-- END Table Styles Content -->
    </div>
</div>

