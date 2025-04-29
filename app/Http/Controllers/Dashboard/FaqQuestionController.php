<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\FaqQuestionService;

class FaqQuestionController extends Controller
{
    protected $faqQuestionService;
    public function __construct(FaqQuestionService $faqQuestionService)
    {
        $this->faqQuestionService = $faqQuestionService;
    }


    public function index()
    {
        // return $this->faqQuestionService->getFaqQuestions();
        return view('dashboard.faq_question.index');
    }

    public function getAll(){
        return $this->faqQuestionService->getForDatatables();
    }

    public function destroy($id){
     $question = $this->faqQuestionService->deleteFaqQuestion($id);
     if($question){
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        
        ],200);
     }else{
        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg')
        
        ],500);
     }
    
    }
}
