<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpusobjects\Corpus;

class CorpusController extends Controller
{
    /**  
     *
     * Lists all available corpora
     *
     */
    public function index(){

        $x = new Corpus();
    
        return ['response' => 
            [
                'title' => 'just a test'
            ]
        ];
    }
}
