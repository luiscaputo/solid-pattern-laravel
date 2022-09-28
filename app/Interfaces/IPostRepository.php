<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IPostRepository {
    public function create(Request $request);
    public function updatePostById($request, int $id);
    public function findPostById(int $id);
    public function deletePostById(int $id);
    public function findAllPosts();
}