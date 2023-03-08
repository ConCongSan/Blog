<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use App\Repositories\IMailRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel;

class EmailController extends Controller
{
    protected $mailRepository;

    public function __construct(IMailRepository $mailRepository)
    {
        $this->mailRepository = $mailRepository;
    }

    public function index()
    {
        return view('sendmail');
    }

    public function all()
    {
        $mail = $this->mailRepository->all();
        return view('index')->with('mail', $mail);
    }

    public function sendmail(Request $request)
    {
        $data = $request->all();
        $mail = $this->mailRepository->create($data);
        $message = [
            'mail' => $mail->mail,
            'content' => $mail->content,
        ];
        dispatch(new SendEmailJob($mail));
        Log::channel('LogMail')->info('Success :', ['data' => $mail]);
        return back();
    }
}
