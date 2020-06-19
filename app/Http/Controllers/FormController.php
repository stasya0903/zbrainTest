<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class FormController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function sendForm(Request $request)
    {
        $email = Request::json()->all();
        $result = User::firstOrCreate( $email);
        if ($result) {
            return response(null, 200);
        } else response(null, 500);

    }

}
