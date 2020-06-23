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
            'message' => 'Почтовый адресс успешно добавлен',
            'status' => 200
        ];
        $validator = $this->getValidatorForEmail($request);

        if ($validator->fails()) {
            $respondData['message'] = $validator->errors()->first('email');
            $respondData['status'] = 400;
            return response(['message' => $respondData['message'], $respondData['status']]);

        }

        $result = User::create($request->json()->all());
        if (!$result) {
            $respondData['message'] = 'Ошибка добавления в базу';
            $respondData['status'] = 400;
        }

        return response(['message' => $respondData['message'], $respondData['status']]);

    }

    public function getValidatorForEmail(Request $request)
    {
        $rules = [
            'email' => 'email:rfc,dns|unique:users'
        ];
        $messages = [
            'email.email' => 'Неверный формат электронной почты',
            'email.unique' => 'Такой почтовый адресс уже есть в базе',
        ];
        return Validator::make($request->json()->all(), $rules, $messages);
    }

}
