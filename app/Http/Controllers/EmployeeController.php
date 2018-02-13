<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    public function index ()
    {
     	return Employee::all();
    }

    public function show ($id)
    {
    	return Employee::find($id);
    }

    public function create () 
    {

    }

    public function store (Request $req) 
    {
    	$newEmp = new Employee();
    	$newEmp->FirstName 	= $req['FirstName'];
    	$newEmp->LastName 	= $req['LastName'];
    	$newEmp->Position 	= $req['Position'];
    	$newEmp->EmpCode 	= $req['EmpCode'];
    	$newEmp->Office 	= $req['Office'];
    	
    	if ($newEmp->save()) {
    		return [
    			'status' 	=> 'OK',
    			'message'	=> 'Successfully'
    		];
		}
    }

    public function edit ($id) 
    {
    	return Employee::find($id);
    }
    
    public function update (Request $req) 
    {

    }

    public function delete ($id  ) 
    {
    	$emp = Employee::find($id);
    	if ($emp->delete()) {
    		return [
    			'status' 	=> 'OK',
    			'message'	=> 'Successfully'
    		];
    	}
    }
}
