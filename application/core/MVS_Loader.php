<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVS_Loader extends CI_Loader
{
  // Extends the native CI database() function.
  public function database($params = '', $return = FALSE, $active_record = NULL)
  {
    // Grab the super object
    $CI =& get_instance();
    
    // Do we even need to load the database class?
    if (class_exists('CI_DB') AND $return == FALSE AND $active_record == NULL AND isset($CI->db) AND is_object($CI->db))
    {
      return FALSE;
    }

    require_once(BASEPATH.'database/DB.php');

    if ($return === TRUE)
    {
      // Commented out: Let's not return yet so we can extend the driver.
      //return DB($params, $active_record);
      
      /*----------- Begin db driver extension 1 -----------*/
      $db = DB($params, $active_record);
      
      $my_driver = config_item('subclass_prefix') . 'DB_' . $db->dbdriver . '_driver';
      $my_driver_file = APPPATH . 'libraries/' . $my_driver . '.php';
    
      require_once($my_driver_file);
      return new $my_driver(get_object_vars($db));
      /*----------- End db driver extension 1 -----------*/
    }

    // Initialize the db variable.  Needed to prevent
    // reference errors with some configurations
    $CI->db = '';

    // Load the DB class
    $CI->db =& DB($params, $active_record);
    
    /*----------- Begin db driver extension 2 -----------*/
    $my_driver = config_item('subclass_prefix') . 'DB_' . $CI->db->dbdriver . '_driver';
    $my_driver_file = APPPATH . 'libraries/' . $my_driver . '.php';
    
    require_once($my_driver_file);
    $CI->db = new $my_driver(get_object_vars($CI->db));
    /*----------- End db driver extension 2 -----------*/
  }
}