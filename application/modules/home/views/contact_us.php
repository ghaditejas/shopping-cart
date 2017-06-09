<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12">    			   			
                <h2 class="title text-center">Contact <strong>Us</strong></h2>		
            </div>    	
            <div class="row">  	
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" action="<?php echo base_url(); ?>home/index/contact_us" name="contact-form" method="post">
                            <div class="form-group col-md-6">
                                <input name="name" class="form-control" placeholder="Name" type="text" value="<?php
                                if (set_value('name')) {
                                    echo set_value('name');
                                }
                                ?>">
                                <labe class="error"><?php echo form_error('name') ?></labe>
                            </div>
                            <div class="form-group col-md-6">
                                <input name="email" class="form-control" placeholder="Email" type="email" value="<?php
                                if (set_value('email')) {
                                    echo set_value('email');
                                }
                                ?>">
                                <labe class="error"><?php echo form_error('email') ?></labe>
                            </div>
                            <div class="form-group col-md-12">
                                <input name="subject" class="form-control"  placeholder="Subject" type="text" value="<?php
                                if (set_value('subject')) {
                                    echo set_value('subject');
                                }
                                ?>">
                                <labe class="error"><?php echo form_error('subject') ?></labe>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message Here" value="<?php
                                if (set_value('message')) {
                                    echo set_value('message');
                                }
                                ?>"></textarea>
                                <labe class="error"><?php echo form_error('message') ?></labe>
                            </div>                        
                            <div class="form-group col-md-12">
                                <input name="submit" class="btn btn-primary pull-right" value="Submit" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                            <p>Newyork USA</p>
                            <p>Mobile: +2346 17 38 93</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: info@e-shopper.com</p>
                        </address>
                    </div>
                </div>    			
            </div>  
        </div>	
    </div>
</div>
<script>
    $(document).ready(function () {
<?php if ($this->session->flashdata('success')) { ?>
       var message= '<?php echo $this->session->flashdata('success'); ?>';
         notify(message,"success","top","right");
    <?php }
    ?>
    });
</script>