<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FaqRepository;

class FaqService
{
    protected $faqRepository;
    public function __construct(FaqRepository $faqRepository)
    {
        return $this->faqRepository = $faqRepository;
    }
    
    
    public function getFaq($id){
        $faq =  $this->faqRepository->getFaq($id);
        return $faq?? abort(404);
    }
    public function getFaqs(){
        return $this->faqRepository->getFaqs();
    }
    public function storeFaq($data){
        return  $this->faqRepository->storeFaq($data);
    }
    public function updateFaq($id, $data){
        $faq = $this->getFaq($id);
        return $this->faqRepository->updateFaq($faq, $data);
    }
    public function deleteFaq($id){
        $faq = $this->getFaq($id);
        return $this->faqRepository->deleteFaq($faq);
    }
}
