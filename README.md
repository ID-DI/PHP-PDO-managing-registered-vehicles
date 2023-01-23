# PLEASE READ
## This branch is somewhat extension on the branch that I've pushed on Monday morning round 02.00 am and it is marked as Challenge-17-PHP_PDO but in it I did not manage to complete the challenge in the search/print section in the dashbord.php. But after some 12 hours I did managed to complete the code, so in all due respect towards you I pushed it as different branch so you can (if you choose to) grade the project in its all completeness. But if you choose not to I will not take it as an offence. Thank you for your time and understanding.
## The code in bouth branches is not as it should be, but my speed is still not something to be desired.  

## stundet: Ivan Delev

## Full Stack Group-7

## Windows 10 Pro x 64; 
## Display resolution: 1366 x 768, 100%.

### The purpose of this project is to learn to use and create PHP PDO. The object was to write code for web-page creator, and display some properties.
 
### To open challenge properly, the autoloader is loaded with all the function require_once with rest of the files.

### The login and password are as they follow admin=>admin, Ivan_D=>1607.

### To work properly you have to upload the base in your phpmyadmin and enter your credentials in the file that is in classes/db.php.

Challenge - 17 - PHP PDO
An application for managing registered vehicles.
For this challenge we need to create an application for managing vehicle
licensing. It has 2 parts, one for all visitors and one for authenticated users
(admins).
Part 1.
The home page, looks like on the screenshot below.
There is an input for entering a license plate number of a vehicle.
If the user enters a valid license plate number (one added by the admin in
part 2), all information about that car should be displayed in a table.
If the license plate does not exist, a message that there is no such record
should be printed out on screen.
Add a navbar with a Login button in the right corner. There is no need to write
logic for registering users as the admins will be hardcoded into the database
and no new users will be allowed to register (this is a closed system).
Full Stack Academy - Challenge 16 - PHP - PDOPart 2.
Implement the login functionality using session. The users are stored in a
database table and the passwords are hashed.
After login, the admin should be presented with the following view:
This page consists of 2 parts:
1. A Vehicle Registration Form
The form should have the following inputs:
➢ vehicle model (dropdown, options fetched from database),
➢ vehicle type (dropdown, options fetched from database),
➢ vehicle chassis number (text),
➢ vehicle production year (date),
➢ registration number (text),
➢ fuel type (dropdown, options fetched from database),
➢ registration to (date)
Vehicle model, vehicle type and fuel type should all be resources
coming from database tables. You can name these tables as the inputs
themselves, only in plural, for example “vehicle_models”. For
vehicle_type the options can be hardcoded into a database, there is no
need to create dynamic CRUD for that. The available options are: sedan,
coupe, hatchback, suv, minivan. Same applies for the fuel_type table,
where available options are: gasoline, diesel and electric.
Full Stack Academy - Challenge 16 - PHP - PDOFor the vehicle_models table, a CRUD needs to be created and the
admin should be able to insert a new vehicle model if it doesn’t exist,
before licensing it.
All the information from the vehicle registration form is stored in one
table called registrations. Make a validation that prevents the admin
from adding two records in the database with the same chassis
number.
2. A table with all the licensed vehicles
The table should display all the information entered from the form.
Make a logic to check the registration_to date and color the row
according to its value. Display that table row in yellow color if the
registration is one month before expiration. If the registration has
expired, display that row in red.
In the action column besides the “delete” and “edit” buttons, add an
“extend” button for editing only the “registration_to” date for those
records that are expired or about to expire (yellow or red).
Add an input in the right corner of the table with a “search” button.
When you click on the search button, only the vehicles matching the
search criteria should be shown. The text from the input text field is
used to search the vehicles by model, license plate number or chassis
number. Here you should use the LIKE and OR operators.
Don’t leave room for SQL Injection attacks.
It would be great if you can create all of these operations using the OOP
programming model.
Deadline:
One week after the day of presentation (23:59).
Full Stack Academy - Challenge 16 - PHP - PDO

