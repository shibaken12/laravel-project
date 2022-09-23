<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Facades\Auth;

//Hashファサードを使用するための宣言
use Illuminate\Support\Facades\Hash;

class Current implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 返り値は「true or false」になるように記述
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pass = Auth::user()->password;
        return (Hash::check($value, $pass));
    }

    /**
     * エラーだった場合のメッセージを記述する
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '現在のパスワードが一致しません';
    }
}
