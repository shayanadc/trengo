Feature: Show Article by Id
    @showArticleId
    Scenario: Show Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..." with rate "4"
        And there is a article with title "How to enjoy!" and body "Lorem ipsum..." with rate "4"
        When I send the "get" request to path "/api/articles/2"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "article" : {
               "title" : "How to enjoy!",
               "body": "Lorem ipsum...",
                "rate": 4,
               "id": 2
            }
        }
        """

    @NotFoundArticleId
    Scenario: Could not Show Non-existed Article
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..." with rate "4"
        When I send the "get" request to path "/api/articles/2"
        Then The response status code is "404"
        And I should see the json:
        """
        {
            "error" : {
                "code" : "404",
                "message" : "your query is not in DB.",
                "type" : "ModelNotFoundException",
                "detail" : "Ensure your query id is in your database"
            }
        }
        """
