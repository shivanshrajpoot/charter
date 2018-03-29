<div class="gtco-loader"></div>
    
<div id="page">


<!-- <div class="page-inner"> -->
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0 text-left">
                <div class="row row-mt-15em">

                    <div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
                        <h1>Reset Password</h1> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</header>


<div class="gtco-section border-bottom">
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 animate-box">
                <?php if (!$this->session->flashdata('is_valid')): ?>
                    <h3>Reset Password 
                        <small>
                            <span class="la la-info" data-toggle="tooltip" title="Make sure that the password you enter is strong and easy to remember."></span>
                        </small>
                    </h3>
                    <?php echo form_open(); ?>
                        <div class="row form-group">
                            <input type="hidden" name="id_user" value="<?php echo @$id_user; ?>">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" required autofocus class="form-control" id="newPassword" placeholder="New Password" name="password">
                                    <?php echo form_error('password','<span class="text-danger">','</span>'); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" required autofocus class="form-control" id="confirmPassword" placeholder="Confirm Password" name="password_conf">
                                    <?php echo form_error('password_conf','<span class="text-danger">','</span>'); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <span class="text-warning">
                                        <?php echo @$this->session->flashdata('msg') ? @$this->session->flashdata('msg') : '' ?>
                                    </span>
                                        
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-outline-warning">
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    </div>
                <?php else: ?>
                    <h3><?php echo $this->session->flashdata('is_valid'); ?></h3>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>