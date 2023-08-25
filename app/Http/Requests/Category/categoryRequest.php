<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
{
    public function rules()
	{
		$rules = [
			'name' => ['required', 'string'],
		];

		if ($this->method() == 'POST') {
		} else {
			array_push($rules['name'], 'unique:categories,name,' . $this->categories->id);
		}

		return $rules;
	}

	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe de ser valido',
		];
	}
}
