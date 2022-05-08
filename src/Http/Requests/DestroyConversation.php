<?php

namespace Envatic\Chat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyConversation extends FormRequest
{
    public function authorized()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
