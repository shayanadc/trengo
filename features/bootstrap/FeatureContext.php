<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    use Illuminate\Foundation\Testing\DatabaseMigrations;
    private string $route;
    private array $response;
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
        throw new PendingException();
    }

    /**
     * @Given I send the :arg1 request to path :arg2
     */
    public function iSendTheRequestToPath($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then The response status code is :arg1
     */
    public function theResponseStatusCodeIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the json:
     */
    public function iShouldSeeTheJson(PyStringNode $string)
    {
        throw new PendingException();
    }
}
