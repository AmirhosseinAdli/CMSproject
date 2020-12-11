<?php
namespace Services;

interface PostService
{
    public function all($page, $limit = 5);

    public function show($id);
}
