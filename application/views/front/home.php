<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="switchable switchable--switch space--xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="height-50 imagebg border--round" data-overlay="2">
                        <div class="background-image-holder">
                            <img alt="background" src="<?php echo base_url(); ?>assets/front/img/hero-3.jpg" />
                        </div>
                        <div class="pos-vertical-center col-md-6 col-lg-5 pl-5">
                            <h2>Build a premium, responsive digital storefront.</h2>
                            <p class="lead">
                                Stack offers unique styling for selling digital goods, including multiple shop and product layouts &mdash; and all common utility pages.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="space--sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="masonry masonry--tiles">
                        <div class="masonry-filter-container d-flex align-items-center">
                            <h3 class="masonry__item col-md-2"><?php echo $this->lang->line('categories'); ?>:</h3>
                            <div class="col-md-10">
                                <?php
                                foreach ($Categories as $row){
                                ?>
                                <a style="color:gray;" href="<?php echo site_url(); ?>category/<?php echo $row->Id; ?>"> <?php echo $row->Title; ?> |</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="masonry__container row" >
                            <?php
                            foreach ($Products as $row){
                                $mainImage = '';
                                foreach ($row->ImageList as $rowImage)
                                {
                                    if($rowImage->Main == 1)
                                    {
                                        $mainImage = img_thumb_url().$rowImage->Image;
                                        break;
                                    }
                                }
                                ?>
                            <div class="masonry__item col-md-4" data-masonry-filter="Select">
                                <div class="product product--tile bg--secondary text-center ">
                                    <?php if($row->PriceDiscount != 0) { ?>
                                    <span class="label">Discount</span>
                                    <?php }?>

                                    <a href="<?php echo site_url(); ?>movie-poster/<?php echo $row->Id; ?>">
                                        <img style="height: 250px"; alt="Image" src="<?php echo $mainImage; ?>"/>
                                    </a>
                                    <a class="block" href="#">
                                        <div>
                                            <h5 style="height: 50px;"><?php echo $row->Title; ?></h5>
                                            <br/>
                                            <?php if($row->Year != NULL) { ?>
                                                <span style="height: 30px; display:block;">Year: <?php echo $row->Year; ?></span>
                                            <?php } else {?>
                                            <span style="height: 30px; display:block;">Year: Unknown</span>
                                            <?php }?>
                                            <span style="height: 30px; display:block;"><?php echo $row->CategoryTitle; ?></span>
                                        </div>
                                        <div class="text-block">
                                            <?php if($row->PriceDiscount == NULL || $row->PriceDiscount == 0 )
                                            { if($row->Price == 0) { ?>
                                                <div>
                                                    <span class="h4 inline-block">Fiyat Belirlenmemiş</span>
                                                </div>
                                            <?php } else {?>
                                                <div>
                                                    <span class="h4 inline-block">$ <?php echo $row->Price; ?></span>
                                                </div>
                                            <?php }?>
                                            <?php } else {?>
                                                <div>
                                                    <span class="h4 type--strikethrough inline-block"><del>$ <?php echo $row->Price; ?></del></span>
                                                    <span class="h4 inline-block">$ <?php echo $row->PriceDiscount; ?></span>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                            <!--end item-->
                        </div>
                        <?php if($TotalPage > 1) { ?>
                        <div class="pagination">
                            <a class="pagination__prev" href="<?php echo base_url(); ?><?php echo ''; ?>" title="Previous Page">&laquo;</a>
                            <ol>
                                <?php for($i = 1; $i<=$TotalPage; $i++) { ?>
                                    <?php $selectedClass = ''; if($CurrentPage == $i ){ $selectedClass = 'class="pagination__current"';} ?>
                                    <li <?php echo $selectedClass; ?>>
                                    <a href="<?php echo base_url(); ?><?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                                <?php } ?>
                            </ol>
                            <a class="pagination__next" href="<?php echo base_url(); ?><?php echo $i; ?>">&raquo;</a>
                        </div>
                        <?php } ?>
                        <!--end masonry container-->
                    </div>
                    <!--end masonry-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>