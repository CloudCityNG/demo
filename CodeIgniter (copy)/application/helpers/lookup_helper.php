<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/form_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Look up value
 * @access	public
 * @param	string	table name
 * @param	string	column name
 * @param	array	a where condition
 * @return	string or array or false
 */
if ( ! function_exists('lookup_value'))
{
	function lookup_value($tbl, $colname, $where = array())
	{
		$CI =& get_instance();
		
		$CI->db->select($colname);
	    $CI->db->where($where);
		$query = $CI->db->get($tbl);
		if($query->num_rows() > 0)
		{
			if($query->num_rows() == 1)
			{
			   foreach($query->result() as $row){
				$value = $row->$colname;
			   }
			}else if($query->num_rows() > 1){
			  foreach($query->result() as $row){
				$value[] = $row->$colname;
			   }
			}
			return $value;
		}else{
		 return false;
		}
	}
}
// ------------------------------------------------------------------------

/**
 * Look up value
 * @access	public
 * @param	string	table name
 * @param	string	column name
 * @param	array	a where condition
 * @return	string or array or false
 */
if ( ! function_exists('edit_product'))
{
	function edit_product($tbl, $data, $where = array())
	{
		$CI =& get_instance();

	    $CI->db->where($where);
		return $CI->db->update($tbl, $data);
		
	}
}

// ------------------------------------------------------------------------

/**
 * Update Value
 * @access	public
 * @param	string	table name
 * @param	array	data
 * @param	array	a where condition
 * @return	string or array or false
 */
if ( ! function_exists('update_data'))
{
	function update_data($tbl, $data, $where = array())
	{
		$CI =& get_instance();

	    $CI->db->where($where);
		return $CI->db->update($tbl, $data);
		
	}
}

// ------------------------------------------------------------------------

/**
 * Insert Data
 * @access	public
 * @param	string	table name
 * @param	array	data
 * @return	string or array or false
 */
if ( ! function_exists('insert_data'))
{
	function insert_data($tbl, $data)
	{
		$CI =& get_instance();

		return $CI->db->insert($tbl, $data);
		
	}
}

// ------------------------------------------------------------------------

/**
 * get_first_letter
 * @access	public
 * @param	string	variant name
 * @return	string 
 */
if ( ! function_exists('get_first_letter'))
{
	function get_first_letter($word)
	{
		  $acronym = "";
		  $words = preg_split("/[\s,-]+/", $word);
		  if (strpos($word, '-') !== FALSE)
		  {
			   $ps = strpos($word, '-');
			   if($ps > 2)
			   {
				 foreach ($words as $w) {
				  $acronym .= $w[0];
				 }
				 return strtoupper($acronym);
			   }else
			   {
					$strlen = strlen($word);
					$acronym = substr($word,0,$ps);
					$finalstr = substr($word,$ps+1, $strlen-1);
					$words = preg_split("/[\s,-]+/", $finalstr);
					foreach ($words as $w) {
					 $acronym .= $w[0];
				   }
				   return strtoupper($acronym);
			   }
		  }
		  else
		  {
		    $words = preg_split("/[\s]+/", $word);
			 foreach ($words as $w) {
				  $acronym .= $w[0];
				 }
			return strtoupper($acronym);
		  } 	 
		
	}
}

// ------------------------------------------------------------------------

/**
 * get_percentage
 * @access	public
 * @param	integer	inventory
 * @return	integer 
 */
if ( ! function_exists('get_percentage'))
{
	function get_percentage($qty, $maxqty)
	{     //return $qty;
		  
		 $mul = 100 * $qty;
		
		return $mul / $maxqty;
	 }
	}
	if ( ! function_exists('addhttp'))
    {
		function addhttp($url) 
		{
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "http://" . $url;
		}
		return $url;
	   }
    }	   

/**
 * Create new session object for client interface
 * @access	public
 */
if ( ! function_exists('create_sess_object'))
{
	function create_sess_object()
	{
		$CI =& get_instance();
		
        $config_session1 = array(
			'sess_cookie_name' => 'session1',
			'sess_expiration' => 1800
		);
		$CI->load->library('session', $config_session1, 'session1');
		//return $CI->db->insert($tbl, $data);
		
	}
}
//Get days
if ( ! function_exists('get_days'))
{
	function get_days($dayname)
	{
		switch ($dayname) {
        case "Sunday":
        return 'Su';
        break;
        case "Monday":
        return "Mo";
        break;
        case "Tuesday":
        return "Tu";
        break;
		case "Wednesday":
        return "We";
        break;
		case "Thursday":
        return "Th";
        break;
		case "Friday":
        return "Fr";
        break;
		case "Saturday":
        return "Sa";
        break;
	}
   }
}
//Get two digit number
if ( ! function_exists('get_twodigit_no'))
{
	function get_twodigit_no($no)
	{
		switch ($no) {
        case "1":
        return '01';
        break;
        case "2":
        return "02";
        break;
        case "3":
        return "03";
        break;
		case "4":
        return "04";
        break;
		case "5":
        return "05";
        break;
		case "6":
        return "06";
        break;
		case "7":
        return "07";
        break;
		case "8":
        return "08";
        break;
		case "9":
        return "09";
        break;
		default:
		return $no;
	}
   }
}
/* End of file lookup_helper.php */
/* Location: ./application/helpers/lookup_helper.php */
