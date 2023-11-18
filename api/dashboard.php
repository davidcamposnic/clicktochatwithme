<?php 

class DashboardRoute {
  function __construct() {
    add_action( 'rest_api_init', 'register_route' );
    function register_route() {
      register_rest_route('clicktochat/v1', 'dashboard', array(
          'methods' => 'POST',
          'callback' => 'handle_create'
        )
      );
      register_rest_route( 'clicktochat/v1', 'dashboard', array(
          'methods' => WP_REST_SERVER::READABLE,
          'callback' => 'handle_read'
        )
      );
      register_rest_route('clicktochat/v1', 'dashboard', array(
          'methods' => 'DELETE',
          'callback' => 'handle_delete'
        )
      );
    }

    //function 
    function handle_create($data) {
      if(current_user_can('manage_options')) {
        // $queryParams = $data->get_body_params();
        return update_option('ecs_chatbot_name', sanitize_text_field($data['data']));;
      } else {
        die('Only logged in user can create a like.');
      }
    }
    
    function handle_read($data) {
      $result = array(
        'name' => get_option('ecs_chatbot_name'),
      );
      return $result;
    }
  }
}

new DashboardRoute();

