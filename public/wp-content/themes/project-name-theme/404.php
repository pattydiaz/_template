<?php 
/** 
 * 404 template
 * 
 * @package Project Name Theme
*/

// wp_redirect( home_url() ); exit;

get_header();

?>

<div id="wrapper" class="error-page">
  
  <section class="error404 section-100 section">

    <div class="container">
      <div class="error404-text text-center middle">
        <h1 class="heading-1 mb-1">404</h1>
        <h2 class="heading-5">The page you are looking for cannot be found.</h2>
        <div class="cta mt-2">
          <a href="<?php echo URL;?>" class="btn btn-primary" title="Back Home">Back Home</a>
        </div>
      </div>
    </div>

  </section>

</div>

<?php 
get_footer();