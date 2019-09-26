<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="main-container">
    <section class="switchable ">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <img alt="Image" class="border--round box-shadow-wide" src="<?php echo base_url(); ?>assets/front/img/inner-2.jpg" />
                </div>
                <div class="col-md-6">
                    <div class="row mx-0 switchable__text flex-column">
                        <p class="lead">
                            E:
                            <a href="#">hello@stack.net</a>
                            <br /> P: +613 4827 2294
                        </p>
                        <p class="lead">
                            Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days.
                        </p>
                        <p class="lead">
                            We are open from 9am &mdash; 5pm week days.
                        </p>
                        <hr class="short">
                        <form action="<?php echo site_url(); ?>contact" method="post" class="row" id="form-validation">
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
                            <div class="col-md-6">
                                <label>Your Name:</label>
                                <input type="text" name="Name" id="Name" class="validate-required" />
                            </div>
                            <div>
                                <input type="hidden" name="ProductId" id="ProductId" value="<?php echo $this->uri->segment(2); ?>"/>
                            </div>
                            <div class="col-md-6">
                                <label>Email Address:</label>
                                <input type="email" name="Mail" id="Mail" class="validate-required validate-email" />
                            </div>
                            <div class="col-md-12">
                                <label>Phone Number :</label>
                                <input type="text" name="PhoneNumber" class="validate-required" />
                            </div>
                            <div class="col-md-12">
                                <label>Message:</label>
                                <textarea rows="6" name="Message" class="validate-required"></textarea>
                            </div>
                            <div class="col-md-5 col-lg-4">
                                <button type="submit" class="btn btn--primary type--uppercase">Send</button>
                            </div>
                        </form>
                    </div>
                    <!--end of row-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
</div>
