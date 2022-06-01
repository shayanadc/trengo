Feature: Store Articles
    @listArticles
    Scenario: List All Articles
        Given there is a article with title "How to have a fun!" and body "Lorem ipsum..." with rate "4"
        And there is a article with title "How to enjoy!" and body "Lorem ipsum..." with rate "4"
        And I send the "get" request to path "/api/articles"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "How to have a fun!",
               "body": "Lorem ipsum...",
                "rate": 4,
               "id": 1
            },
            {
               "title" : "How to enjoy!",
               "body": "Lorem ipsum...",
               "rate": 4,
               "id": 2
            }
            ]
        }
        """

    @listArticlesFilterByTitle
    Scenario: List All Articles
        Given there is a article with title "fun with ..." and body "Lorem ipsum..." with rate "4"
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..." with rate "4"
        And I send the "get" request to path "/api/articles?title=fun"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "fun with ...",
               "body": "Lorem ipsum...",
               "id": 1,
               "rate": 4
            }
            ]
        }
        """


    @listArticlesFilterByDate
    Scenario: List All Articles
        Given there is a article with title "fun with ..." and body "Lorem ipsum..." with rate "4"
        And today is "2020-01-01"
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..." with rate "4"
        And I send the "get" request to path "/api/articles?date=2020-01-01,2021-01-01"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "enjoy with ...",
               "body": "Lorem ipsum...",
               "id": 2,
               "rate": 4
            }
            ]
        }
        """

    @listArticlesFilterByCategory
    Scenario: List All Articles
        Given There is a Category with name "life style"
        And There is a Category with name "science"
        And there is a article with title "fun with ..." and body "Lorem ipsum..." with rate "4"
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..." with rate "4"
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
               "rate": 4,
               "id": 2
            }
            ]
        }
        """

    @listArticlesFilterByView
    Scenario: List All Articles Filter By Views Count
        And there is a article with title "fun with ..." and body "Lorem ipsum..." with rate "4"
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..." with rate "4"
        And there is a article with title "listen music ..." and body "Lorem ipsum..." with rate "4"
        And there is a "4" view for article "1"
        And there is a "3" view for article "2"
        And there is a "12" view for article "3"
        And I send the "get" request to path "/api/articles?views"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
            {
               "title" : "listen music ...",
               "body": "Lorem ipsum...",
               "id": 3,
               "rate": 4,
               "views" : 12
            },
            {
               "title" : "fun with ...",
               "body": "Lorem ipsum...",
               "id": 1,
               "rate": 4,
               "views" : 4
            },
             {
               "title" : "enjoy with ...",
               "body": "Lorem ipsum...",
               "id": 2,
               "rate": 4,
               "views" : 3
            }
            ]
        }
        """

    @listArticlesFilterByRate
    Scenario: List All Articles Filter By Rate
        And there is a article with title "fun with ..." and body "Lorem ipsum..." with rate "4"
        And there is a article with title "enjoy with ..." and body "Lorem ipsum..." with rate "5"
        And there is a article with title "listen music ..." and body "Lorem ipsum..." with rate "4.5"
        And I send the "get" request to path "/api/articles?rate"
        Then The response status code is "200"
        And I should see the json:
        """
        {
            "articles" : [
             {
               "title" : "enjoy with ...",
               "body": "Lorem ipsum...",
               "id": 2,
               "rate": 5
            },
            {
               "title" : "listen music ...",
               "body": "Lorem ipsum...",
               "id": 3,
               "rate": 4.5
            },
            {
               "title" : "fun with ...",
               "body": "Lorem ipsum...",
               "id": 1,
               "rate": 4
            }
            ]
        }
        """

