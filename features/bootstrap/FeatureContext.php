<?php

use Behat\Behat\Tester\Exception\PendingException;
use App\Models\Review;
use App\Models\Category;
use App\Models\View;

use App\Models\Article;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Tests\TestCase;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends TestCase implements Context
{
    use Illuminate\Foundation\Testing\DatabaseMigrations;

    private string $route;
    private Illuminate\Testing\TestResponse $response;
    private array $request = [];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        putenv("APP_ENV=testing");
        putenv("DB_CONNECTION=sqlite_testing");
        putenv("DB_DATABASE=:memory:");
        parent::setUp();
    }


    /**
     * @Given there is a article with title :arg1 and body :arg2 with rate :arg3
     */
    public function thereIsAArticleWithTitleAndBodyWithRate($arg1, $arg2, $arg3)
    {
        Article::factory()->create(['title' => $arg1, 'body' => $arg2, 'rate' => $arg3]);
    }

    /**
     * @Given I send the :arg1 request to path :arg2
     */
    public function iSendTheRequestToPath($arg1, $arg2)
    {
        $this->response = match ($arg1) {
            'get' => $this->getJson($arg2),
            'post' => $this->postJson($arg2, $this->request),
        };
    }

    /**
     * @Then The response status code is :arg1
     */
    public function theResponseStatusCodeIs($arg1)
    {
        $this->response->assertStatus(intval($arg1));
    }

    /**
     * @Then I should see the json:
     */
    public function iShouldSeeTheJson(PyStringNode $string)
    {
        $this->assertJsonStringEqualsJsonString($string->getRaw(), $this->response->getContent());
    }

    /**
     * @When The request body is:
     */
    public function theRequestBodyIs(PyStringNode $string)
    {
        $this->request = json_decode($string->getRaw(), true);
    }

    /**
     * @Given There is a Category with name :arg1
     */
    public function thereIsACategoryWithName($arg1)
    {
        Category::factory()->create(['name' => $arg1]);
    }

    /**
     * @Then The article id :arg1 has :arg2 categories
     */
    public function theArticleIdHasCategories($arg1, $arg2)
    {
        $articleCategories = Article::find($arg1)->categories;
        $this->assertCount($arg2, $articleCategories);
    }

    /**
     * @Given today is :arg1
     */
    public function todayIs($arg1)
    {
        \Carbon\Carbon::setTestNow($arg1);
    }


    /**
     * @Given The article id :arg1 attach :arg2 categories
     */
    public function theArticleIdAttachCategories($arg1, $arg2)
    {
        \Illuminate\Support\Facades\DB::table('article_category')->insert([
            'article_id' => $arg1,
            'category_id' => $arg2
        ]);
    }

    /**
     * @Given there is a :arg1 view for article :arg2
     */
    public function thereIsAViewForArticle($arg1, $arg2)
    {
        View::factory()->create(['article_id' => $arg2, 'count' => $arg1]);
    }

    /**
     * @Given this ip :arg1 reviewed the article :arg2
     */
    public function thisIpReviewedTheArticle($arg1, $arg2)
    {
        \App\Models\Review::factory()->create(['ip' => $arg1, 'article_id' => $arg2]);
    }


    /**
     * @Given mock remember cache :arg1 for ip :arg2
     */
    public function mockRememberCacheForIp($arg1, $arg2)
    {
        \Illuminate\Support\Facades\Cache::shouldReceive('remember')
            ->once()
            ->with($arg1 . $arg2, 3600, \Closure::class)
            ->andReturn(
                Review::ip($arg2)->get('article_id')->pluck('article_id')->toArray()

            );
    }
}
