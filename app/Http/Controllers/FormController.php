<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FormController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function sendForm(Request $request)
    {
        $respondData = [
            'message' => 'Данные успешно обработаны',
            'status' => 200
        ];
        $result = User::firstOrCreate($this->validateEmail($request));
        if (!$result) {
            $respondData['message'] = 'Ошибка сервера';
            $respondData['status'] = 500;
        }

        return response(['message' => $respondData['message'], $respondData['status']]);

    }

    public function validateEmail(Request $request)
    {
        return Validator::make($request->json()->all(), [
            'email' => 'email:rfc,dns',
        ])->validate();
    }

}
