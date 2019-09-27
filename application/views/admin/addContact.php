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
                <form action="<?php echo site_url(); ?>admin/AddContact" method="post" class="form-horizontal form-bordered" id="form-validation" >
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
                        <label class="col-md-3 control-label">İsim :</label>
                        <div class="col-md-3">
                            <input type="text" id="Name" name="Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Telefon Numarası:</label>
                        <div class="col-md-3">
                            <input type="text" id="PhoneNumber" name="PhoneNumber" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mail:</label>
                        <div class="col-md-3">
                            <input type="text" id="Mail" name="Mail" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fiyat:</label>
                        <div class="col-md-3">
                            <input type="text" id="Price" name="Price" class="form-control" />
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
