BUS ROUTE SYSTEM v1.0
--------------------------------------------------------------------------------------------------------------------------------------
Author : Syed Muhammad Dawer
Supervisors	: Sir Shams Naveed
			  Furqan Alam
Developed for : Institute Of Business Administration,
				Karachi.
--------------------------------------------------------------------------------------------------------------------------------------
ABOUT THE APPLICATION
The BUS ROUTE SYSTEM provides a simple and efficient bus management system which incorporates managing the buses, defining routes for
these busses, maintaining schedules, etc, at the administrator level and also provides a simple public web interface for the clients
to search and reserve seats and to get printable tickets upon completing the payment procedure.

The system also provides simple and quick statistics of the monthly reservations on the admin dashboard and provides simple and 
easy to use interface to manage busses,routes and cities.

--------------------------------------------------------------------------------------------------------------------------------------
CONTENTS
Your package should contain the following files:

-	Project Folder
-	DB Export Folder
--------------------------------------------------------------------------------------------------------------------------------------
INSTALLATION INSTRUCTIONS:
To install and test the product in your localhost you need to follow the steps below:

-	copy the whole "Project" folder from the package and paste it inside your public html folder i.e "C:\wamp\www\"
-	Open PL/SQL and first create a new user with the name "DAWERPJ" with the password "dawer123"
-	If you want to avoid this step and would like to work in your own user you will	have to update the connection.php
	file which resides in two places:
		=>Inside the project folder ("Project/connection.php")
		=>Inside the admin folder ("Project/admin/connection.php")
-	Once your new user is created login to "dawerpj" and open the import utility from 'Tools->Import Tables'
-	At the import file option select the "ex.dmp" file from "DB Export" Folder.
-	Hit Import button and check logs to see if the import was successful or not.
-	If the import runs into any errors, ensure at the 'SQL Inserts' tab Use Command Window is selected and not SQL* Plus and try again.
-	If the import still gives errors, try importing any other .dmp file from the DB Export Folder.
---------------------------------------------------------------------------------------------------------------------------------------
SYSTEM REQUIREMENTS:
-	Latest version of Google Chrome for optimized usage (Date Pickers, etc)
-	WAMP Server
-	PL/SQL
-	Oracle Database
---------------------------------------------------------------------------------------------------------------------------------------
ADMIN LOGIN CREDENTIALS:
For Accessing the Admin Panel use the following credentials:
	Username: dawer
	Password: dawer
---------------------------------------------------------------------------------------------------------------------------------------
													ENJOY! :)
 

