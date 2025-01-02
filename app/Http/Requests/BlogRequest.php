<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'blog.title' => 'required|string|max:100',
            'blog.body' => 'required|string|max:4000',
        ];
    }
}
