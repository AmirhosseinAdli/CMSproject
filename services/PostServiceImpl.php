<?php

namespace Services;

use Illuminate\Support\Facades\DB;

class PostServiceImpl implements PostService
{
    public function all($page, $limit = 5)
    {
//        return $posts = DB::table('posts')
//            ->offset((($page-1)*$limit)+1)
//            ->limit($limit)
//            ->get();
        $posts=\App\Models\Post::skip(($page-1)*$limit)->take($limit)->get();
        return $posts;
    }
    public function show($id)
    {
        // TODO: Implement show() method.
    }
}
