<?php


namespace System\Posts\Interfaces;


interface PostsRepositoryInterface
{
    public function create(\stdClass $data);

    public function delete($id);

    public function restore($id);

    public function update($id,\stdClass $data);

    public function get($filter, $select = ['posts.*'], $paginate = false,$sort_by = null);

    public function getPost($id);
}
