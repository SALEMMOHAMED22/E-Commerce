<?php

namespace App\Services\Dashboard;

use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\FaqQuestionRepository;

class FaqQuestionService
{
    protected $faqQuestionRepository;
    public function __construct(FaqQuestionRepository $faqQuestionRepository)
    {
        $this->faqQuestionRepository = $faqQuestionRepository;
    }

    public function getFaqQuestions(){
        return $this->faqQuestionRepository->getFaqQuestions();
    }

    public function getForDatatables(){
        $faqQuestions = $this->getFaqQuestions();
        return DataTables::of($faqQuestions)
        ->addIndexColumn()
        ->addColumn('action' , function($item){
            return view('dashboard.faq_question.datatables.action' , compact('item'));
        })
        ->addColumn('message' , function($item){
            return view('dashboard.faq_question.datatables.content' , compact('item'));
        })
        ->rawColumns(['message' , 'action'])
        ->make(true);
        
    }


    public function deleteFaqQuestion($id){
       $question = $this->faqQuestionRepository->getFaqQuestionById($id);
       if($question){
        return $this->faqQuestionRepository->deleteFaqQuestion($question);
       }
       return false;
    }
}
