## Runners Proof - API REST

This is a API for register runners in race proofs.

You can:

- store runners,

- store races, 

- subscribe runners in races,

- register proof results,

- list a general overview from results and

- list results grouped by age ranges.

A PHP Laravel 8 API, with Repository Pattern, Service Pattern and very best practices on coding, including several Laravel resources used.

Has some tests applyed, just for show the fucionality, with PHP Unit.

Was covered all routes in "Happy way" and some validation errors.

This first version doesn't have a token or any security plugin, my intention is aplly Passport to keep security.

So, this is it...

Thanks people!!!

## Technology

Here are the technologies used in this project.

* Composer (For dependencies)
* Laravel 8
* MySql 8
* Docker (With Laravel Sail)
* PHP 8
* PHP Unit

## Getting started

* First you need clone this repository! (Don't change folder's name)

* To install dependencies:
>   $ php composer.phar install

* .Env configuration:
>   Rename .env.example to .env.

* Run docker container up:
>   $ docker-compose up -d
* Ou utilizando o sail
>   ./vendor/bin/sail up

* Run ARTISAN commands to migrate

In linux terminal you can run php artisan command from docker container:
>   $ docker exec -it runnersproof_laravel.test_1 /bin/bash
> 
>   $ php artisan migrate
>

* And its all for now. 
** **


## How to use

**The routes defined are:**

    [POST]: /api/runners      - Receive multilevel JSON like example:
    Rule: Runners don't be minor age and CPF is unique.

    Example:
    [
        {
            "name":         Required    | String,
            "cpf":          Required    | String   | CPF validation,
            "birthday":     Required    | Date     | Format (YYYY-mm-dd) 
        }
        {
            ...
        }
        ...
    ]
**  **

    [POST]: /api/races        - Receive multilevel JSON like example:
    Rule:   - Don't has any validation here.

    Example:
    [
        {
            "type":         Required    |  Numeric
            "date":         Required    |  Date    | Format (YYYY-mm-dd)
        },
        {
         ...
        }
        ...
    ]
**  **

    [POST]: /api/races/subscribe      - Receive multilevel JSON like example:
    Rule:   - Runners and races demands previously registration.
            - Runners can't be subscribed in two races at same day.
            - Runners can't be subscribed two times in same race.
    Example:
    [
        {
            "runner_id":            Required    | Numeric   | Exist on Runners
            "race_id":              Required    | Numeric   | Exist on Races
        },
        {
            ...
        }
        ...
    ]
**  **

    [PUT]: /api/results/          - Receive multilevel JSON like example:
    Rules:  - Finish time needs be greater then begins.
            - Runner and race demands previously attachment, this is a UPDATE.
    Example:
    [
        {
            "runner_id":        Required    | Numeric   | Exist on Runners
            "race_id":          Required    | Numeric   | Exist on Races
            "begin":            Required    | String    | Format(HH:mm:ss)
            "finish":           Required    | String    | Format(HH:mm:ss)
        },
        {
            ...
        }
            ...
    ]
**  **

    [GET]: /api/results     - "Deliver IT" two possible JSON responses, according query parameters.
    Query parameter:        - byAge : true, false or just no mentioned (false default).
    All data in this example is fake, generate with JSON faker.
    
    FIRST EXAMPLE: Return from request without byAge parameter or false:
    Explanation:   This feature returns a general result formatted in JSON grouped by race type.
    {
    "data": {
        "3Km": [
            {
                "race_id": 1,
                "runner": [
                    [
                        {
                            "runner_id": 20,
                            "name": "Ana Ester Silvana Barros",
                            "age": 64,
                            "position": "1st",
                            "total_time": "00:02:00"
                        },
                        {
                            "runner_id": 9,
                            "name": "Alexandre Luís Gomes",
                            "age": 77,
                            "position": "2st",
                            "total_time": "00:09:38"
                        }
                    ]
                ]
            },
            {
                "race_id": 3,
                "runner": [
                    [
                        {
                            "runner_id": 7,
                            "name": "Ayla Mariana Luciana Vieira",
                            "age": 39,
                            "position": "1st",
                            "total_time": "00:07:00"
                        },
                        {
                            "runner_id": 9,
                            "name": "Alexandre Luís Gomes",
                            "age": 77,
                            "position": "2st",
                            "total_time": "00:09:34"
                        }
                    ]
                ]
            }
        ],
        "20Km": [
            {
                "race_id": 6,
                "runner": [
                    [
                        {
                            "runner_id": 1,
                            "name": "Cláudia Clarice Benedita Campos",
                            "age": 18,
                            "position": "1st",
                            "total_time": "00:01:38"
                        }
                    ]
                ]
            }
        ]
    }

    SECOND EXAMPLE: Return from request with byAge true parameter:
    Explanation:    This feature returns formatted JSON with age-classified runners
                    and your positions on range.
    {
        "data": [
            {
                "race_id": 3,
                "race_type": "3 Km",
                "age_range": {
                    "18 – 25 years": [],
                    "36 – 45 years": [
                        {
                            "race_id": 3,
                            "race_type": "3 Km",
                            "runner_id": 7,
                            "name": "Ayla Mariana Luciana Vieira",
                            "runner_age": 39,
                            "total_time": "00:07:00",
                            "age_range": "36 – 45 years",
                            "position": "1st"
                        }
                    ],
                    "46 – 55 years": [
                        {
                            "race_id": 3,
                            "race_type": "3 Km",
                            "runner_id": 14,
                            "name": "Miguel Heitor Campos",
                            "runner_age": 51,
                            "total_time": "00:14:14",
                            "age_range": "46 – 55 years",
                            "position": "1st"
                        }
                    ],
                    "55 years up": [
                        {
                            "race_id": 3,
                            "race_type": "3 Km",
                            "runner_id": 9,
                            "name": "Alexandre Luís Gomes",
                            "runner_age": 77,
                            "total_time": "00:09:34",
                            "age_range": "55 years up",
                            "position": "1st"
                        },
                        {
                            "race_id": 3,
                            "race_type": "3 Km",
                            "runner_id": 18,
                            "name": "Alexandre Giovanni Baptista",
                            "runner_age": 63,
                            "total_time": "00:18:38",
                            "age_range": "55 years up",
                            "position": "2st"
                        },
                        {
                            "race_id": 3,
                            "race_type": "3 Km",
                            "runner_id": 20,
                            "name": "Ana Ester Silvana Barros",
                            "runner_age": 64,
                            "total_time": "00:20:35",
                            "age_range": "55 years up",
                            "position": "3st"
                        }
                    ]
                }
            }
        ]
    }


## Versioning

1.0.0.0


## Author

* **Gabriel Bruno Almeida**:
  
    * @GitHub (bit.ly/myGitHubRepos)
    
    * @LinkedIn (bit.ly/myResumeLinkedIn)

