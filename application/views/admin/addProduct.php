<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="row" >
        <div class="col-md-12">
            <div class="block">
                <div class="block-title">
                    <h2><strong><?php echo $this->lang->line('addProduct'); ?></strong></h2>
                </div>
                <form action="<?php echo site_url(); ?>admin/AddProduct" method="post" class="form-horizontal form-bordered">
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
                        <label class="col-md-3 control-label">Firma:</label>
                        <div class="col-md-3">
                            <input type="text" name="Firma" id="Firma" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Marka:</label>
                        <div class="col-md-3">
                            <select id="selectCategory" name="Marka" class="form-control select-chosen" data-placeholder="<?php echo $this->lang->line('chooseCategory'); ?>" style="width: 250px;">
                                <option></option>
                                <?php foreach ($CategoryList as $row){?>
                                    <option value="<?php echo $row->Id; ?>"><?php echo $row->Title; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Güç:</label>
                        <div class="col-md-3">
                            <input type="text" name="Power" id="Power" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">SeriNo:</label>
                        <div class="col-md-3">
                            <input type="text" name="SeriNo" id="SeriNo" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Motor Tipi Model:</label>
                        <div class="col-md-3">
                            <input type="text" name="MotorTipi" id="MotorTipi" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alternatör Marka:</label>
                        <div class="col-md-3">
                            <input type="text" name="Alternator" id="Alternator" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alternatör Seri No:</label>
                        <div class="col-md-3">
                            <input type="text" name="AlternatorNo" id="AlternatorNo" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kabin Durumu:</label>
                        <div class="col-md-3">
                            <input type="text" name="Kabin" id="Kabin" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('addedDate'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="AddedDate" name="AddedDate" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yağ Filtresi:</label>
                        <div class="col-md-3">
                            <input type="text" name="YagFiltresi" id="YagFiltresi" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yağ Litre:</label>
                        <div class="col-md-3">
                            <input type="text" name="YagLitre" id="YagLitre" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Antifriz Litre:</label>
                        <div class="col-md-3">
                            <input type="text" name="AntifrizFiltre" id="AntifrizFiltre" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mazot Filtresi:</label>
                        <div class="col-md-3">
                            <input type="text" name="MazotFiltresi" id="MazotFiltresi" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Yakıt Filtresi:</label>
                        <div class="col-md-3">
                            <input type="text" name="YakitFiltresi" id="YakitFiltresi" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Akü:</label>
                        <div class="col-md-3">
                            <input type="text" name="Aku" id="Aku" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Isıtıcı Hortumu:</label>
                        <div class="col-md-3">
                            <input type="text" name="IsiticiHortumu" id="IsiticiHortumu" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kontrol Paneli:</label>
                        <div class="col-md-3">
                            <input type="text" name="KontrolPaneli" id="KontrolPaneli" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rezistans:</label>
                        <div class="col-md-3">
                            <input type="text" name="Rezistans" id="Rezistans" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Termostat:</label>
                        <div class="col-md-3">
                            <input type="text" name="Termostat" id="Termostat" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fan Kayışı:</label>
                        <div class="col-md-3">
                            <input type="text" name="FanKayisi" id="FanKayisi" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tampon Şarj Cihazı:</label>
                        <div class="col-md-3">
                            <input type="text" name="TamponSarj" id="TamponSarj" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Avr Voltaj Regülatörü:</label>
                        <div class="col-md-3">
                            <input type="text" name="Avr" id="Avr" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Marş Motoru:</label>
                        <div class="col-md-3">
                            <input type="text" name="MarsMotoru" id="MarsMotoru" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Şarj Dinamosu:</label>
                        <div class="col-md-3">
                            <input type="text" name="SarjDinamosu" id="SarjDinamosu" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yağ Müşürü:</label>
                        <div class="col-md-3">
                            <input type="text" name="YagMusuru" id="YagMusuru" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hararet Müşürü:</label>
                        <div class="col-md-3">
                            <input type="text" name="HararetMusuru" id="HararetMusuru" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yakıt Otomatiği:</label>
                        <div class="col-md-3">
                            <input type="text" name="YakitOtomatigi" id="YakitOtomatigi" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Turbo:</label>
                        <div class="col-md-3">
                            <input type="text" name="Turbo" id="Turbo" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Devirdaim:</label>
                        <div class="col-md-3">
                            <input type="text" name="Devirdaim" id="Devirdaim" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('width'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="Width" id="Width" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('height'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="Height" id="Height" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="form-group form-actions">
                        <div class="col-md-11 text-center">
                            <input type="submit" value="<?php echo $this->lang->line('addProductBtn'); ?>" class="btn btn-md btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
