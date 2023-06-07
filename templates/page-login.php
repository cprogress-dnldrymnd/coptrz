<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Login Page
/*-----------------------------------------------------------------------------------*/
?>

<?php get_header(); ?>
<section class="login-form">
  <div class="container-fluid g-0">
    <div class="row">
      <div class="col-lg-4">
        <div class="column-holder">
          <?php get_template_part('woocoomerce/globals/form-login'); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>