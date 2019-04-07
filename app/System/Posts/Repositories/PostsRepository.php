<?php


namespace System\Posts\Repositories;


use Illuminate\Database\QueryException;
use System\Posts\Interfaces\PostsRepositoryInterface;
use System\Posts\Models\Posts;

class PostsRepository implements PostsRepositoryInterface
{
    /**
     * @param \stdClass $data
     * @return bool
     */
    public function create(\stdClass $data)
    {
        $post = new Posts();

        foreach ($data as $p => $v)
            $post->{$p} = $v;

        try{
            return $post->save();
        }catch (QueryException $e) {
            // TODO:: enable logging: Query
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        if ($post = Posts::find($id))
            return $post->delete();

        // TODO:: enable logging: not found
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function restore($id)
    {
        if ($post = Posts::withTrashed()->find($id))
            return $post->restore();

        // TODO:: enable logging: not found
        return false;
    }

    /**
     * @param $id
     * @param \stdClass $data
     * @return bool
     */
    public function update($id,\stdClass $data)
    {
        if (!$post = Posts::find($id))
            return false;

        foreach ($data as $p => $v)
            $post->{$p} = $v;

        try{
            return $post->save();
        }catch (QueryException $e) {
            // TODO:: enable logging: Query
            return false;
        }
    }

    private function initQuery($select = ['posts.*'])
    {
        return Posts::query()->select($select); // TODO:: Modifications for the Query
    }


    /**
     * @param $filter
     * @param array $select
     * @param bool $paginate
     * @param null $sort_by
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($filter, $select = ['posts.*'], $paginate = false,$sort_by = null)
    {
        $posts = $this->initQuery($select);

        if (isset($filter['column_example']))
            $posts = $posts->where('posts.column_example','=',$filter['column_example']);

        if (isset($sort_by['column']))
            $posts = $posts->orderBy($sort_by['column'],isset($sort_by['dir'])? $sort_by['dir'] : 'asc');

        if ($paginate)
            return $posts->paginate(20);
        else
            return $posts->get();
    }

    public function getPost($id)
    {
        return $this->initQuery() ->where('id', '=',$id)->first();
    }

}
