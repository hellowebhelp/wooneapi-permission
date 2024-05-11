<?php

   // code for Authentication
   function custom_register_user_endpoint() {
    // endpoint Register
    register_rest_route( 'api_user_endpoint/v1', '/register', array(
    'methods' => 'POST',
    'callback' => 'custom_register_user_callback',
    ));
    
    // endpoint login
    register_rest_route('api_user_endpoint/v1', '/login', array(
    'methods' => 'POST',
    'callback' => 'custom_login_user_callback',
    ));
    
    }
    
    // Callback function to handle user register
    function custom_register_user_callback( $request ) {
        // Extract data from the request
        $username = $request->get_param( 'username' );
        $email = $request->get_param( 'email' );
        $password = $request->get_param( 'password' );
    
        // Validate input
        if ( empty( $username ) || empty( $email ) || empty( $password ) ) {
            return new WP_Error( 'registration_error', 'Please provide username, email, and password.', array( 'status' => 400 ) );
        }
    
        // Create user
        $user_id = wp_create_user( $username, $password, $email );
    
        if ( is_wp_error( $user_id ) ) {
            return new WP_Error( 'registration_error', $user_id->get_error_message(), array( 'status' => 400 ) );
        }
    
        return array( 'message' => 'User registered successfully.', 'user_id' => $user_id );
    }
    
    
    // Callback function to handle user login
    function custom_login_user_callback($request) {
        // Retrieve login data from request body
        $username = $request->get_param('username');
        $password = $request->get_param('password');
    
        // Perform user authentication
        $user = wp_authenticate($username, $password);
    
        if (is_wp_error($user)) {
            return new WP_Error('login_failed', $user->get_error_message(), array('status' => 401));
        }
    
        // User login successful, generate and return authentication token
        $token = generate_authentication_token($user->ID);
        return array('user_authentication' => $token);
    }
    
    // Function to generate authentication token (you would need to implement this)
    function generate_authentication_token($user_id) {
        $user = get_userdata($user_id);
        $username = $user->user_login;
        $email = $user->user_email;
        // Generate and return authentication token
        // This might involve creating a unique token and associating it with the user ID in your database
        return array(
            'user_id' => $user_id,
           'token' => "f%A<YN($5}a@g{T%cFN8j]Ixos$<^jPMYS-kaFLJwpk%H<F5pbb2k,eZkX}L",
           'username' => $username,
           'email' => $email,
        ); // Placeholder, replace with actual token generation logic
    }
    
    add_action( 'rest_api_init', 'custom_register_user_endpoint' );

    // end 
