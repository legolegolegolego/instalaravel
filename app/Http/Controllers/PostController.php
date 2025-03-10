<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{

    public function likePost($id) {
        $post = Post::findOrFail($id);
        $post->n_likes = $post->n_likes + 1;
        $post->save();

        return redirect()->route('posts')->with('success', 'Post liked successfully.');
    }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], messages:[
            'title.required' => 'The title field is required',
            'title.max' => 'The title field cannot exceed 100 characters',
            'description.required' => 'The content field is required',
            'description.max' => 'The description field cannot exceed 1000 characters',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
            'image.max' => 'The image may not be greater than 2048 kilobytes',
        ]);

        // Si falla la validación, redirige al formulario de registro con los errores
        if ($validator->fails()) {
            return redirect()->route('create-post')
                ->withErrors($validator)
                ->withInput();
        }

        // Si la validación es correcta, crea un nuevo post
        $post = new Post();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->belongs_to = Auth::id();

        // Manejar la subida de la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image_url = $imageName;
        }

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
