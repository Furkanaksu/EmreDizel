<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title">
            <h2><strong><?php echo $this->lang->line('contacts'); ?></strong></h2>
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
                    <th class="text-center"><?php echo $this->lang->line('productTitle'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('price'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('name').' '.$this->lang->line('surname'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('phoneNumber'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('email'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('status'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('message'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('ip'); ?></th>
                    <th class="text-center"><?php echo $this->lang->line('date'); ?></th>
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
                        <td class="text-center"><?php echo $row->ProductTitle; ?> </td>
                        <td class="text-center"><?php echo $row->Price; ?> </td>
                        <td class="text-center"><?php echo $row->Name; ?></td>
                        <td class="text-center"><?php echo $row->PhoneNumber; ?> </td>
                        <td class="text-center"><?php echo $row->Mail; ?> </td>
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
                        <td class="text-center">
                            <a href="javascript:void(0)" onclick="showMessageModal('<?php echo $row->Id; ?>','<?php echo site_url(); ?>AdminAjax/DetailContact/<?php echo $row->Id; ?>');" class="btn btn-primary btn-sm btn btn-warning" title="Show Message"><?php echo $this->lang->line('message'); ?></a>
                        </td>
                        <td class="text-center"><?php echo $row->Ip; ?> </td>
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

