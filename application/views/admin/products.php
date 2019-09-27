<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="block full">
        <div class="block-title">
            <h2><strong><?php echo $this->lang->line('product'); ?></strong></h2>
        </div>
        <div class="table-options clearfix">
            <div class="btn-group btn-group-sm pull-right">
                <a href="<?php echo site_url(); ?>admin/AddProduct" class="btn btn-primary" data-toggle="tooltip" title="Add New Category"><?php echo $this->lang->line('addProduct'); ?></a>
            </div>
            <div class="btn-group btn-group-sm pull-left">
                <form action="<?php echo site_url()?>/admin/Products" method="post">
                    <input type="email" id="Email" name="Email"  class="form-control" />
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table id="general-datatable" class="table table-striped table-vcenter table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Firma</th>
                    <th class="text-center">Marka</th>
                    <th class="text-center">Power</th>
                    <th class="text-center">Eklenme Tarihi</th>
                    <th class="text-center">Son Ziyaret</th>
                    <th class="text-center">Seri No</th>
                    <th class="text-center">Motor Tipi</th>
                    <th class="text-center"><?php echo $this->lang->line('actions'); ?></th>


                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($Products as $row){
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $row->Id; ?></td>
                        <td class="text-center"><?php echo $row->Firma; ?></td>
                        <td class="text-center"><?php echo $row->CategoryTitle; ?></td>
                        <td class="text-center"><?php echo $row->Power; ?></td>
                        <td class="text-center"><?php echo $row->AddedDate; ?></td>
                        <td class="text-center"><?php echo $row->AddedDate; ?></td>
                        <td class="text-center"><?php echo $row->SeriNo; ?></td>
                        <td class="text-center"><?php echo $row->MotorTipi; ?></td>
                        <td class="text-center">
                            <a href="<?php echo site_url(); ?>admin/UpdateProduct/<?php echo $row->Id; ?>" class="btn btn-primary btn-sm btn btn-warning" title="Update Admin"><?php echo $this->lang->line('update'); ?></a>
                            <a href="javascript:void(0)" onclick="showDeleteModal('<?php echo $row->Id; ?>','<?php echo site_url(); ?>admin/DeleteProduct/<?php echo $row->Id; ?>');"
                               class="btn btn-primary btn-sm btn btn-danger" title="Update Admin"><?php echo $this->lang->line('delete'); ?></a>

                        </td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
        <div class="col-md-12" style="text-align: center;">
                <?php if($TotalPage > 1) { ?>
                    <div class="pagination">
                        <a class="pagination__prev" href="<?php echo base_url(); ?><?php echo ''; ?>" title="Previous Page">&laquo;</a>
                        <ol>
                            <?php for($i = 1; $i<=$TotalPage; $i++) { ?>
                                <?php $selectedClass = ''; if($CurrentPage == $i ){ $selectedClass = 'class="pagination__current"';} ?>
                                <li <?php echo $selectedClass; ?>>
                                    <a href="<?php echo base_url(); ?>admin/Products/<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                        </ol>
                        <a class="pagination__next" href="<?php echo base_url(); ?><?php echo $i; ?>">&raquo;</a>
                    </div>
                <?php } ?>
        </div>
</div>

