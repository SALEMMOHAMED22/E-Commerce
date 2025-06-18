<?php

namespace App\Livewire\Website;

use App\Models\Admin;
use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ContactNotification;
use Illuminate\Support\Facades\Notification;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public string $phone = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],

        ];
    }

    public function updated($field): void
    {
        $this->validateOnly($field);
    }

    public function submitContactForm()
    {
        // dd([
        //     'user' => auth()->user(),
        //     'id' => auth()->id()
        // ]);
     
        $this->validate();

        $contact = Contact::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'phone' => $this->phone,
        ]);

        // send contact notification to admins 
        $admins = Admin::all();
        Notification::send($admins, new ContactNotification($contact));


        if (!$contact) {
            $this->dispatch('contact-form-submitted', __('website.try_again_later'));
        }

        $this->reset('name', 'email', 'subject', 'message', 'phone');
        $this->dispatch('contact-form-submitted', __('website.contact_sent_successfully'));
    }

    public function render()
    {
        return view('livewire.website.contact-form');
    }
}
