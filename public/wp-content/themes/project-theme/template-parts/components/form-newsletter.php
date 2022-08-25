<?php 
/** 
 * Components / Newsletter Form
 * 
 * @package Project Name Theme
 *
 * 
*/

$id = $args['id'];
$action = $args['action'];

?>

<div class="container container-sm">

  <form id="<?php echo $id; ?>" class="form-newsletter" autocomplete="off" action="<?php echo $action;?>">
    <div class="input mt-2">
      <label class="input-label sr-only" for="mce-FNAME">First Name</label>
      <input type="text" class="input-field" placeholder="First Name" name="FNAME" id="mce-FNAME">
    </div>
    <div class="input mt-2">
      <label class="input-label sr-only" for="mce-LNAME">Last Name</label>
      <input type="text" class="input-field" placeholder="Last Name" name="LNAME" id="mce-LNAME">
    </div>
    <div class="input mt-2">
      <label class="input-label sr-only" for="mce-EMAIL">Email</label>
      <input type="email" class="input-field" placeholder="Email" name="EMAIL" id="mce-EMAIL" required>
    </div>
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_943b53437b18ea0319f5a30f7_9deeca2047" tabindex="-1" value=""></div>
    <div hidden="true"><input type="hidden" name="tags" value="1764014"></div>
    <div class="input mt-2 text-center">
      <button class="btn btn-secondary" type="submit" aria-label="Sign Up">SIGN UP</button>
      <div class="mt-1"><label class="input-alert caption" for="mce-EMAIL"></label></div>
    </div>
  </form>

</div>