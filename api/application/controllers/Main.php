<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function faculty()
	{
		//http://localhost/feedbackit/api/index.php/main/faculty?roll=ue148021&branch=IT
		$roll = $this->input->get('roll');
		$branch = $this->input->get('branch');
		$br = $this->db->select('*')->where(['b_name'=>$branch])->get('branch_master');
		$query = $this->db->select('f_id as id,f_name as firstname,l_name as lastname')->where(['b_id'=>$br->row()->b_id])->get('faculty_master');
		echo json_encode($query->result());
	}

	function subject()
	{

		//http://localhost/feedbackit/api/index.php/main/subject?sem=7&faculty=29
		$semester = $this->input->get('sem');
		$faculty = $this->input->get('faculty');
		$sem = $this->db->select('*')->where(['sem_name'=>$semester])->get('semester_master');
		//echo json_encode($sem->result());
		$query = $this->db->select('*')->where(['sem_id'=>$sem->row()->sem_id,'f_id'=>$faculty])->get('subject_master');
		echo json_encode($query->result());
	}
}
