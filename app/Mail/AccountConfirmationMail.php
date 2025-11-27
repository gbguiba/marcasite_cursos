<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AccountConfirmationMail extends Mailable {
    
    use Queueable, SerializesModels;

    private User $user;
    private string $password;
    
    public function __construct(User $user, string $password) {
        
        $this->user = $user;
        $this->password = $password;

    }
    
    public function envelope(): Envelope {
        
        return new Envelope(
            subject: sprintf('%s, aqui está a confirmação de sua conta.', $this->user->profile->name),
        );
    
    }
    
    public function content(): Content {
        
        return new Content(
            view: 'mail.account_confirmation',
            with: [
                'name' => $this->user->profile->name,
                'email' => $this->user->email,
                'type' => $this->user->type,
                'password' => $this->password,
            ],
        );
    
    }

}
