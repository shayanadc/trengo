Feature: Store Articles
    @storeArticleRate
    Scenario: Store Rate For Specific New Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..."
        When The request body is:
        """
        {
           "rate" : 5,
           "article_id" : 1
        }
        """
        And I send the "post" request to path "/api/rates"
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
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..."
        When The request body is:
        """
        {
           "rate" : "6",
           "article_id" : 1
        }
        """
        And I send the "post" request to path "/api/rates"
        Then The response status code is "422"

    @duplicateStoreArticleRate
    Scenario: Store Rate For Specific New Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..."
        When The request body is:
        """
        {
           "rate" : 5,
           "article_id" : 1
        }
        """
        And I send the "post" request to path "/api/rates"
        And I send the "post" request to path "/api/rates"
        Then The response status code is "422"

    @ArticleNotFound
    Scenario: Store Rate For Specific New Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..."
        When The request body is:
        """
        {
           "rate" : 5,
           "article_id" : 170
        }
        """
        And I send the "post" request to path "/api/rates"
        Then The response status code is "404"
