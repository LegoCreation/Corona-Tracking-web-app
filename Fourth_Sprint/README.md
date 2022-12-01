# se-04-team-20
### Brief
<hr>

Sprint 4

- Shishir Sunar

- Ankel Lazaj

<hr>

### Maintaining & Running
#### Credentials for the mysql can be must edited inside the file "db.php" before running.


```bash
# Clone the repo.
git clone https://github.com/Magrawal17/se-sprint04-Team20 -> only for sample
cd se-sprint04-Team23/


# Uploading database
$ mysql -u {YOUR CURRENT USERNAME OR ROOT} -p < dumpfile.sql

# Start php server
$ php -S localhost:5000

```
<hr>

Login info: 
username or email: h@h
password: htest
phone number: 1

<hr>

```bash
#install PHPunit
write on terminal -> composer require phpunit/phpunit

# Start tescases
Enter tescases folder
Ex: cd Documents/se-04-team-20/testcases

write on terminal -> ./vendor/bin/phpunit

```


### Sprint 4 Development

✔ Internal pages could be accessed without login. Added session filter in all internal pages.

✔ Now, only one type of user could login at a time to reduce the jeopardy.

✔ Added place login page as it was not there before.

✔ Fixed Download QR code function as it was not working.

✔ Added data visualization for agents.

✔ Added email sending system for hospitals.

✔ Checkout function was not working so fixed that.

✔ Fixed pages links that were buggy and not working.

✔ Added through installation guide.

✔ Added test cases. 



<hr>

Sprint 3

- Keagan Holmes

- Zixiang Wang

<hr>

### Maintaining & Running
Credentials for the mysql can be found inside the file "db.php".


Database generating script: db-generator.sql <br>
To update the db generator, run this command on **clamv** under the root folder of the repository
to export the selected database and name the dump file.
```
mysqldump -u seteam20 -p'PZiVHc7p' seteam20 > db-generator.sql
```




### Sprint 3 Development

✔ Set up website on new clamv server.  

✔ Updated README.  

✔ Add comments to most files in the repo for better documentation.  

✔ Updated HTML/CSS on all visitor pages for an improved user experience.  

✔ Updated error handling on visitor pages, created new "error-box" class.  

✔ Added db-generator.sql file that can be used to recreate the database.  

✔ Updated the existing dumpfile.sql file such that it can be sourced in native mySQL.  

✔ Added documentation for how to source the dumpfile.sql file (commented in the code).  

✔ Added CSS to hospital homepage to fix weird display issues for the "mark infected" and "mark uninfected" buttons.  

✔ Fixed errors in several pages (especially the hospital login page) where the incorrect redirect was returned.  

✔ Updated visitor registration disclaimer to be inline in the page and more precise.  

✔ Added padding to the "return to homepage" button that is shown on most pages.  

✔ Updated test cases in the test.php file.  

✔ Remade 17 test cases with both different methods and more precise uses (which were completely not-functional).  

✔ Added 5 new test cases.  

✔ Added documentation in the dumpfile.sql file showing default credentials for different users.  



