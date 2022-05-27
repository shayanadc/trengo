Feature: Store Articles
    @listArticles
    Scenario: List All Articles
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..."
        And there is a article with title "How to enjoy!" and body "Lorem ipsum..."
        And I send the "get" request to path "/api/articles"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "How to have a fun!",
               "body": "Lorem ipsum...",
               "id": 1
            },
            {
               "title" : "How to enjoy!",
               "body": "Lorem ipsum...",
               "id": 2
            }
            ]
        }
        """

    @listArticlesFilterByTitle
    Scenario: List All Articles
        Given there is a article with title "fun with ..." and body "Lorem ipsum..."
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..."
        And I send the "get" request to path "/api/articles?title=fun"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "fun with ...",
               "body": "Lorem ipsum...",
               "id": 1
            }
            ]
        }
        """


    @listArticlesFilterByDate
    Scenario: List All Articles
        Given there is a article with title "fun with ..." and body "Lorem ipsum..."
        And today is "2020-01-01"
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..."
        And I send the "get" request to path "/api/articles?date=2020-01-01,2021-01-01"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "enjoy with ...",
               "body": "Lorem ipsum...",
               "id": 2
            }
            ]
        }
        """

    @listArticlesFilterByCategory
    Scenario: List All Articles
        Given There is a Category with name "life style"
        And There is a Category with name "science"
        And there is a article with title "fun with ..." and body "Lorem ipsum..."
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..."
        And The article id "2" attach "2" categories
        And I send the "get" request to path "/api/articles?categories=2"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "enjoy with ...",
               "body": "Lorem ipsum...",
               "id": 2
            }
            ]
        }
        """

