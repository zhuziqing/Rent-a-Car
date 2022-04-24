# Rent A Car
This project was written by php and uses MySQL as the database. We use a localhost to run our project, so you need to download XAMPP.

First you need start XAMPP, enable localhost:8080 under the network and make sure Apache, MySQL and proFTPD all connect successfully.
Open amy browser and go to ```http://localhost:8080/phpmyadmin/```.
Create a new database called `carrenter`, then click `Import button` and import the `quicksetup.sql` file which is in our
project folder to set up the database.<br>

Then open the lampp disk (under the Volumes and click Mount first then Explore) and put our project folder in the `htdocs folder`. Open the browser and go
to `http://localhost:8080/superrent/cregister.php`, you will see the welcome page of our project.<br>

You can log in as a customer or as a clerk. 
* To log in as a customer, you can either follow the instructions to create a new account, or you can use `Driver Licence ID:
123456`, `Password:123456` to log in. 
* To log in as a clerk, you can use `Username: Amy`, `Password:19930505` to log in.
-----
There are three functions for customers:<br>
* View your vechicle reservations at home page.
* Check available vechicles under some conditions (location, car type, available date).
  * proper messages will be generated.
* Make a reservation (choose location, car type, start date, end date and fill the payment information).
  * A reservation number will be generated automatically if the reservation made sucessfully. Otherwise, some error messages will be displayed. <BR>

There are three functions for clerks:<br>
* Rent vechicle directly for clients.
* Return vechicles and gererate a recipe for customer.
  * If the vechicle was not rented or the vechicle has been returned, some error messages will be displayed.
* Generate daily rental and daily return report for single branch and for the whole company.

-----
Here is our log in page!<br>
![](https://github.com/Liu-Jingyu/Super-Renter/blob/master/superrent/image/Screen%20Shot%202020-05-01%20at%207.27.31%20PM.png)
