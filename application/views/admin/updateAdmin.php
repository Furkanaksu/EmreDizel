<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="row" >
        <div class="col-md-12">
            <div class="block">
                <div class="block-title">
                    <h2><strong><?php echo $this->lang->line('updateAdmin'); ?></strong></h2>
                </div>

                <?php if(count($AdminDetail) == 0){ ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-danger">There is no record</div>
                        </div>
                    </div>
                <?php
                    die();
                } ?>

                <form action="<?php echo site_url(); ?>admin/UpdateAdmin/<?php echo $AdminDetail[0]->Id; ?>" method="post" class="form-horizontal form-bordered">
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
                            <input type="email" name="Email" value="<?php echo $AdminDetail[0]->Email; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('password'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" value="<?php echo $AdminDetail[0]->Password; ?>" name="Password" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('name'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" value="<?php echo $AdminDetail[0]->Name; ?>" name="Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('surname'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="Surname" value="<?php echo $AdminDetail[0]->Surname; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('addedDate'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="AddedDate" name="AddedDate" class="form-control input-datepicker" value="<?php echo $AdminDetail[0]->AddedDate; ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('updatedDate'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="UpdatedDate" name="UpdatedDate" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('loginDate'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="LoginDate" name="LoginDate" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('ip'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="IP" value="<?php echo $AdminDetail[0]->IP; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('os'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="OS" value="<?php echo $AdminDetail[0]->OS; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('browser'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="Browser" value="<?php echo $AdminDetail[0]->Browser; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('failedDate'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="FailedDate" name="FailedDate" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="Status"><?php echo $this->lang->line('status'); ?>:</label>
                        <div class="col-md-3">
                            <select id="example-select"  name="Status" class="form-control" size="1">
                                <option value="0" <?php if($AdminDetail[0]->Status == EnumStatus::BLOCKED) {echo 'selected';} ?>><?php echo $this->lang->line('blocked'); ?></option>
                                <option value="1" <?php if($AdminDetail[0]->Status == EnumStatus::ACTIVE) {echo 'selected';} ?>><?php echo $this->lang->line('active'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-11 text-center">
                            <input type="submit" value="<?php echo $this->lang->line('update'); ?>" class="btn btn-md btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
