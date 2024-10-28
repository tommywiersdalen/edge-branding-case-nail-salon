<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Termwind\Components\Dd;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user'])->mostRecent()->get();
        return inertia(
            'Post/Index',
            [
                'posts' => $posts
            ]

        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading' => 'required|max:255',
            'article' => 'required'
        ], [
            'article.required' => 'Dette feltet er påkrevd',
            'heading.required' => 'Dette feltet er påkrevd',
            'heading.max' => 'Teksten kan ikke være lengre enn 255 tegn',
            'image.image' => 'Den valgte filen må være et bilde',
            'image.mimes' => 'Bildet må være i et av følgende formater:jpeg,png,jpg,gif',
            'image.max' => 'filen kan ikke være større en 2mb',

        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');


            $request->user()->posts()->create([
                'image' =>  $path,
                'heading' => $request->heading,
                'article' => $request->article
            ]);
        } else {
            $request->user()->posts()->create([
                'image' =>  null,
                'heading' => $request->heading,
                'article' => $request->article
            ]);
        }


        return redirect()->route('post.index')->with('success', 'Innlegget ble opprettet!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return inertia('Post/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'nullable',
            'heading' => 'required|max:255',
            'article' => 'required'
        ], [
            'article.required' => 'Dette feltet er påkrevd',
            'heading.required' => 'Dette feltet er påkrevd',
            'heading.max' => 'Teksten kan ikke være lengre enn 255 tegn',
            'image.image' => 'Den valgte filen må være et bilde',
            'image.mimes' => 'Bildet må være i et av følgende formater:jpeg,png,jpg,gif',
            'image.max' => 'filen kan ikke være større en 2mb',

        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image', 'public');


            $request->user()->posts()->create([
                'image' =>  $path,
                'heading' => $request->heading,
                'article' => $request->article
            ]);
        } else {
            $post->update([
                'image' =>  $request->image,
                'heading' => $request->heading,
                'article' => $request->article
            ]);
        }

        return redirect()->route('post.index')->with('success', 'Innlegget ble oppdatert!');
    }

    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->deleteOrFail();
        return redirect()->back()->with('success', 'Innlegget ble slettet');
    }
}
