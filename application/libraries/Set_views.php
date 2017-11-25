<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_views 
{

	public function admin_header()
	{
		return 'header';
	}

	public function admin_footer()
	{
		return 'footer';
	}

	public function form_family()
	{
		return 'create_family';
	}

	public function form_participant()
	{
		return 'add_family_member';
	}

	public function form_success()
	{
		return 'form_success';
	}

	public function ajax()
	{
		return 'js/ajax';
	}

	public function login()
	{
		return 'user_login';
	}

	public function search_family()
	{
		return 'test/family_search';
	}


}