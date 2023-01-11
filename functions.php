<?php
// Show errors for debugging. Remove this for production
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Require config file
require_once( 'config.php' );

// Process the form data
function process_form($post) {
    print_r($post);

 
  // Validate data
  $validation = validate_data( $post );

  if ( ! $validation['status'] ) {
    return array( 'status' => 0, 'errors' => $validation['data'] );
  }

  // Use validated data
  $data = $validation['data'];

  // Process database actions
  if ( ! process_database( $data ) ) {
    return array( 'status' => 0 );
  }

  

  return array( 'status' => 1 );
}





// Validate field data
function validate_data( $post ) {
  // Globalize the whitelist
  global $whitelist;

  // Whitelist data
  foreach ( $whitelist as $key ) {
    $fields[$key] = $post[$key];
  }

  // Validate data
  $errors = array();

  foreach ( $fields as $field => $data ) {
    if ( empty( $data ) ) {
      $errors[] = 'Please enter your ' . $field;
    }
  }

  // Check for errors
  if ( empty( $errors ) ) {
    return array( 'status' => 1, 'data' => $fields );
  } else {
    return array( 'status' => 0, 'data' => $errors );
  }
}


// Process database actions
function process_database( $post ) {
  global $table;

  // Connect to database
  $mysqli = new mysqli( DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );

  // Check database connection
  if ( $mysqli->connect_error ) {
    return false;
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  } else {
      echo 'Connected';
      $stmt = $mysqli->prepare( "INSERT INTO $table ( Name,Address,PIN,Contact,Birth ) VALUES ( ?,?,?,?,?)" ); 
      $stmt->bind_param("sssss",$Name , $Address ,$PIN,$Contact,$Birth );
      
      $Name = $post['Name'];
      $Address = $post['Address'];
      $PIN = $post['PIN'];
      $Contact = $post['Contact'];
      $Birth = $post['Birth'];
      
      if ( ! $stmt->execute() ) {
        return false;
      } 
  }
  return true;
}


// Validate input
function validate_input( $input_name ) {
  global $sent;

  if ( empty( $_POST ) ) {
    return '';
  }

  if ( $sent ) {
    return '';
  }

  return _e( $_POST[$input_name] );
}

// Esacpe output
function _e( $string ) {
  return htmlentities( $string, ENT_QUOTES, 'UTF-8', false );
}
