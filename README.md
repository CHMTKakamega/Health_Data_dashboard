# Health_Data_dashboard

Health data dashboard system to help ease the access of data in DHIS2.


/********************************************************************************************************************************\
For contributing:
1. Use the .sql as your database, all databases may employ this file.
if on Console, to import to your mysql, create a new database then CD to the location of this .sql file and run:

mysql -u your_mysql_user_name -p your_newly_created_db_name < kakamega.sql

Run all your operations and once done, if you'd like to contribute any changes in database use the following command to push back the updated sql( in order to create a .sql file):

mysqldump -u your_mysql_user_name -p your_updated_database_name > kakamega.sql

this will generate the updated database as a .sql file and will be located in your current working directory from cmd.

2. Always comment on your codes, this will be important in catching up with the code if one needs to test or contribute.

3. Update the connection.php file to match your database credentials since that the only reference to all your database connections.

Have fun 😎



