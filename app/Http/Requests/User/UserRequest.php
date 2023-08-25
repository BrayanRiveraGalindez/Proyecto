<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}


	public function rules()
	{
		$rules = [
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'number_id' => ['required', 'numeric'],
			'email' => ['required', 'email'],
			'password' => ['confirmed', 'string', 'min:8'],
		];

		if ($this->method() == 'POST') {
			array_push($rules['number_id'], 'unique:users,number_id');
			array_push($rules['email'], 'unique:users,email');
			array_push($rules['password'], 'required');
		} else {
			array_push($rules['number_id'], 'unique:users,number_id,' . $this->user->id);
			array_push($rules['email'], 'unique:users,email,' . $this->user->id);
			array_push($rules['password'], 'nullable');
		}

		if ($this->path() == 'users') {
			$rules['role'] = ['required', 'string', 'in:user,admin'];
		}

		return $rules;
	}

	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe ser válido',
			'last_name.required' => 'El apellido es requerido',
			'last_name.string' => 'El apellido debe ser válido',
			'number_id.required' => 'La cédula es requerida',
			'number_id.numeric' => 'La cédula debe ser numérica',
			'number_id.unique' => 'La cédula ya ha sido registrada',
			'email.required' => 'El correo es requerido',
			'email.email' => 'El correo debe ser válido',
			'email.unique' => 'El correo ya ha sido registrado',
			'password.required' => 'La contraseña es requerida',
			'password.confirmed' => 'Las contraseñas no coinciden',
			'password.string' => 'La contraseña debe ser válida',
			'password.min' => 'La contraseña debe tener al menos :min caracteres',
		];
	}
}
