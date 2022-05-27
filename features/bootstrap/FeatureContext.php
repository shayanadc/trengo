<?php

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
     * @Given there is a article with title :arg1 and body :arg2
     */
    public function thereIsAArticleWithTitleAndBody($arg1, $arg2)
    {
        Article::factory()->create(['title' => $arg1, 'body' => $arg2]);
    }

    /**
     * @Given I send the :arg1 request to path :arg2
     */
    public function iSendTheRequestToPath($arg1, $arg2)
    {
        $this->response = match ($arg1) {
            'get' => $this->getJson($arg2),
            'post' => $this->postJson($arg2, $this->body),
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
}