#### Testing:  
Go to [this](http://clabsql.clamv.jacobs-university.de/~zixwang/test.php) page to view the outcomes of several test cases.  

## To login to individual landing page:
- Visitor: <i>Email</i>: 5555
           <i>Password</i>: test
- Hospital: <i>Email</i>: GrandeH
           <i>Password</i>: Htest
- Agent: <i>Email</i>: admin
           <i>Password</i>: pass123
           

<hr>

# se-02-team-20
### Prerequisites
To run this software please refer to the clamv link below:

Clamv website: http://clabsql.clamv.jacobs-university.de/~sgurubacha/SE

Credentials for the mysql can be found inside the file "db.php".


Sprint 2

- Bidur Niroula

- Sakar Gopal Gurubacharya

<hr>


### What is Corona Disease Management Software?
Ever since the coronavirus pandemic ravaged the world, health experts and officials have been scrambling ideas to contain the spread of the virus. This software is deisgned to aid the efforts in limiting the escalation by providing responsible agents valuable data about the sitution of COVID in their area. This data is provided by regular citizens who have to check-in to places they go to so that officials have record of other citizens who they have been in contact with, if they are tested positive. This way the chain of contacts for every single person is better visualized so policy making would be easier.


### This software is developed with:
- HTML
- CSS
- Javascript
- PHP
- MySQL


### File Structure
        \--se-02-team-20
                \--agent                           # folder for all things Agent
                        \--agent-see-options.php
                        \--Agent-sess-details.php
                        \--agentLand.php
                        \--agentLogin.php
                        
                \--hospital                         # folder for all things Hospital
                        \--hospitalAdd.php
                        \--hospitalLand.php
                        \--hospitalLand.php
                        \--hospitalRegister.php
                        
                \--js                               # javascript functionalities
                        \--hospitalManage.js
                        \--markVisitor.js
                        \--scan.min.js
                        
                \--partials                         # CSS for each page
                        \--footer.php
                        \--header.php
                        
                        
                \--place                            # folder for all things Place
                        \--placeAdd.php
                        \--placeLand.php
                        \--placeRegister.php
                        \--hospitalRegister.php
                        
                \--static/css                       # All CSS work in one place
                        \--diff.css
                        \--main.css
                        
                \--test                             # Directory for testing purposes
                        \--agentLogintest-hospital.js
                        \--agentLogintest-visitor.js
                        \--hospitalLogintest.js
                        \--indextest.js
                        \--pagenotfoundtest.js
                        \--usertest.js
                        \--visitorLogintest.js
                        
                \--visitor                            # folder for all things Visitor
                        \--visitorAdd.php
                        \--visitorLand.php
                        \--visitorLogin.php
                        \--visitorRegister.php
                        \--visitortimeended.php
                        \--visitortimestarted.php
        
                -- .htaccess                          # accessing error404 page when wrong address is put
                -- ajax.php                           # Update ID from Hospital
                -- db.php                             # Basic connection to the db using PDO.
                -- dumpfile.sql                       # All SQL commands
                -- error404.php                       # Error page for 404 error
                -- index.php                          # HomePage of Software 
                -- logout.php                         # Session Logout 
                -- markVisitor.php                    # Mark corona status of visitors
                -- package-lock.json                  # To run Mocha & Chai 
                -- package.json                       # To run Mocha & Chai
                -- README.md                          # Documentation of program  
                -- requirements.txt                   # Things to run the code   
                -- test.php                           # General testing code
<hr>


### Sprint 2 Development

✔ Placeowners can generate a unique QR code respective of place-name. 

✔ The QR Code is downloadable.

✔ Upon scanning the QR Code, Visitors now will be redirected to the "you are in" page containg the 'check-out' button that brings back to the home page.

✔ Developed a full landing page for Agent 

✔ Agents can see the list of all visitors along with their details like infected status, address, phone number.

✔ Agents can see the list of all places and their respective place owners.

✔ Agents can see the list of places where each visitors went along with the respective entry date, entry time, and place.

✔ Agents can see the list of all the approved hospitals along with their contact info. 

✔ Created additional test cases in mocha & chai as well as test.php for further testing.

✔ Sanitized the SQL query inputs.

✔ The further feature improvements were made in accordance with the already given GUI. The app now has uniform GUI. 

✔ Created file stucuture of the web-app for future ease.

✔ Created requirement.txt file which wasn't provided.


<hr>

(TAKEN FROM SPRINT 1)

## How to run the test cases

First install mocha and chai:

```$ npm install --save-dev mocha ``` 

``` $ npm i chai  ``` 

in order to test HTML elements, you need to inject document, windowand other DOM API into your Node.js environment.

``` $ npm install --save-dev --save-exact jsdom jsdom-global ``` 

``` $ npm i chai-dom ``` 


Run the test:

```  mocha Indextest.js``` 

```  mocha agentLogintest.js``` 

```  mocha hospitalLogintest.js ``` 


@@ -136,7 +148,9 @@ Run the test:
```  mocha visitorLogintest.js 
``` 


## To test the users:
Also, you can view the test.php file to see individual test cases outside of mocha and chai.


## To login to individual landing page:
- Visitor: <i>Email</i>: 5555
           <i>Password</i>: test
- Hospital: <i>Email</i>: GrandeH
           <i>Password</i>: Htest
- Agent: <i>Email</i>: admin
           <i>Password</i>: pass123
           
<hr>

### Acknowledgement
Thanks to the TAs of this course: Mahiem Agrawal, Kaushik Dayalan, Rron Alo & Shubhushan Kattel for their assistance
***
***
***
***
***
***
***
# SE-Sprint01-Team20
 Clamv website: http://clabsql.clamv.jacobs-university.de/~asavu/SE/
 
 
 Credentials for the mysql can be found inside the file "db.php".
 
 Contributors: Antonia Savu, Urfan Alvani
 
## What was Implemented:
  1. Main page, with links towards the login forms of visitor,hospital and agent, as well as registration for place owner(as login does not make sense). -> index.php
  2. Visitor Registration page, which, upon success, leads you to the main page for visitors. -> visitor/visitorRegister.php
  3. Visitor Login page, which, upon success, leads you to the main page for visitors. -> visitor/visitorLogin.php
  4. Visitor Main page, where all the visitor functions are to be implemented. -> visitor/visitorLand.php
  5. Visitor Add page, which contains the code for adding a specific user in the database from the registration form. -> visitor/visitorAdd.php
  6. Agent Login page, which, upon success, leads you to the main page for agent. -> agent/agentLogin.php
  7. Agent Main page, where all the agent functions are to be implemented. -> agent/agentLand.php
  8. Place owner registration page, which, upon success, leads you to the main page for a specific place. -> place/placeRegister.php
  9. Place owner Add page, which contains the code for adding a specific plae in the database from the registration form. -> place/placeAdd.php
  10. Place owner Main page, where all the place functions are to be implemented. -> place/placeLand.php
  11. Hospital Registration page, where a hospital can submit their registration form. -> hospital/hospitalRegister.php
  12. Hospital Add page, which adds hospitals in the database with the status "PENDING". -> hospital/hospitalAdd.php
  13. Hospital Login page, which, upon success(only for hospitals with the status "ACCEPTED"), leads you to the main page for hospitals. -> hospital/hospitalLogin.php
  14. Hospital Main page, where all the hospital functions are to be implemented. -> hospital/hospitalLand.php
  15. Session management, so whenever you login you create a session, which gets destrotyed when you logout. ->logout.php, every login page
  16. All passwords that enter the database are hashed. -> all register pages
  17. In the landing page for visitors, QR scanning was implemented. (Note: this algorithm only works on secure locations i.e https or localhost => doesn't work on clamv)
  18. In the landing page for agent, we have implemented the function which allows the agent to accept or reject the registration form of a hospital. This was done using AJAX.
  19. In the landing page for the hospital, we have implemented the function which allows the hosptital to change the status (infected or uninfected) of a visitor. This was also done using AJAX.
  20. Frontend to enhance the GUI. (custom buttons, custom forms, custom hover interactions etc.)
## How to set up PHP for local development
If you are using Linux,  you can easily install Apache, Mysql, PHP through the terminal. Here is a [tutorial]( https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04) that can easily be followed.
If you are using Windows, you can use something like XAMPP or Laragon , which set up for you and Apache server, MySQL and PHP. In my opinion, Laragon is a better alternative, as it is easier to set up and is very beginner friendly. That is what I used for this project. Here is a [tutorial](https://fofxacademy.com/how-to-setup-laragon-as-a-web-development-environment) for getting started with Laragon. Once you installed Laragon, put all of the files inside the ```www``` folder of lagaron.
Example of my path: ``` "C:\laragon\www"  ``` 
Once you do this, all you have to go is open Laragon, press Start All on the bottom left, then open ```localhost``` on your favorite browser.
I also highly recommend installing HeidiSQL, as it will make your life much easier when dealing with the database. Steps on how to install and set up HeidiSQL can also be found in the link above. In order to add the existing database to HeidiSQL, use the given mysqldump (```seteam20.sql```) or get a fresh one from clamv using ```mysqldump -u seteam20 –p PZiVHc7p  seteam20  > [dumpfilename.sql]```. <- you run this on clamv.
Then , to add it to HeidiSQL, run on your computer ```mysql -u root  < C:\Desktop\dumpfilename.sql``` or whatever the path of your dumpfile is. OR you can do this directly in HeidiSQL, method explained [in this very short video](https://www.youtube.com/watch?v=xBbqDLXrZGY).
## How to set up PHP for remote using SSH
We are currently hosting this web service on clamv, which already has everything set up for you. You can work directly on the files from clamv [using Visual Studio Code's SSH Extension](https://code.visualstudio.com/docs/remote/ssh). Again, credentials for mysql can be found in ```/db.php```. Just add all the files in this repo to your ```/~user/``` in CLAMV and connect like shown in the tutorial. You might find it useful to use a tool such as [WinSCP] for this. Then, connect as shown in [here](https://prnt.sc/NwOlISOR8vzt). Note: WinSCP only works on Windows. If you are running something else, you might consider some alternatives like [FileZilla](https://filezilla-project.org/).
## How to run the test cases
First install mocha and chai:
```$ npm install --save-dev mocha ``` 
``` $ npm i chai  ``` 
in order to test HTML elements, you need to inject document, windowand other DOM API into your Node.js environment.
``` $ npm install --save-dev --save-exact jsdom jsdom-global ``` 
``` $ npm i chai-dom ``` 
Run the test:
```  mocha Indextest.js``` 
```  mocha agentLogintest.js``` 
```  mocha hospitalLogintest.js ``` 
Terminal:
index.html
    Level 3 heading
      √ h3 element should say 'Corona Archieve'
1 passing (39ms)
