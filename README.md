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


# PHP initial Project
Main structure of php project. Folders / files:
- **app**
  - **controllers**
  - **models**
  - **views**
- **config**
- **lib**
  - **base**
- **web**

### Usage

The web/index.php is the heart of the system.
This means that your web applications root folder is the “web” folder.

All requests go through this file and it decides how the routing of the app
should be.
You can add additional hooks in this file to add certain routes.

### Project Structure

The root of the project holds a few directories:
**/app** This is the folder where your magic will happen. Use the views, controllers and models folder for your app code.
**/config** this folder holds a few configuration files. Currently only the connection to the database.
**/lib** This is where you should put external libraries and other external files.
**/lib/base** The library files. Don’t change these :)
**/web** This folder holds files that are to be “downloaded” from your app. Stylesheets, javascripts and images used. (and more of course)

The system uses a basic MVC structure, with your web app’s files located in the
“app” folder.

#### app/controllers
Your application’s controllers should be defined here.

All controller names should end with “Controller”. E.g. TestController.
All controllers should inherit the library’s “Controller” class.
However, you should generally just make an ApplicationController, which extends
the Controller. Then you can defined beforeFilters etc in that, which will get run
at every request.

#### app/models
Models handles database interaction etc.

All models should inherit from the Model class, which provides basic functionality.
The Model class handles basic functionality such as:

Setting up a database connection (using PDO)
fetchOne(ID)
save(array) → both update/create
delete(ID)
app/views
Your view files.
The structure is made so that having a controller named TestController, it looks
in the app/views/test/ folder for it’s view files.

All view files end with .phtml
Having an action in the TestController called index, the view file
app/views/test/index.phtml will be rendered as default.

#### config/routes.php
Your routes around the system needs to be defined here.
A route consists of the URL you want to call + the controller#action you want it
to hit.

An example is:
$routes = array(
‘/test’ => ‘test#index’ // this will hit the TestController’s indexAction method.
);

#### Error handling
A general error handling has been added.

If a route doesn’t exist, then the error controller is hit.
If some other exception was thrown, the error controller is hit.
As default, the error controller just shows the exception occured, so remember
to style the error controller’s view file (app/views/error/error.phtml)


### Utilities
- [PHP Developers Guide](https://www.php.net/manual/en/index.php).
- .gitignore file configuration. [See Official Docs](https://docs.github.com/en/get-started/getting-started-with-git/ignoring-files).
- Git branches. [See Official Docs](https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell).
