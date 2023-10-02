<?php
	class M_Admin extends CI_Model{
		var $tb = "admin";
		var $id = "id_admin";
		
		
		function check($where){	// cek data berdasarkan username dan password	
			return $this->db->get_where($this->tb,$where);
		}
		
		public function is_login() // cek session username, dan ambil data admin dari session tsb
		{
			if (!$this->session->has_userdata('username')) {
				return null;
			}

			$username = $this->session->userdata('username');
			$query = $this->db->get_where($this->tb, array('username' => $username));
			return $query->row();
		}
		
		function get_all() // ambil semua data admin kecuali superadmin / admin default
		{
			return $this->db->get_where($this->tb, array('level !=' => 'superadmin'));
		}
		
		
		function post($data) // input data
		{
			$this->db->insert($this->tb,$data);
		}	
		function hapus($key) // hapus data data
		{
			$this->db->delete($this->tb, array($this->id => $key)); 
		}
		function del_verif($key)
		{
			$this->db->delete("verifikasi", array("id_register" => $key)); 
		}
		function get_one($key)
		{
			return $this->db->get_where($this->tb, array($this->id => $key));
		}
		function edit($data, $key)
		{
			$this->db->where($this->id, $key);
			$this->db->update($this->tb, $data);
		}
		
		
		function ganti($data, $key)
		{
			$this->db->where($this->id, $key);
			$this->db->update($this->tb, $data);
		}	
	}	