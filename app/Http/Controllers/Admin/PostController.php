<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view-posts');

        $query = Post::with(['category', 'user']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create-posts');

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create-posts');

        $data = $this->preparePostData($request);
        $post = Post::create($data);

        $post->tags()->sync($this->syncTags($request->input('tags', [])));

        return redirect()->route('dashboard.posts.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        $this->authorize('edit-posts');

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('edit-posts');

        $data = $this->preparePostData($request, $post);
        $post->update($data);

        $post->tags()->sync($this->syncTags($request->input('tags', [])));

        return redirect()->route('dashboard.posts.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete-posts');

        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('dashboard.posts.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Menyiapkan data postingan dari request.
     */
    protected function preparePostData(Request $request, Post $post = null): array
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if (!$post) {
            $data['user_id'] = auth()->id();
        }

        if ($request->status === 'published' && (!$post || is_null($post->published_at))) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            if ($post && $post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        return $data;
    }

    /**
     * Sinkronisasi tag yang valid.
     */
    protected function syncTags(array $tags): array
    {
        return Tag::whereIn('id', $tags)->pluck('id')->toArray();
    }
}
