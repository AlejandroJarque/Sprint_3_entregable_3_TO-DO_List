## Description:
In this project, we've created a task app where users can register and create their own to-do lists, categorizing them by type. 
First, the user registers to view their profile, and from there they can navigate the application.

## Proyect:
To create this application, we used the MVC architectural pattern, which is based on creating a model class connected to a controller class. 
This controller, in turn, displays the different views through predefined routes. Both the model and the controller have different methods that handle each task the module needs to perform, 
such as creating or deleting an object. The routes define the flow of views based on the actions we take. 
For example, when entering the program for the first time, if it doesn't have any users stored in its JSON database, it will display the registration view. However, if we have already created our profile, it will take us directly to the login view without having to go through the registration view. Each module consists of a series of indexes, which serve as the starting point for each part of the application.

## Views:
For the design of the views, we used Tailwind, which helped us add styles directly to the phtml scripts, generating visually appealing views. 
We also added emojis to provide a more visual guide to the functions.

## Json files:
To store all the information, we used separate JSON files for each module, so the information is automatically stored as the user fills in the fields. 
We generated a JSON file for each module so the information wouldn't get mixed up and we could review the files more easily.

## Technologies and Gadgets:
 - MVC architectural pattern
 - Tailwind
 - Json files
 - Visual Studio Code
 - GitHub
 - Xampp

## Facility:
 - Clone the repository: git clone https://github.com/IT-Academy-BCN/phpInitialDemo
 - Create a branch and define it as default from the main branch: git checkout -b develop main
 - Generate branches for each module starting from the develop branch: - git checkout -b feature/setup_generals develop (that one isn't necesary, but as we did i highlight it)
                                                                       - git checkout -b feature/users develop
                                                                       - git checkout -b feature/tasks develop
                                                                       - git checkout -b feature/categories develop
 - Once every branch was finished switch the branch to the develop and: - git merge feature/setup_generals (that one isn't necesary, but as we did i highlight it)
                                                                        - git merge feature/users
                                                                        - git merge feature/tasks
                                                                        - git merge feature/categories
 - When every thing is done just make a pull request from develop branch to main branch from GitHub.

## Proyect structure:
*app/
      - controllers/
                   - UserController.php
                   - TaskController.php
                   - CategoryController.php
      - models/
              - User.php
              - Task.php
              - Category.php
      - views/
             - common/
                     - footer.phtml
                     - header.phtml
            - layouts/
                     - layout.phtml
            - scripts/
                  - categories/
                              - create.phtml
                              - edit.phtml
                              - index.phtml
                  - error/
                  - home/
                        - index.phtml
                  - tasks/
                         - create.phtml
                         - edit.phtml
                         - index.phtml
                         - show.phtml
                  - test/
                  - users/
                         - index.phtml
                         - login.phtml
                         - register.phtml
      
*config/
      - db.inc.php/
      - environment.inc.php/
      - routes.php/
      - settings.ini/
*lib/
      - base/
*web/
      - images/
      - javascripts/
      - stylesheets/
      - .htaccess
      - index.php
 *README.md

