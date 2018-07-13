<?php

namespace App\Plugins\Newsletter\Controllers;

use Mail;
use Session;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Classes\FileGenerator\FileGenerator;
use Illuminate\Support\Facades\Artisan;

Use App\Plugins\Newsletter\Models\Newsletter;
use App\Plugins\Newsletter\Mail\NewsletterMail;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();
        return response()->json($newsletters, 200);
    }

    public function store(Request $request)
    {
        $newsletter = Newsletter::create($request->all());
        $recipients = $request->get('recipients');
        $this->send($newsletter, $recipients);
        return response()->json($newsletter, 200);
    }

    public function send(Newsletter $newsletter, $recipients) 
    {
        foreach($recipients as $recipient)
        {
            Mail::to($recipient['email'])->send(new NewsletterMail($newsletter, $recipient));
        }
    }
}
