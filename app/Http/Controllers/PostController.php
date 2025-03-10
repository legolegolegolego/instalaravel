<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    public function showPost($id) {
        
        $post = Post::with('user', 'comments.user')->findOrFail($id);
        // $post = Post::find($id);
        
        return view('post', compact('post'));
    }

    public function showAllPosts() {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('posts', compact('posts'));
    }

    
    public function showFormPost(){
        return view('post-form');
    }
    
    // Método para crear un post, solo accesible para usuarios autenticados
    // No confuncir con el método showFormPost, que es para mostrar el formulario de creación de post
    public function createPost(Request $request) {

        // Obtiene los datos del formulario de registro
        $data = $request->all();

        // Valida los datos del formulario
        $validator = Validator::make(
            $data,
            [
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
        ], messages:[
            'title.required' => 'The title field is required',
            'title.max' => 'The title field cannot exceed 100 characters',
            'description.required' => 'The content field is required',
            'description.max' => 'The description field cannot exceed 1000 characters',
        ]);

        // Si falla la validación, redirige al formulario de registro con los errores
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Si la validación es correcta, crea un nuevo post
        $post = new Post();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->belongs_to = Auth::id();
        // $post->publish_date = now();
        $post->save();

        // Redirige al usuario a la página de inicio (donde se ven todos los post) tras crear el post con éxito
        return redirect()->route('posts');
    }

    public function deletePost($id) {
        $post = Post::findOrFail($id);

        // Comparar el id del usuario autenticado con el id del usuario que creó el post
        if ($post->belongs_to != Auth::id()) {
            // Si no coinciden, redirige al usuario a la página de posts con un mensaje de error
            return redirect()->route('posts')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect()->route('posts')->with('success', 'Post deleted successfully.');
    }
}
