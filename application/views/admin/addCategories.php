<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="row">
        <div class="col-md-12">
            <div class="block">
                <div class="block-title">
                    <h2><strong><?php echo $this->lang->line('addCategory'); ?></strong></h2>
                </div>
                <form action="<?php echo site_url(); ?>admin/addCategories" method="post" class="form-horizontal form-bordered" >
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('title'); ?></label>
                        <div class="col-md-3">
                            <input type="text"  name="Title" id="Title" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('addedDate'); ?></label>
                        <div class="col-md-3">
                            <input type="text" id="AddedDate" name="AddedDate" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-select"><?php echo $this->lang->line('status'); ?></label>
                        <div class="col-md-2">
                            <select id="example-select" name="Status" class="form-control" size="1">
                                <option value="<?php echo EnumStatus::BLOCKED ?>"><?php echo $this->lang->line('blocked'); ?></option>
                                <option value="<?php echo EnumStatus::ACTIVE ?>"><?php echo $this->lang->line('active'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="block" style="margin-top:20px;">
                        <div class="block-title">
                            <h2><strong><?php echo $this->lang->line('description'); ?></strong></h2>
                        </div>
                        <div class="form-horizontal">
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <textarea id="Description" name="Description" class="ckeditor"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-11 text-center">
                            <input type="submit" value="<?php echo $this->lang->line('addCategoryBtn'); ?>" class="btn btn-md btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
