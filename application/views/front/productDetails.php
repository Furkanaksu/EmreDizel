<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if($ProductDetails == NULL){ ?>
    <section>
        <div class="container">
            <div class="alert bg--error">
                <div class="alert__body">
                    <span>Here is the alert text</span>
                </div>
                <div class="alert__close">
                    ×
                </div>
            </div>
        </div>
    </section>
    <?php
    die();
} ?>
<?php
    $mainImage = '';
    foreach ($ProductDetails->ImageList as $rowImage) {
        if ($rowImage->Main == 1) {
            $mainImage = img_main_url() . $rowImage->Image;
            break;
        }
    }
?>

<section class="space--xs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $ProductDetails->Title; ?></h1>
                <ol class="breadcrumbs">
                    <li>
                        <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>category/<?php echo $ProductDetails->CategoryId; ?>"><?php echo $ProductDetails->CategoryTitle; ?></a>
                    </li>
                    <li><?php echo $ProductDetails->Title; ?></li>
                </ol>
                <hr>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>

<section class="space--xs">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-7 col-lg-6">
                <div class="slider border--round boxed--border" data-paging="true" data-arrows="true">
                    <ul class="slides">
                        <li>
                            <img alt="Image" src="<?php echo $mainImage; ?>"/>
                        </li>
                        <?php
                            $otherImage = '';
                            foreach ($ProductDetails->ImageList as $rowImage) {
                                if ($rowImage->Main == 0) {
                                    $otherImage = img_main_url() . $rowImage->Image;
                                    if($otherImage != '' || $otherImage != NULL ){ ?>
                                        <li>
                                            <img alt="Image" src="<?php echo $otherImage; ?>"/>
                                        </li>
                                    <?php }
                                }
                            break;
                         } ?>
                    </ul>
                </div>
                <!--end slider-->
            </div>
            <div class="col-md-5 col-lg-4">
                <h2><?php echo $ProductDetails->Title; ?></h2>
                <div class="text-block">
                    <?php if($ProductDetails->PriceDiscount == NULL || $ProductDetails->PriceDiscount == 0 )
                    { if($ProductDetails->Price == 0) { ?>
                        <div>
                            <span class="h5 inline-block"><?php echo $this->lang->line('noPrice'); ?></span>
                        </div>
                    <?php } else {?>
                        <div>
                            <span class="h4 inline-block">$ <?php echo $ProductDetails->Price; ?></span>
                        </div>
                    <?php }?>
                    <?php } else {?>
                        <div>
                            <span class="h4 type--strikethrough inline-block"><del>$ <?php echo $ProductDetails->Price; ?></del></span>
                            <span class="h4 inline-block">$ <?php echo $ProductDetails->PriceDiscount; ?></span>
                        </div>
                    <?php }?>
                </div>
                <p>
                    <?php echo $ProductDetails->Description; ?>
                </p>
                <ul class="accordion accordion-2 accordion--oneopen">
                    <li>
                        <div class="accordion__title">
                            <span class="h5"><?php echo $this->lang->line('specifications'); ?></span>
                        </div>
                        <div class="accordion__content">
                            <ul class="bullets">
                                <li>
                                    <span><?php echo $this->lang->line('specification_1'); ?></span>
                                </li>
                                <li>
                                    <span><?php echo $this->lang->line('specification_2'); ?></span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="accordion__title">
                            <span class="h5"><?php echo $this->lang->line('dimensions'); ?></span>
                        </div>
                        <div class="accordion__content">
                            <?php if($ProductDetails->Width == NULL ) { ?>
                            <ul class="bullets">
                                <li>
                                    <span><?php echo $this->lang->line('width'); ?>: <?php echo $this->lang->line('unknown'); ?></span>
                                </li>
                                <li>
                                    <span><?php echo $this->lang->line('height'); ?>: <?php echo $this->lang->line('unknown'); ?></span>
                                </li>
                            <?php }else{ ?>
                                <li>
                                    <span><?php echo $this->lang->line('width'); ?>: <?php echo $ProductDetails->Width; ?></span>
                                </li>
                                <li>
                                    <span><?php echo $this->lang->line('height'); ?>: <?php echo $ProductDetails->Height; ?></span>
                                </li>
                            <?php } ?>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="accordion__title">
                            <span class="h5"><?php echo $this->lang->line('shippingInfo'); ?></span>
                        </div>
                        <div class="accordion__content">
                            <ul class="bullets">
                                <li>
                                <span><?php echo $this->lang->line('shipping'); ?></span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!--end accordion-->
                <form>
                    <div class="col-md-6 col-lg-8">
                        <a href="<?php echo site_url(); ?>contact/<?php echo $ProductDetails->Id; ?>" class="btn btn-primary btn-sm btn btn--primary" title="Delete Admin"><?php echo $this->lang->line('contact'); ?></a>
                    </div>
                </form>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-block">
                    <h3><?php echo $this->lang->line('relatedProducts'); ?></h3>
                </div>
            </div>
            <?php
            foreach ($RelatedProducts as $row){
                $mainImage = '';
                foreach ($row->ImageList as $rowImage) {
                    if ($rowImage->Main == 1) {
                        $mainImage = img_thumb_url() . $rowImage->Image;
                        break;
                    }
                }
                ?>
                <div class="col-md-4">
                    <div class="product">
                        <a href="<?php echo site_url(); ?>movie-poster/<?php echo $row->Id; ?>">
                            <img style="height: 300px; width: 250px; display:block;" alt="Image" src="<?php echo $mainImage; ?>" />
                        </a>
                        <a class="block" href="#">
                            <div>
                                <h4 style="height: 50px; display:block;" ><?php echo $row->Title; ?></h4>
                            </div>
                            <div>
                                <div class="text-block">
                                    <?php if($row->PriceDiscount == 0 )
                                    { if($row->Price == 0) { ?>
                                        <div>
                                            <span class="h5 inline-block"><?php echo $this->lang->line('noPrice'); ?></span>
                                        </div>
                                    <?php } else {?>
                                        <div>
                                            <span class="h5 inline-block">$ <?php echo $row->Price; ?></span>
                                        </div>
                                    <?php }?>
                                    <?php } else {?>
                                        <div>
                                            <span class="h5 type--strikethrough inline-block"><del>$ <?php echo $row->Price; ?></del></span>
                                            <span class="h5 inline-block">$ <?php echo $row->PriceDiscount; ?></span>
                                        </div>
                                    <?php }?>   
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>