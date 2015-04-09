<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ConfirmNoticeRequest;
use App\Http\Requests\PrepareNoticeRequest;
use App\Notice;
use App\Provider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NoticesController extends Controller {

    /**
     * Create a new notices controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    /**
     * Display a listing of the notices.
     *
     * @return Response
     */
    public function index()
    {
        $notices = $this->user->notices;

        return view('notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new notice.
     *
     * @return Response
     */
    public function create()
    {
        $providers = Provider::lists('name', 'id');

        return view('notices.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $notice = $this->createNotice($request);

        Mail::queue(['text' => 'emails.dmca'], compact('notice'), function($message) use ($notice)
        {
            $message->from($notice->getOwnerEmail())
                ->to($notice->getRecipientEmail())
                ->subject('DMCA Notice');
        });

        flash()->success('DMCA notice successfully sent');
        return redirect('notices');
    }

    public function update($noticeId, Request $request)
    {
        $isRemoved = $request->has('content_removed');

        Notice::findOrFail($noticeId)
            ->update(['content_removed' => $isRemoved]);
    }

    /**
     *  For the user to check if everything is in place.
     *
     * @param PrepareNoticeRequest $request
     * @return \Illuminate\View\View
     */
    public function confirm(PrepareNoticeRequest $request)
    {
        $template = $this->CompileDMCATemplate($data = $request->all());

        session()->flash('dmca', $data);

        return view('notices.confirm', compact('template'));
    }

    /**
     * Takes the template and inserts the specific data.
     *
     * @param $data
     * @return mixed
     */
    private function CompileDMCATemplate($data)
    {
        $data = $data + [
                'name'  => $this->user->name,
                'email' => $this->user->email,
            ];

        return  view()->file(app_path('Http/Templates/dmca.blade.php'), $data);
    }

    /**
     * Create and store a new DMCA notice.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function createNotice(Request $request)
    {
        $notice = session()->get('dmca') + ['template' => $request->input('template')];

        $notice =  $this->user->notices()->create($notice);

        return $notice;
    }

}
