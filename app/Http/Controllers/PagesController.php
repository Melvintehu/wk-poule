<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Partner;
use App\Project;
use App\Category;
use App\CaseProject;
use App\Employee;
use App\Review;

class PagesController extends Controller
{
    public function homepage()
    {
        $review = Review::orderBy('created_at', 'desc')->first();
        $case = CaseProject::orderBy('created_at', 'desc')->first();

        $random_case = CaseProject::inRandomOrder()->first();

        return view('homepage', compact('review', 'case', 'random_case'));
    }

    public function about() 
    {
        $employees = Employee::all();

        return view('pages.about', compact('employees'));
    }

    public function aboutPerson($id, $name) 
    {
        $employee = Employee::find($id);
        $employee->occupations = explode(',', $employee->occupation);

        $cases = CaseProject::inRandomOrder()->get()->take(3);
        // dd($employee->occupations);
        return view('pages.about-person', compact('employee', 'cases'));
    }

    public function cases() 
    {
        return view('pages.cases');
    }

    public function apps() 
    {
        return view('pages.apps');
    }

    public function websites() 
    {
        return view('pages.websites');
    }

    public function design() 
    {
        return view('pages.design');
    }

    public function blog() 
    {
        return view('pages.blog');
    }

    public function blogClickPage() 
    {
        return view('pages.blog-doorklik');
    }

    public function contact() 
    {
        return view('pages.contact');
    }

    public function invoice() 
    {
        return view('pages.invoice');
    }



}
