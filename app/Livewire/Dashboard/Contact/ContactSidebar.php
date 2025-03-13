<?php

namespace App\Livewire\Dashboard\Contact;

use Livewire\Component;
use App\Services\dashboard\ContactService;

class ContactSidebar extends Component
{
    public $screen = 'inbox';

    protected ContactService $contactService;
    public function boot(ContactService $contactService){
        $this->contactService = $contactService;
    }
    public function selectScreen($screen){

        $this->screen = $screen;
        $this->dispatch('select-screen' , $screen);
    }
      // delete All
      public function markAllAsRead()
      {
          $this->contactService->markAllAsRead();
          $this->dispatch('msg-deleted');
      }
      public function deleteAllReadContacts()
      {
          $this->contactService->deleteAllReadedContacts();
          $this->dispatch('msg-deleted');
  
      }
      public function deleteAllAnswereContacts()
      {
          $this->contactService->deleteAllAnsweredContacts();
          $this->dispatch('msg-deleted');
  
      }
    public function render()
    {
        return view('livewire.dashboard.contact.contact-sidebar' , [
            'inboxCount' => $this->contactService->getInboxContacts()->count(),
            'answeredCount' => $this->contactService->getAnsweredContacts()->count(),
            'trashedCount' => $this->contactService->getTrashedContacts()->count(),
            'readedCount' => $this->contactService->getMarkReadContacts()->count(),
        ]);
    }
}
