<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="row" >
        <div class="col-md-12">
            <div class="block">
                <div class="block-title">
                    <h2><strong><?php echo $this->lang->line('addAdmin'); ?></strong></h2>
                </div>
                <form action="<?php echo site_url(); ?>admin/AddAdmin" method="post" class="form-horizontal form-bordered" id="form-validation" >
                    <?php
                    if($this->session->flashdata('Message') != null)
                    {
                        ?>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="alert alert-<?php echo $this->session->flashdata('MessageType'); ?>"><?php echo $this->session->flashdata('Message'); ?></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('email'); ?>:</label>
                        <div class="col-md-3">
                            <input type="email" id="Email" name="Email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('password'); ?>:</label>
                        <div class="col-md-3">
                            <input type="password" id="Password" name="Password" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('name'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="Name" name="Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('surname'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="Surname" name="Surname" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('addedDate'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="AddedDate" name="AddedDate" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="Status"><?php echo $this->lang->line('status'); ?>:</label>
                        <div class="col-md-3">
                            <select id="Status"  name="Status" class="form-control" size="1">
                                <option value="<?php echo EnumStatus::BLOCKED ?>"><?php echo $this->lang->line('blocked'); ?></option>
                                <option value="<?php echo EnumStatus::ACTIVE ?>"><?php echo $this->lang->line('active'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-11 text-center">
                            <input type="submit" value="<?php echo $this->lang->line('addAdminBtn'); ?>" class="btn btn-md btn-primary" />
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

</div>
