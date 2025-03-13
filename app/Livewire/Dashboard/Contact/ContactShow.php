<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\dashboard\ContactService;

class ContactShow extends Component
{


public $msg;
protected $listeners = [
    'refresh-show' => '$refresh',
    'contact-reply' => '$refresh',
];
protected ContactService $ContactService;
public function boot(contactService $ContactService){
    $this->ContactService = $ContactService;
  
}

public function mount(){
    $this->msg = $this->ContactService->latestContact();
}
    #[On('show-message')] 
    public function showMessage($msgId)
    {
        $this->msg = $this->ContactService->getContactById($msgId);
        $this->dispatch('refresh-message');
    }

    public function deleteMsg($msgId){
        
        Contact::where('id' , $msgId)->delete();
        $this->msg = $this->ContactService->latestContact();
        $this->dispatch('msg-deleted' , 'Message Deleted Successfully');
        $this->dispatch('refresh-show');

    }


    public function forceDelete($msgId){
        $this->ContactService->forceDeleteContact($msgId);
    $this->msg = $this->ContactService->latestContact();
        $this->dispatch('msg-deleted' , 'Message Deleted Successfully');
        $this->dispatch('refresh-show');

    }
    public function restoreContact($msgId){
        $this->ContactService->restoreContact($msgId);
        $this->dispatch('refresh-message');

    }

     public function replyMsg($msgId)
    {
        $this->dispatch('call-reply-contact-component', $msgId);
    }

    public function markAsUnRead($msgId){
        $this->ContactService->markUnread($msgId);
        $this->dispatch('refresh-message');
    }
    public function render()
    {
        return view('livewire.dashboard.contact.contact-show');
    }
}
