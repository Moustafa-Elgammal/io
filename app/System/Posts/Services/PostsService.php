<?php


namespace System\Posts\Services;


use App\System\Posts\Validators\PostsValidators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use System\Posts\Interfaces\PostsRepositoryInterface;

class PostsService
{
    private $Repo;
    private $validator;
    private $errors;

    public function __construct(PostsRepositoryInterface $Repo, PostsValidators $validator)
    {
        $this->Repo = $Repo;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function  CreateNewPost(Request $request)
    {
        if ($this->validator->createValidation($request))
        {
            $date = new \stdClass();
            $date->title = $request->title;
            $date->content = $request->get('content');
            $date->user_id = Auth::check()? Auth::user()->id : 1;

            if($this->Repo->create($date))
                return true;

            $this->errors = ['// can not be added'];
            return false;
        }

        $this->errors = $this->validator->getErrors();
        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function  updatePost(Request $request)
    {
        if ($this->validator->updateValidation($request))
        {
            $date = new \stdClass();
            $date->title = $request->title;
            $date->content = $request->get('content');
            $date->user_id = Auth::check()? Auth::user()->id : 1;

            if($this->Repo->update($request->id ,$date))
                return true;

            $this->errors = ['// can not be updated'];
            return false;
        }

        $this->errors = $this->validator->getErrors();
        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->Repo->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        return $this->Repo->restore($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getPosts(Request $request)
    {
        return $this->Repo->get($request->filters, ['posts.*'],true, ['column'=>'id','dir'=>'desc']);
    }

    public function getById($id){
        return $this->Repo->getPost($id);

    }

    public function getErrors()
    {
        return $this->errors;
    }

}
