<?php

namespace App\Listeners;

use App\Events\NewsPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\NewsLetter;
use App\Models\Subscriber;

class SendNewsLetter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewsPublished  $event
     * @return void
     */
    public function handle(NewsPublished $event)
    {
        $aa = Subscriber::get(['email']);
        $subcribe_mails = array();
        foreach($aa as $a)
        {

           array_push($subcribe_mails, $a->email);
           // $single_email = $a->email ;
        }
        //Mail::to($single_email)
        //->send(new NewsLetter($event->news));
        Mail::bcc($subcribe_mails)
                ->send(new NewsLetter($event->news));
               
    }
}
