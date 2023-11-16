<?php 

function handleForm() {
  if ( 
    wp_verify_nonce($_POST['ourNonce'], 'saveDataChatBot') AND 
    current_user_can('manage_options')
  ) {
    update_option('ecs_chatbot_name', sanitize_text_field($_POST['ecs_chatbot_name']));
    update_option('ecs_chatbot_number', sanitize_text_field($_POST['ecs_chatbot_number']));
    update_option('ecs_chatbot_message', sanitize_text_field($_POST['ecs_chatbot_message']));
    update_option('ecs_chatbot_message_2', sanitize_text_field($_POST['ecs_chatbot_message_2']));
  ?>
    <div class="updated">
      <p>Your filtered words were saved.</p>
    </div>
  <?php } else { ?>
    <div class="error">
      <p>Sorry, you do not have permission to perform that action.</p>
    </div>
  <?php }
}
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
    function handle_read() {
      return get_option('ecs_chatbot_name');
    }
  }
}

new DashboardRoute();

