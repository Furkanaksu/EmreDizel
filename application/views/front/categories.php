<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    if(count($Products) == 0){ ?>
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

<section class="space--sm">
    <div class="container">
        <h1 style="text-align: center">
            <?php echo $CategoryTitle; ?>
        </h1>
        <div class="row">
            <div class="col-md-12">
                <div class="masonry masonry--tiles">
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
                                        <img style="height: 300px; alt="Image" src="<?php echo $mainImage; ?>">
                                    </a>
                                    <a class="block" href="#">
                                        <div>
                                            <h5 style="height: 80px;"><?php echo $row->Title; ?></h5>
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
                                            <?php if($row->Year != NULL) { ?>
                                                <span style="height: 30px; display:block;">Year: <?php echo $row->Year; ?></span>
                                            <?php } else {?>
                                                <span style="height: 30px; display:block;">Year: Unknown</span>
                                            <?php }?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                        <!--end item-->
                        <div style="clear:both; height: 200px;"></div>
                    </div>
                    <!--end masonry container-->
                    <?php if($TotalPage > 1) { ?>
                    <div class="pagination">
                        <a class="pagination__prev" href="#" title="Previous Page">&laquo;</a>
                        <ol>
                            <?php for($i = 1; $i<=$TotalPage; $i++) { ?>
                                <?php $selectedClass = ''; if($CurrentPage == $i ){ $selectedClass = 'class="pagination__current"';} ?>
                                <li <?php echo $selectedClass; ?>>
                                    <a href="<?php echo base_url(); ?>category/<?php echo $CategoryId; ?>/<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                        </ol>
                        <a class="pagination__next" href="#" title="Next Page">&raquo;</a>
                    </div>
                    <?php } ?>
                    <!--end masonry container-->
                </div>
                </div>
                <!--end masonry-->
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>