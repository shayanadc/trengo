Feature: Show Article by Id
    @RegisterUser
    Scenario: Show Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..."
        And there is a article with title "How to enjoy!" and body "Lorem ipsum..."
        And I send the "get" request to path "/api/articles/2"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "article" : {
               "title" : "How to have a fun!",
               "body": "Lorem ipsum...",
               "id": 1
            }
        }
        """
