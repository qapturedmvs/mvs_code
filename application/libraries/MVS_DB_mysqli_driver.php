<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVS_DB_mysqli_driver extends CI_DB_mysqli_driver 
{
  // Extends parent constructor to log a message
  public function __construct($params = NULL)
  {
    parent::__construct($params);
    
    if ($this->db_debug)
    {
      log_message('debug', 'MY_DB_mysqli_driver class instantiated!');
    }
  }
    
  /**
   * ---------------------------------------------------------------------
   * Calls a stored procedure and handles buffered results.
   * ---------------------------------------------------------------------
   *
   * @param string $procedure_name The name of the stored procedure to be called
   * @param array $args Array with stored procedure arguments
   * @param array ref $out_params Associative array with the procedure OUT parameters.
   * @return mixed A multi-dim array if procedure returns data; TRUE on success with no data; FALSE on failure
   */
  public function call_procedure($procedure_name, $args = array(), &$out_params = array())
  {
    $args_str = '';
    $out_params_str = '';
    $select_out_params_sql = '';
    $data = '';
    $result = NULL;
    $mysqli = $this->conn_id;

    // Escape and prepare procedure arguments
    if ($args)
    {
      foreach ($args as $key => $val)
      {
        $args[$key] = '"' . $this->escape_str($val) . '"';
      }
      $args_str = implode(', ', $args);
    }

    // Do we have OUT parameters? If so, prepare select statement to get them after the procedure is executed
    if ($out_params)
    {
      $out_params_str = implode(', ', array_keys($out_params));
      $select_out_params_sql = 'SELECT ' . $out_params_str . ';';

      // We need a comma to separate regular parameters from out parameters in the CALL statement
      $out_params_str = ',' . $out_params_str;
    }

    // Build a sql statement to call the stored procedure
    $query = 'CALL ' . $procedure_name . '(' . $args_str . $out_params_str . ');' . $select_out_params_sql;
    //var_dump($query);
    // Was the call successful? If so, process the results...
    if ($mysqli->multi_query($query)) // this generates buffered resultsets
    {
      // The first result contains the main data returned by the procedure, if any
      if($result = $mysqli->store_result())
      {
        // Put result rows into an array so we can return a db platform-independent array
        $data = array();
        while ($row = $result->fetch_assoc())
        {
          $data[] = $row;
        }
      }

      // Loop through buffered results to get any OUT param values and clear each result
      while ($mysqli->more_results() && $mysqli->next_result())
      {
        $result = $mysqli->use_result();
        if ($result instanceof mysqli_result)
        {
          $out_params = $result->fetch_assoc();
          $result->free();
        }
      }
    }
    else
    {
      return FALSE;
    }

    // No data returned by procedure? If we made it this far, the procedure execution was successful but did not return any data.
    if ($data == '')
    {
      return TRUE;
    }
    return $data;
  }
  
  public function call_multi_table_procedure($procedure_name, $args = array())
  {
    $args_str = '';
    $data = '';
    $result = NULL;
    $mysqli = $this->conn_id;

    // Escape and prepare procedure arguments
    if ($args)
    {
      foreach ($args as $key => $val)
      {
        $args[$key] = '"' . $this->escape_str($val) . '"';
      }
      $args_str = implode(', ', $args);
    }

    // Build a sql statement to call the stored procedure
    $query = 'CALL ' . $procedure_name . '(' . $args_str . ');';
    //var_dump($query);
    // Was the call successful? If so, process the results...
    if ($mysqli->multi_query($query)) // this generates buffered resultsets
    {
      // The first result contains the main data returned by the procedure, if any
      if($result = $mysqli->store_result())
      {
        // Put result rows into an array so we can return a db platform-independent array
        $data = array();
        
        while ($row = $result->fetch_assoc())
        {
          $data[0][] = $row;
        }
        
        $result->free();
        
        if($mysqli->more_results()){
          
          $index = 1;
          
          while($mysqli->more_results() && $mysqli->next_result()){
            
            $result = $mysqli->store_result();
            
            if($result instanceof mysqli_result){
              
              while ($row = $result->fetch_assoc())
              {
                $data[$index][] = $row;
              }
              
              $index++;
              
              $result->free();
              
            }
            
          }
          
        }
        
      }

    }
    else
    {
      return FALSE;
    }

    // No data returned by procedure? If we made it this far, the procedure execution was successful but did not return any data.
    if ($data == '')
    {
      return TRUE;
    }
    return $data;
  }
}