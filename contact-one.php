<?php //Template Name: Contact Page 
get_header();
get_template_part('breadcrumbs');
?>

<div class="container">

    <div id="content">

        <?php
            the_post();
			the_content();
        ?>

        <div class="row">

            <div class="col-sm-6">

                <h3>You may send us mail</h3>

                <form role="form">

                    <div class="form-group">
                        <label for="exampleInputName">Your name</label>
                        <div class="form-control-wrap form-control-wrap-name">
                            <input type="text" class="form-control" id="exampleInputName" placeholder="Enter your name" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <div class="form-control-wrap form-control-wrap-email">
                            <input type="email" class="form-control input-w-icon input-email" id="exampleInputEmail" placeholder="Enter your email">
                        </div>
                   </div>

                    <div class="form-group">
                        <label for="exampleInputPhone">Your phone</label>
                        <div class="form-control-wrap form-control-wrap-phone">
                            <input type="text" class="form-control input-w-icon input-phone" id="exampleInputPhone" placeholder="Enter your phone number">
                        </div>
                    </div>

                    <div class="form-group">
                        <p class="help-block">Upload your file</p>
                        <input type="file" id="exampleInputFile" />
                    </div>

                    <div class="checkbox">
                        <label>
                          <input type="checkbox"> Check me out
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-submit pull-right">Submit</button>
                    </div>


                </form>

            </div>

            <div class="col-sm-6">

            <?php if($settings['google_maps_url']): ?>
            <!-- Google map -->

            <iframe src="<?php echo $settings['google_maps_url']; ?>" width="100%" allowfullscreen scrolling="no" height="500" frameborder="0" marginheight="0" marginwidth="0"></iframe>

            <?php endif; ?>


            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /#content -->
</div>
<!-- /.container -->

<?php get_footer(); ?>