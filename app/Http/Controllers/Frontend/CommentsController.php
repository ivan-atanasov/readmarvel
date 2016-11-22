<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;

/**
 * Class CommentsController
 * @package App\Http\Controllers\Frontend
 */
class CommentsController extends BaseController
{
    /**
     * @var CommentRepository
     */
    public $commentRepository;

    /**
     * CommentsController constructor.
     *
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param CommentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request)
    {
        $this->commentRepository->add(
            [
                'user_id'   => \Auth::user()->id,
                'series_id' => $request->get('series_id'),
                'comment'   => $request->get('comment'),
            ]
        );

        return \Redirect::back();
    }
}
