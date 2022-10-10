<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase; Causes authentication tests to fail for some reason. Need to use "use Tests\TestCase"
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\TEsting\DatabaseTransactions;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\User;
use UserTableSeeder;
use ArticleTableSeeder;
use App\Providers\RouteServiceProvider;



class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Creating seeder for laravel
     */
    //protected $seed = true;


    /*public function test_databases_can_be_generated()
    {
        //$this->seed();
        $this->seed([
            UserTableSeeder::class,
            ArticleTableSeeder::class,
        ]);
        $this->assertDatabaseCount('users', 10);

        //Will come back to the unit test
        //$this->assertTrue(true);

    }*/

    /**
     * TODO this test before or after I create the create blogs page?
     */

    public function test_user_can_create_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->make()->toArray();
        $response = $this->actingAs($user)->post('/create', $article);
        $this->assertDatabaseHas(
            'articles',
            [
                'article_title' => $article['article_title'],
                'article_description' => $article['article_description'],
            ]
            );
    }

    public function test_non_authenticated_user_cannot_reach_create_page()
    {
        $response = $this->get('/create');
        $response->assertRedirect('/login');
    }

    /*public function test_article_can_be_viewed()
    {
        $user = User::factory()->create();
        $article = Article::factory()->make()->toArray();
        $response = $this->actingAs($user)->post('/create', $article);
        $article_id = $this->response->article.id;
        $page = $this->get('view/$article_id');
    }*/

    /*public function test_article_creator_can_edit_article()
    {

    }*/

    /*public function test_non_authenticated_user_cannot_edit_article()
    {

    }*/

    /*public function test_random_user_cannot_edit_article_not_owned_by_user()
    {

    }*/
    
}
