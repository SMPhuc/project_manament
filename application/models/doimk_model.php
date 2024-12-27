<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class doimk_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function doimk($tk,$c,$m,$mm)
	{
		$this->db->select('*');
		if($this->db->where('account', $tk))
		{
			$dulieu= $this->db->get('account_list');
			$dulieu=$dulieu->result_array();
			foreach( $dulieu as $value )
    		{
        		if ($value['password']==$c && $m==$mm)
        		{
        			$dulieucanupdate= array(
					'account'=>$tk,
					'password'=>$m
				);
				$this->db->where('account',$tk);
				$this->db->update('account_list', $dulieucanupdate);
        		return true;
        		}
        		else return false;
    		}
		}
		else return false;

	}

}

/* End of file doimk_model.php */
/* Location: ./application/models/doimk_model.php */