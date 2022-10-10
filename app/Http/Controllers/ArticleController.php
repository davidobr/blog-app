<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //For database querying i.e. "DB::select(xyz) or DB::table('table')
use Illuminate\Support\Facades\Auth; //For authentication i.e. "Auth::user ... etc"
use Illuminate\Database\Query\Builder;

class ArticleController extends Controller
{

    public function articles_on_homepage()
    {
        $articles = DB::select('select * from articles order by id DESC');
        return view('index', ['articles' => $articles]);
    }

    public function user_articles_on_dashboard()
    {
        $users = Auth::user()->id;
        $articles = DB::select('select * from articles where created_by = ' . $users);
        return view('dashboard', ['articles' => $articles]);
    }

    public function view_article(Request $request)
    {
        /**
         * NOTE: $id = $request->article_id; for some reason I thought was working but seems to not be now. Unsure as to why. It turns out request isn't
         * really getting any data apart from the id and I am getting a null from the included code so I have had to extract the key which is the ID
         * and the only thing being returned
         */
        $id;
        foreach($request->input() as $key => $value)
        {
            $id = $key;
        }
        //$id = $request->collect();
        
        /*$article = DB::table('articles')
                                        ->join('users', 'id')
                                        ->leftJoin('article_id','article_title','article_description','created_by', 'users.id')
                                        ->select('*')
                                        ->get();
        */

        /**
         * Selecting all the article information and user information for the selected article
         */
        $article = DB::select('select * from articles 
                               left join users on articles.created_by = users.id WHERE articles.id = ' . $id . '');
        return view('view', [
            'article' => $article,
        ]);
    }

    public function create_article(Request $request)
    {
        $users = Auth::user()->id;

        $request->validate([
            'article_title' => ['required', 'string', 'max:80'],
            'article_description' => ['required', 'string', 'max:255'],
        ]);

        $insert = DB::table('articles')->insertGetId(['article_title' => $request->article_title, 'article_description' => $request->article_description,
                                                'created_by' => $users, 'created_on' => \Carbon\Carbon::now()->toDateTimeString()]);
        $article = DB::select('select * from articles left join users on articles.created_by = users.id where articles.id = ' . $insert);

        return view('view', [
            'article' => $article,
        ]);
    }
}
