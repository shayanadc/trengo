Feature: Store Articles
    @storeArticleRate
    Scenario: Store Rate For Specific New Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..." with rate "4"
        When The request body is:
        """
        {
           "rate" : 5
        }
        """
        And I send the "post" request to path "/api/articles/1/review"
        Then The response status code is "201"
        And I should see the json:
        """
        {
            "rate" : {
               "article_id" : 1,
               "rate": 5,
               "id": 1,
               "ip": "127.0.0.1"
            }
        }
        """

    @notStoreArticleRate
    Scenario: Store Rate For Specific New Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..." with rate "4"
        When The request body is:
        """
        {
           "rate" : "6"
        }
        """
        And I send the "post" request to path "/api/articles/1/review"
        Then The response status code is "422"

    @duplicateStoreArticleRate
    Scenario: Store Rate For Specific New Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..." with rate "4"
        And this ip "127.0.0.1" reviewed the article "1"
        And mock remember cache "articles_reviewed_" for ip "127.0.0.1"
        When The request body is:
        """
        {
           "rate" : 5
        }
        """
        And I send the "post" request to path "/api/articles/1/review"
        Then The response status code is "422"

    @ArticleNotFound
    Scenario: Store Rate For Specific New Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..." with rate "4"
        When The request body is:
        """
        {
           "rate" : 5
        }
        """
        And I send the "post" request to path "/api/articles/150/review"
        Then The response status code is "404"
