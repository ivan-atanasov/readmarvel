<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ContactFormRequest;
use App\Repositories\SeriesRepository;
use Config;
use View;
use Mail;
use Redirect;
use Session;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends BaseController
{
    /** @var SeriesRepository */
    private $seriesRepository;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->seriesRepository = new SeriesRepository($this->client);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comics = $this->seriesRepository->random(Config::get('homepage.random_comics_limit'));

        return View::make('frontend.index', ['comics' => $comics]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function contact()
    {
        return View::make('frontend.contact');
    }

    /**
     * @param ContactFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendContactFormMail(ContactFormRequest $request) 
    {
        $data = [
            'user'    => \Auth::check() ? \Auth::user()->nickname : '',
            'email'   => $request->get('email'),
            'name'    => $request->get('name'),
            'content' => $request->get('content'),
            'subject' => $request->get('subject'),
        ];

        Mail::send('emails.contact_form', $data, function ($m) use ($data) {
            $m->from('readmarvel@readmarvel.com', 'Read Marvel.com');
            $m->to(Config::get('mail.contact_form_to_email'), $data['name'])->subject($data['subject']);
        });

        Session::put('messages', ['success' => 'Message sent']);
        return Redirect::back();
    }
}
