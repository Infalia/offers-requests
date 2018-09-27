<?php

namespace App\Mail;

use App\User;
use App\Initiative;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUser extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The initiative instance.
     *
     * @var Initiative
     */
    public $initiative;

    /**
     * The message.
     *
     * @var string
     */
    public $slot;

    /**
     * The reply URL.
     *
     * @var string
     */
    public $replyUrl;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Initiative $initiative, $messageText, $replyUrl)
    {
        $this->initiative = $initiative;
        $this->slot = $messageText;
        $this->replyUrl = $replyUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = null;

        if(Auth::check()) {
            $user = User::find(Auth::id());
        }

        $panelText = __('messages.initiative_contact_mail_panel', [
                'type' => $this->initiative->initiativeType->name,
                'title' => $this->initiative->title,
                'url' => url('offer/'.$this->initiative->id.'/'.str_slug($this->initiative->title))
            ]
        );
        $replyBtn = __('messages.initiative_contact_mail_reply_btn');
        $subject = __('messages.initiative_contact_mail_subject', [
                'initiative' => mb_convert_case($this->initiative->initiativeType->name, MB_CASE_LOWER, "UTF-8")
            ]);

        return $this->subject($subject)
                    ->markdown('vendor.mail.html.message')
                    ->with([
                        'user' => $user,
                        'replyBtn' => $replyBtn,
                        'panelText' => $panelText,
                    ]);
    }
}
