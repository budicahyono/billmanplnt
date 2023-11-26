<?php
	class M_Admin extends CI_Model	{
		var $tb = "admin";
		var $id = "id_admin";
		
		
		function check($where)
		{	// cek data berdasarkan username dan password	
			return $this->db->get_where($this->tb,$where);
		}
		
		
		
		function is_login() 
		{	// cek session username, dan ambil data admin dari session tsb
			if (!$this->session->has_userdata('username')) {
				return null;
			}

			$username = $this->session->userdata('username');
			$query = $this->db->get_where($this->tb, array('username' => $username));
			return $query->row();
		}
		
		
		
		function get_all() 
		{	// ambil semua data admin kecuali superadmin / admin default
			return $this->db->get_where($this->tb, array('level !=' => 'superadmin'));
		}
		
		
		
		function post($data) 
		{	// input data
			$this->db->insert($this->tb,$data);
		}	
		
		
		
		function hapus($id_admin) 
		{	// hapus data admin
			$this->db->delete($this->tb, array($this->id => $id_admin)); 
		}
		
		
		
		function get_one($id_admin)
		{	// ambil satu data admin
			return $this->db->get_where($this->tb, array($this->id => $id_admin));
		}
		
		
		
		function edit($data, $id_admin)
		{	// edit satu data admin
			$this->db->where($this->id, $id_admin);
			$this->db->update($this->tb, $data);
		}
		
		
		
	}	