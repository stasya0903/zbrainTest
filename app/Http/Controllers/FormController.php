<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class FormController extends Controller
{
    public function index()
    {
        return view('form');
    }
    public function sendForm(Request $request){

        return '123';
    }

}
