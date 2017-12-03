<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewBag 
{
    public function header()
    {
        return 'layout/header';
    }
    
    public function footer()
    {
        return 'layout/footer';
    }

    public function navbar()
    {
        return 'layout/navbar';
    }

    public function family_create()
    {
        return 'family/create';
	}
	
	public function family_search() 
	{
		return 'family/search';
	}

	public function family_addFamilyMember()
	{
		return 'family/addFamilyMember';
	}

	public function admin_header()
	{
		return 'layout/header';
	}

	public function admin_footer()
	{
		return 'layout/footer';
	}

	public function admin_home()
	{
		return 'admin/home';
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

	public function form_event()
	{
		return 'create_event';
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
		return 'family_search';
	}

	public function form_register_family_event()
	{
		return 'register_family_event';
	}


}