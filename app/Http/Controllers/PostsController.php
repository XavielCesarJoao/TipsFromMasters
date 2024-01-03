<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    private $frutas = ['Manga', 'Pera'];

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('blog.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('blog.show', ['post' => $post]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $request->validate([
            'title' => 'required|unique:posts|max:200',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:5048'],
            'min_to_read' => 'required|min:1|max:30',
        ]);
        $post->gravarRegistroNaBd($request, $this->storageImage($request));

        return $this->index();
    }

    public function edit($id)
    {
        return view('blog.edit', ['post' => Post::where('id', $id)->first()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200|unique:posts,title,'.$id,
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['mimes:png,jpg,jpeg', 'max:5048'],
            'min_to_read' => 'required|min:1|max:30',
        ]);

        Post::atualizarRegisto($request, $id);

        // Post::where('id', $id)->update(
        //     $request->except(['_token', '_method'])
        // );

        return redirect(route('blog.index'));
    }

    public function storageImage($requeste)
    {
        $newImageName = uniqid().'-'.$requeste->title.'.'.$requeste->image->extension();

        return $requeste->image->move(public_path('image'), $newImageName);
    }

    // Metodos definidos na interface

    public function inserirRegistro($title)
    {
        try {
            $post = DB::insert('insert into posts (title, excerpt, body, min_to_read, image_path, is_published) 
            values (? ,? ,? ,? ,? ,?)',
                [$title, 'TEXT EXCERPT', 'RANDON BODY', 17, 'IMAGE PATH TEXT', 0]);

            return $post;
        } catch (\Exception $ex) {
            Log::alert('Erro ao inserir no banco de dadps'.$ex);
        }
    }
}
