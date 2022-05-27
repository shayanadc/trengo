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

    @notStoreArticle
    Scenario: Could not Store New Article
        When The request body is:
        """
        {
           "body": "Lorem ipsum..."
        }
        """
        And I send the "post" request to path "/api/articles"
        Then The response status code is "422"
        And I should see the json:
        """
        {
            "errors" : {
              "code": 422,
              "detail": {
                  "title": [
                      "The title field is required."
                  ]
              },
              "message": "The title field is required.",
                "type": "ValidationException"
            }
        }
        """
