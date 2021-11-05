<?php

/*Template Name: Contact Layout*/
get_header();  
?>
<div class="wrap-crumbs container my-3"><?php if(function_exists('breadcrumb')){breadcrumb();} ?></div>
<div class="contact-form">
  <div class="container">
    <div class="row">
      <div class="col-md-6 order-sm-1 mb-5">
        <p class="mb-4">Mọi thắc mắc hoặc góp ý, quý khách vui lòng liên hệ trực tiếp với bộ phận chăm sóc khách hàng của chúng tôi bằng cách điền đầy đủ thông tin vào form bên dưới</p>
        <div class="wrap-form-contact">
          <?php echo contactForm(); ?>                  
        </div>
      </div>
      <div class="col-md-6 mb-5">
        <?php if(get_option('google_map') !='') { echo'<div class="wrap-map">'.get_option('google_map').'</div>';}?>            
      </div>      
    </div>
  </div>  
</div>
<?php get_footer(); ?>

