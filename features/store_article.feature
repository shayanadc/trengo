Feature: Store Articles
    @storeArticle
    Scenario: Store New Article
        When The request body is:
        """
        {
           "title" : "How to enjoy!",
           "body": "Lorem ipsum..."
        }
        """
        And I send the "post" request to path "/api/articles"
        Then The response status code is "201"
        And I should see the json:
        """
        {
            "article" : {
               "title" : "How to enjoy!",
               "body": "Lorem ipsum...",
               "id": 1
            }
        }
        """
