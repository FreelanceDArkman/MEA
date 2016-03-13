<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class SearchController extends Controller
{


    public function getIndex(Request $request)
    {
        $this->pageSetting( [
            'title' => 'ค้นหา | MEA FUND'
        ] );

        $keyword = $request->input('sKeys');

        $arrKey = explode(' ',$keyword);




//        $records = [];
        //$records["data"] = [];
        $records =array();

        $filters = [];

        //var_dump($arrKey);

        foreach ($arrKey as $key){

            if($key != ""){

//                $sql = "SELECT * FROM TBL_NEWS_TOPIC WHERE NEWS_TOPIC_DETAIL LIKE '%".trim($key)."%' OR FILE_NAME LIKE '%".trim($key)."%' OR NEWS_TOPIC_KEYWORD LIKE  '%".trim($key)."%'";
//                 = DB::select(DB::raw($sql))->paginate(20);
                $NewTopic = DB::table('TBL_NEWS_TOPIC')->where('NEWS_TOPIC_DETAIL', 'LIKE', '%'.trim($key).'%')
                    ->orWhere('FILE_NAME', 'LIKE','%'.trim($key).'%')
                    ->orWhere('NEWS_TOPIC_KEYWORD','LIKE', '%'.trim($key).'%')->get();


                if($NewTopic){
                    foreach($NewTopic as $index => $news){
                        $records[$index] = array(
                            "cate_id" => $news->NEWS_CATE_ID,
                            "topic_id" => $news->NEWS_TOPIC_ID,
                            "searchkey" => "1",
                            "title" => $news->FILE_NAME,
                            "detail" => $news->NEWS_TOPIC_DETAIL,
                            "thumb" => $news->THUMBNAIL
                        );
                    }
                }


//                $sql2 = "SELECT * FROM TBL_FAQ_TOPIC WHERE FAQ_QUESTION_KEYWORD LIKE '%".trim($key)."%' OR FAQ_ANSWER_KEYWORD LIKE '%".trim($key)."%'";
//                $QA = DB::select(DB::raw($sql2))->paginate(20);


                $QA = DB::table('TBL_FAQ_TOPIC')->where('FAQ_QUESTION_KEYWORD', 'LIKE', '%'.trim($key).'%')
                    ->orWhere('FAQ_ANSWER_KEYWORD', 'LIKE','%'.trim($key).'%')->get();

                if($QA){
                    foreach($QA as $index => $q){
                        $records[$index] = array(
                            "searchkey" => "0",
                            "faq_cat_id" => $q->FAQ_CATE_ID,
                            "faq_q_id"=>$q->FAQ_QUESTION_ID,
                            "title" => $q->FAQ_QUESTION_DETAIL,
                            "detail" => $q->FAQ_ANSWER_DETAIL
                        );
                    }

                }


            }




        }


//        $page = Input::get('page', 2); // Get the current page or default to 1, this is what you miss!
//        $perPage = 20;
//        $offset = ($page * $perPage) - $perPage;

//        $records = LengthAwarePaginator(array_slice($records, $offset, $perPage, true), count($records), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]);
        //var_dump(count($records));
        $recordss = $this->paginate($records,20,1);

        $allrecord = count($records);

        var_dump(count($recordss));
        return view('frontend.pages.search')->with(['keyword' => $keyword, 'recordss'=>$recordss, 'allrecord'=>$allrecord]);

    }

    public function paginate($items,$perPage,$page)
    {
        $pageStart = \Request::get('page', $page);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }




}
