<?php 
/** 
 * Components / Mailchimp Newsletter Form
 * 
 * @package Project Name Theme
 * 
*/

$mailchimp_action = isset($args['action']) ? $args['action'] : '';

?>

<form id="mc-form-newsletter" class="newsletter" autocomplete="off" action="<?php echo $mailchimp_action; ?>">  
  <div class="mt-2 w-max mx-auto" style="--mw: 450px;">
    <div class="input p-1 w-100">
      <label class="sr-only d-block mb-1">Email<span class="color-error">*</span></label>
      <input type="email" class="input-field" placeholder="Enter Your Email" name="EMAIL" id="mce-EMAIL" required>
    </div>
    <div class="input p-1">
      <button class="btn btn-primary" type="submit" aria-label="Submit">Submit</button>
    </div>
  </div>
  <div class="mt-1">
    <label class="input-alert caption" for="mce-EMAIL"></label>
  </div>
</form>

<div class="newsletter-success d-none text-center">Thank you for subscribing.</div>