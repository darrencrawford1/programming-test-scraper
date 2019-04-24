# Developer Task 2

This task is designed to check your logical and problem solving skills. The framework is Laravel's [Lumen](https://lumen.laravel.com/) and it uses some [Composer](http://getcomposer.org) packages.

### Overview

Sometimes our clients have their own websites which lists their current stock. Part of their agreement with us is that their stock is 'pulled' through to our website. In order to achieve this, we write scraping scripts to crawl the dealer's site and return the appropriate information.

This project is a working example of how that might be achieved. For the purposes of this example, we are not storing registrations, dealer information or determining the uniqueness of the vehicles before they are saved. Additionally, it is only focussed on one scraping class for [BeechlawnMotors](app/Scraper/Providers/BeechlawnMotors.php).

For simplicity, the project is using a file based sqlite database. An empty version of this file is in storage/database.sqlite. You can connect to it in any way you wish.

### Task 1

Fork this git repository and get the project up and running. Make sure to commit Your work after every completed task.

> Ensure your forked repository is set to private before completing the rest of these tasks.

Copy & rename /.env.example to /.env to set your environment variables. These have been preconfigured for you.

You can run PHP built-in server by running following command `php -S localhost:8000 -t public/`

The web application is now running at http://localhost:8000.

> Don't forget to commit your changes after each task.

### Task 2

A 'scrape' on the API can be simulated by browsing to http://localhost:8000/api/scraper/beechlawnmotors/scrape

Although the scrape is successful, the data does not appear to be correct. Some vehicles are being duplicated, while some vehicles are missing completely.

Find and correct these problems.

> Don't forget to commit your changes after each task.

### Task 3

The vehicle prices in the scrape are all being returned as "0". Discover why this is happening and implement an appropriate fix in the Class.

> Don't forget to commit your changes after each task.

### Task 4

The data for models in the database does not match up with the data in the JSON. Find and correct this issue.

> Don't forget to commit your changes after each task.

### Task 5

Make any final commits, add any additional notes and push your changes to your own private repository. Give access to your repository on GitHub to 'darrencraig' and email darren@usedcarsni.com once you are finished.





