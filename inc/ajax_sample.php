<?php

// add_action("wp_ajax_get_team_data", "get_team_data");
// add_action("wp_ajax_nopriv_get_team_data", "get_team_data");

// action name
// request to admin.php/? actionName


function get_team_json(){  
   return //json;
}

function get_team_data() {

   if ( !wp_verify_nonce( $_REQUEST['nonce'], "team_nonce")) {
      exit("No naughty business please");
   }   

   echo get_team_json();

   die();

}

