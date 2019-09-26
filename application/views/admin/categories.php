<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
        <div class="block">
            <div class="block-title">
                <h2><strong><?php echo $this->lang->line('categories'); ?></strong></h2>
            </div>
            <div class="table-options clearfix">
                <div class="btn-group btn-group-sm pull-right">
                    <a href="<?php echo site_url(); ?>admin/AddCategories" class="btn btn-primary" data-toggle="tooltip" title="Add New Category"><?php echo $this->lang->line('addCategory'); ?></a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="general-datatable" class="table table-striped table-vcenter table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center"><?php echo $this->lang->line('id'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('category'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('description'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('status'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('addedDate'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('updatedDate'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($categories as $row){
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $row->Id; ?></td>
                        <td class="text-center"><?php echo $row->Title; ?></td>
                        <td class="text-center"><?php echo $row->Description; ?></td>
                        <?php
                        if($row->Status == 1)
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
                        <td class="text-center"><?php echo $row->AddedDate; ?></td>
                        <td class="text-center"><?php echo $row->UpdatedDate; ?></td>
                        <td class="text-center">
                            <a href="<?php echo site_url(); ?>admin/UpdateCategory/<?php echo $row->Id; ?>" class="btn btn-primary btn-sm btn btn-warning" title="Delete Admin"><?php echo $this->lang->line('update'); ?></a>
                            <a href="javascript:void(0)" onclick="showDeleteModal('<?php echo $row->Id; ?>','<?php echo site_url(); ?>admin/DeleteCategory/<?php echo $row->Id; ?>');"
                               class="btn btn-primary btn-sm btn btn-danger" title="Update Admin"><?php echo $this->lang->line('delete'); ?></a>
                        </td>

                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>