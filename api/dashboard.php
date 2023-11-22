<?php 

class DashboardRoute {
  function __construct() {
    add_action( 'rest_api_init', 'register_route' );
    function register_route() {
      register_rest_route('clicktochat/v1', 'data/name', array(
          'methods' => 'POST',
          'callback' => 'handle_create_name'
        )
      );
      register_rest_route('clicktochat/v1', 'data/messages', array(
          'methods' => 'POST',
          'callback' => 'handle_create_messages'
        )
      );
      register_rest_route( 'clicktochat/v1', 'data', array(
          'methods' => WP_REST_SERVER::READABLE,
          'callback' => 'handle_read'
        )
      );
    }

    //function 
    function handle_create_name($data) {
      if(current_user_can('manage_options')) {
        return update_option('ecs_chatbot_name', sanitize_text_field($data['data']));;
      } else {
        die('Only logged in user can create a like.');
      }
    }

    function handle_create_messages($data) {

      $data = (array) $data['data'];
      $result = array();

      foreach($data as $key => $value) {
        array_push($result, sanitize_text_field($value));
      }

      if(current_user_can('manage_options')) { 
        return update_option('ecs_clicktochat_messages', $result);
      } else {
        die('Only logged in user can create a like.');
      }
    }
    
    function handle_read($data) {
      $result = array(
        'name' => get_option('ecs_chatbot_name'),
        'messages' => get_option( 'ecs_clicktochat_messages' )
      );
      return $result;
    }
  }
}

new DashboardRoute();

