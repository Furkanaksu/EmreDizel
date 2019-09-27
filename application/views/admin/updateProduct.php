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
                <form action="<?php echo site_url(); ?>admin/UpdateProduct/<?php echo $ProductDetail[0]->Id; ?> " method="post" class="form-horizontal form-bordered">
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
                            <input type="text" name="Firma" value="<?php echo $ProductDetail[0]->Firma; ?>" id="Firma" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Marka:</label>
                        <div class="col-md-3">
                            <select id="selectCategory" name="CategoryId" class="form-control select-chosen" data-placeholder="<?php echo $this->lang->line('chooseCategory'); ?>" style="width: 250px;">
                                <option value="<?php echo $ProductDetail[0]->CategoryId; ?>"><?php echo $ProductDetail[0]->CategoryTitle; ?></option>
                                <?php foreach ($CategoryList as $row){?>
                                    <option value="<?php echo $row->Id; ?>"><?php echo $row->Name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Güç:</label>
                        <div class="col-md-3">
                            <input type="text" name="Power" value="<?php echo $ProductDetail[0]->Power; ?>"  id="Power" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">SeriNo:</label>
                        <div class="col-md-3">
                            <input type="text" name="SeriNo" value="<?php echo $ProductDetail[0]->SeriNo; ?>" id="SeriNo" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Motor Tipi Model:</label>
                        <div class="col-md-3">
                            <input type="text" name="MotorTipi" value="<?php echo $ProductDetail[0]->MotorTipi; ?>" id="MotorTipi" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alternatör Marka:</label>
                        <div class="col-md-3">
                            <input type="text" name="Alternator"  value="<?php echo $ProductDetail[0]->Alternator; ?>" id="Alternator" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alternatör Seri No:</label>
                        <div class="col-md-3">
                            <input type="text" name="AlternatorNo" id="AlternatorNo" value="<?php echo $ProductDetail[0]->AlternatorNo; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kabin Durumu:</label>
                        <div class="col-md-3">
                            <input type="text" name="Kabin" id="Kabin" value="<?php echo $ProductDetail[0]->Kabin; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('addedDate'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" id="AddedDate" name="AddedDate" value="<?php echo $ProductDetail[0]->AddedDate; ?>" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yağ Filtresi:</label>
                        <div class="col-md-3">
                            <input type="text" name="YagFiltresi" id="YagFiltresi" value="<?php echo $ProductDetail[0]->YagFiltresi; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yağ Litre:</label>
                        <div class="col-md-3">
                            <input type="text" name="YagLitre" id="YagLitre" value="<?php echo $ProductDetail[0]->YagLitre; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Antifriz Litre:</label>
                        <div class="col-md-3">
                            <input type="text" name="AntifrizFiltre" id="AntifrizFiltre" value="<?php echo $ProductDetail[0]->AntifrizFiltre; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mazot Filtresi:</label>
                        <div class="col-md-3">
                            <input type="text" name="MazotFiltresi" id="MazotFiltresi" value="<?php echo $ProductDetail[0]->MazotFiltresi; ?>" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Yakıt Filtresi:</label>
                        <div class="col-md-3">
                            <input type="text" name="YakitFiltresi" id="YakitFiltresi"  value="<?php echo $ProductDetail[0]->YakitFiltresi; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Akü:</label>
                        <div class="col-md-3">
                            <input type="text" name="Aku" id="Aku" class="form-control" value="<?php echo $ProductDetail[0]->Aku; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Isıtıcı Hortumu:</label>
                        <div class="col-md-3">
                            <input type="text" name="IsiticiHortumu" id="IsiticiHortumu" class="form-control" value="<?php echo $ProductDetail[0]->IsiticiHortumu; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kontrol Paneli:</label>
                        <div class="col-md-3">
                            <input type="text" name="KontrolPaneli" id="KontrolPaneli" class="form-control" value="<?php echo $ProductDetail[0]->KontrolPaneli; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rezistans:</label>
                        <div class="col-md-3">
                            <input type="text" name="Rezistans" id="Rezistans" class="form-control" value="<?php echo $ProductDetail[0]->Rezistans; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Termostat:</label>
                        <div class="col-md-3">
                            <input type="text" name="Termostat" id="Termostat" class="form-control" value="<?php echo $ProductDetail[0]->Termostat; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fan Kayışı:</label>
                        <div class="col-md-3">
                            <input type="text" name="FanKayisi" id="FanKayisi" class="form-control" value="<?php echo $ProductDetail[0]->FanKayisi; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tampon Şarj Cihazı:</label>
                        <div class="col-md-3">
                            <input type="text" name="TamponSarj" id="TamponSarj" class="form-control" value="<?php echo $ProductDetail[0]->TamponSarj; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Avr Voltaj Regülatörü:</label>
                        <div class="col-md-3">
                            <input type="text" name="Avr" id="Avr" class="form-control" value="<?php echo $ProductDetail[0]->Avr; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Marş Motoru:</label>
                        <div class="col-md-3">
                            <input type="text" name="MarsMotoru" id="MarsMotoru" class="form-control" value="<?php echo $ProductDetail[0]->MarsMotoru; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Şarj Dinamosu:</label>
                        <div class="col-md-3">
                            <input type="text" name="SarjDinamosu" id="SarjDinamosu" class="form-control" value="<?php echo $ProductDetail[0]->SarjDinamosu; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yağ Müşürü:</label>
                        <div class="col-md-3">
                            <input type="text" name="YagMusuru" id="YagMusuru" class="form-control" value="<?php echo $ProductDetail[0]->YagMusuru; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hararet Müşürü:</label>
                        <div class="col-md-3">
                            <input type="text" name="HararetMusuru" id="HararetMusuru" class="form-control" value="<?php echo $ProductDetail[0]->HararetMusuru; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Yakıt Otomatiği:</label>
                        <div class="col-md-3">
                            <input type="text" name="YakitOtomatigi" id="YakitOtomatigi" class="form-control" value="<?php echo $ProductDetail[0]->YakitOtomatigi; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Turbo:</label>
                        <div class="col-md-3">
                            <input type="text" name="Turbo" id="Turbo" class="form-control" value="<?php echo $ProductDetail[0]->Turbo; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Devirdaim:</label>
                        <div class="col-md-3">
                            <input type="text" name="Devirdaim" id="Devirdaim" class="form-control" value="<?php echo $ProductDetail[0]->Devirdaim; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('width'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="Width" id="Width" class="form-control" value="<?php echo $ProductDetail[0]->Width; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('height'); ?>:</label>
                        <div class="col-md-3">
                            <input type="text" name="Height" id="Height" class="form-control" value="<?php echo $ProductDetail[0]->Height; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group form-actions">
                            <div class="col-md-11 text-center">
                                <input type="submit" value="<?php echo $this->lang->line('addProductBtn'); ?>" class="btn btn-md btn-primary" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
