<?php

namespace App\Livewire\Website;

use App\Services\Website\FaqService;
use Livewire\Component;

class FaqQuestion extends Component
{

    public $name , $email , $subject , $message;
    protected FaqService $faqService;

    public function boot(FaqService $faqService){
        $this->faqService = $faqService;
    }

    public function rules(){
        return [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|min:2|max:100',
            'message' => 'required|min:2|max:5000',
        ];
    }

    public function updated(){
        $this->validate();
    }

    public function submit(){
        $this->validate();
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
       $faq =  $this->faqService->createFaqQuestion($data);
       if(!$faq){
        $this->dispatch('faq-question-failed' , __('website.something_went_wrong'));
       }
       $this->reset();
       $this->dispatch('faq-question-created' , __('website.faq_question_created'));



    }

    public function render()
    {
        return view('livewire.website.faq-question');
    }
}
