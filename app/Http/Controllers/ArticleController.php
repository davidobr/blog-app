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

        $user = Auth::user();
        
        //To determine if a user is logged in before assigning $user
        //This will avoid an error of id being null
        if($user != ""){
            $user = Auth::user()->id;
        }
        
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
        
        
        /*$article = DB::table('articles')
                                        ->join('users', 'id')
                                        ->leftJoin('article_id','article_title','article_description','created_by', 'users.id')
                                        ->select('*')
                                        ->get();
        */

        /**
         * Selecting all the article information and user information for the selected article
         */
        $article = DB::select('select * from users 
                               left join articles on articles.created_by = users.id WHERE articles.id = ' . $id . ''); 
        //Selecting * from users and left joining seems to get the article ID whereas selecting * from articles doesn't. Can do with improving my left joins

        $userInfo = DB::select('select created_by from articles where id = ' . $id . '');
        
        $userId = $userInfo[0]->created_by;

        /**
         * Trying to confirm the author of the article is passed back to show edit and delete buttons
         */

        $author = false;
        if($user === $userId){
            $author = true;
        }else{
            $author = false;
        }

        return view('view', [
            'article' => $article,
            'author' => $author,
            'id' => $id,
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

    public function edit_article(Request $request)
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

        
        /*$article = DB::table('articles')
                                        ->join('users', 'id')
                                        ->leftJoin('article_id','article_title','article_description','created_by', 'users.id')
                                        ->select('*')
                                        ->get();
        */

        /**
         * Selecting all the article information and user information for the selected article
         */
        $query = DB::select('select * from articles 
                               left join users on articles.created_by = users.id WHERE articles.id = ' . $id . '');
        return view('/edit', [
            'article' => $query
        ]);
    }

    public function delete_article(Request $request)
    {
        $special = $request[2];
        /*DB::table('articles')->where('id', $id)->delete(); //return view('/dashboard');
        print('article deleted ' . $id);*/
    }
}
