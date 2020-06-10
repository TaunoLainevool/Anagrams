<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anagram;
use App\Http\Resources\Anagram as AR;
use Illuminate\Support\Facades\Route;
use DB;

class AnagramController extends Controller
{
    public $timestamps = true;

    public function index()
    {
        $anagram = Anagram::paginate(1000);

        return AR::collection($anagram);
    }

    public function show(string $anagram)
    {
        $anagrams = $this->find_Anagrams($anagram);

        return AR::collection($anagrams);
    }


    public function fetch()
    {
        echo 'Fetching wordbase from EKI...';

        $url ='http://www.eki.ee/tarkvara/wordlist/lemmad2013.txt';
        $data = file_get_contents($url);
        $wordArray = explode("\n", $data);

        foreach($wordArray as $word)
        {
         $tmp[]=['anagram' =>$word];
        }

        $chunks = array_chunk($tmp, 1000);

        $db = Anagram::first();
        if(!$db)
        {
            echo 'Updating database...';
            foreach($chunks as $chunk)
            {
              Anagram::insert($chunk);
            }
        }
    }

    public function find_Anagrams(string $anagram)
    {
        $str = strlen($anagram);
        $dbwords = Anagram::select('anagram','id')->whereRaw('LENGTH(anagram) = ?', $str)->get();

        $foundAnagrams = [];

        foreach($dbwords as $word){
            if(count_chars($anagram, 1) == count_chars($word['anagram'], 1)){
                $foundAnagrams[]=$word;
            }
        }
        return $foundAnagrams;
    }
}
