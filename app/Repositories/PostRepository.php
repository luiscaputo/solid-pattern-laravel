<?php

namespace App\Repositories;

use App\Interfaces\IPostRepository;
use App\Models\Post;

class PostRepository implements IPostRepository
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create($request)
    {
        return $this->post::create($request);
    }

    public function updatePostById($request, int $id)
    {
        $postExists = $this->findPostById($id);

        if (!$postExists) return false;

        return $this->post::where('id', $id)->update($request);
    }

    public function findPostById($id)
    {
        $postExists = $this->post::find($id);

        return $postExists;
    }

    public function deletePostById($id)
    {
        $postExists = $this->findPostById($id);

        if (!$postExists) return false;

        return $this->post::destroy($id);
    }

    public function findAllPosts()
    {
        return $this->post::all();
    }
}
