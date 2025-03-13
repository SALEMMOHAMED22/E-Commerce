<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\dashboard\ContactService;

class ReplyContact extends Component
{

    public $contact;
    public $id , $email , $subject , $clientName , $replyMessage;

    protected ContactService $contactService;
    public function boot(ContactService $contactService){
        $this->contactService = $contactService;
    }
    #[On('call-reply-contact-component')]
    public function luanchModal($contactId)
    {
        $this->setDataInAttributes($contactId);
        $this->dispatch('luanch-reply-contact-modal');
    }
    public function setDataInAttributes($contactId){
        $this->contact = Contact::find($contactId);
        $this->id = $this->contact->id;
        $this->email = $this->contact->email;
        $this->subject = $this->contact->subject;
        $this->clientName = $this->contact->client_name;
    }

    public function replyContact(){
        $replyStatus = $this->contactService->replyContact($this->id , $this->replyMessage);
        if(!$replyStatus){
            return $this->dispatchBrowserEvent('alert' , ['type' => 'error' , 'message' => 'Something went wrong']);
        }
        $this->dispatch('close-modal');
        $this->dispatchBrowserEvent('alert' , ['type' => 'success' , 'message' => 'Reply Sent Successfully']);

    }
     public function render()
    {
        return view('livewire.dashboard.contact.reply-contact');
    }
}
