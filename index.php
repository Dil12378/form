<?php
//Helper functions
require_once( 'functions.php' );

// Instantiate variables we'll use
$errors = array();
$sent = false;

// Check for form submission
if ( ! empty( $_POST ) ) {
    print_r($_POST);
	// Process the form
	$process = process_form( $_POST );

	// Check for errors
	
	 if ( ! empty( $process['errors'] ) ) {
		$errors = $process['errors'];
	} else {
		$sent = true;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PHP Contact Form</title>
		<!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="assets1/general.css">
  	        <link rel="stylesheet" href="assets1/style.css">
	</head>
  <body>
    <div class="main-content">
	<div class="form">
	    <form class="form-validation" method="post" action="index.php">
	        <div class="form-title-row">
	          <h1>About Your Self</h1>
	        </div>
	        <?php if ( ! empty( $errors ) ) : ?>
	        <div class="errors">
	        	<p class="bg-danger"><?php echo implode( '.</p><p class="bg-danger">', $errors ); ?>.</p>
	        </div>
	        <?php elseif ( $sent ) : ?>
	        <div class="success">
	          <p class="bg-success">Your message was sent. We'll be in touch.</p>
	        </div>
	        <?php endif; ?>
	        <div class="form-row form-input-name-row">
	          <label for="Name">
	            <span>Your name</span>
                  </label>
                    <input id="Name" type="text" name="Name" placeholder="your full name"
                                                                   value="<?php echo validate_input('Name'); ?>">  
	        </div>
                <div class="form-row form-input-name-row">
	          <label for="Address">
	            <span>address</span>
                  </label>
	            <input id="Address" type="text" name="Address" placeholder="street address"
								   value="<?php echo validate_input('Address'); ?>">
	         
	        </div>
	        <div class="form-row form-input-name-row">
	          <label for="PIN">
	            <span>PIN</span>
                  </label>
	            <input id="PIN" type="text" name="PIN" placeholder=""
								   value="<?php echo validate_input('PIN'); ?>">
	         
	        </div>
	        <div class="form-row form-input-name-row">
	          <label for="Contact">
	            <span>Contact</span>
                  </label>
	            <input id="Contact" type="text" name="Contact" placeholder=""
								   value="<?php echo validate_input('Contact'); ?>">
	         
	        </div>
                <div class="form-row form-input-name-row">
	          <label for="Birth">
	            <span>Date of Birth</span>
                  </label>
	            <input id="Birth" type="date" name="Birth" placeholder=""
								   value="<?php echo validate_input('Birth'); ?>">
	        
	        </div>	       	        
	        <div class="form-row">
	          <button type="submit">Submit Form</button>
	        </div>
	    </form>
	</div>
    </div>
   
  </body>
</html>
