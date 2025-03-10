<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLogin() {
        return view('login');
    }
    public function showRegister() {
        return view('register');
    }

    
    public function deleteAccount() {
        
        // Obtiene el usuario actual autenticado
        $user = Auth::user();
        
        // Encuentra al usuario actual en la bd y lo borra
        User::find($user['id'])->delete();
        
        Auth::logout(); // borra la session de la BD
        
        // Redirige a la página de registro para crear una cuenta
        return redirect()->route('register');
    }
    
    public function doLogout() {
        Auth::logout(); // borra la session de la BD
        return redirect()->route('login');
    }

    public function doRegister(Request $request){
        
        // Obtiene los datos del formulario de registro
        $data = $request->all();
        
        // Valida los datos del formulario
        $validator = Validator::make(
            $data,
            [
            'name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6',
        ], messages:[
            'name.required' => 'The name field is required',
            'name.max' => 'The name field cannot exceed 50 characters',
            'email.required' => 'The email field is required',
            'email.email' => 'The email field must be a valid email address',
            'email.max' => 'The email field cannot exceed 100 characters',
            'email.unique' => 'The email is already in use',
            'password.required' => 'The password field is required',
            'password.min' => 'The password field must be at least 6 characters long',
        ]);

        // Si falla la validación, redirige al formulario de registro con los errores
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Si la validación es correcta, crea un nuevo usuario
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        // Redirige al usuario a la página de login tras registrarse con éxito
        return redirect()->route('login');
    }

    public function doLogin(Request $request){
        // Obtiene los datos del formulario de login
        $data = $request->all();

        // Valida los datos del formulario
        $validator = Validator::make(
            $data,
            [
            "email" => "required|email:rfc,dns|exists:App\Models\User,email",
                "password" => "required",
        ]);

        // Si falla la validación, redirige al formulario de login con los errores
        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $email = $data['email'];
        $password = $data['password'];

        $emailAndPasword = [
            'email' => $email,
            'password' => $password
        ];

        // Si la validación es correcta, intenta autenticar al usuario
        // Auth::attempt busca al usuario en la base de datos y, si las credenciales son correctas, 
        // devuelve true y además crea una Session en la BD
        if (Auth::attempt($emailAndPasword, true)) {
            // Si la autenticación es correcta, redirige al usuario a la página de inicio
            $request->session()->regenerate();

            // los 2 comentarios son para cuando necesite quedarme con el user, y hacer algo como enviar id
            // lo implementare cuando avance
            // $user = User::where('email', $email)->first();
            return redirect()->route('posts'); // ['id' => $user->id]
        } else {
            $validator->errors()->add('credentials', 'Invalid email or password');
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

    }
}
