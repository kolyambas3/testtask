<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (Auth::user()->can('manage', User::class)) {
            $posts = Post::query()
                ->whereHas('user', function (Builder $builder) {
                    $builder->where('manager_id', Auth::user()->id);
                })
                ->paginate(15);
        }

        if (Auth::user()->cannot('manage', User::class)) $posts = Post::where('user_id',Auth::user()->id)->paginate(10);
        return view('posts', compact("posts"));
    }

    /**
     * Display a listing of category posts.
     *
     */
    public function category($id)
    {
        $posts = new Collection();
        if (Auth::user()->can('manage', User::class)) {
            $posts = Post::query()
                ->whereHas('user', function (Builder $builder) {
                    $builder->where('manager_id', Auth::user()->id);
                })
                ->where('category_id', $id)
                ->paginate(15);
        }

        if (Auth::user()->cannot('manage', User::class)) $posts = Post::where('user_id', Auth::user()->id)
            ->where('category_id', $id)
            ->paginate(10);

        return view('posts', compact('posts'));
    }

    /**
     * Display a listing of user posts.
     *
     */
    public function userPosts($id)
    {
        if (Auth::user()->can('manage', User::class)) {
            $posts = Post::where('user_id', $id)->paginate(10);
            return view('posts', compact('posts'));
        }

        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post_create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:posts',
            'file' => 'required|image'
        ]);
        if ($request->file) {
            $request->file('file')->move(public_path('images'), $request->file->getClientOriginalName());
            $request->merge(['image' => $request->file->getClientOriginalName()]);
        };

        if (Auth::user()->can('employee', User::class)) {
            $request->merge(['user_id' => Auth::user()->id]);
            Post::create($request->all());
            return redirect()->route('post.index');
        }

        return abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('post_create', [
            'categories' => Category::all(),
            'post' => Post::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|image'
        ]);
        if ($request->file) {
            $request->file('file')->move(public_path('images'), $request->file->getClientOriginalName());
            $request->merge([
                'image' => $request->file->getClientOriginalName()
            ]);
        };
        $post = Post::findOrFail($id);
        if (Auth::user()->can('employee', User::class)) {
            $post->update($request->all());
            return redirect()->route('post.index');
        }
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::user()->can('delete', User::class)) {
            $post->delete();
            return redirect()->route('post.index');
        }
        return abort(403);
    }
}
