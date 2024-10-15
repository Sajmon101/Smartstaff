# SmartStaff Application Startup Guide

This guide outlines the steps needed to run the **SmartStaff** application on a local server, such as **XAMPP** or **WAMP**. The application has been tested and launched in a local environment (localhost), so if you choose a different setup, the steps may vary.

## Step 1: Install XAMPP or WAMP

1. **Download** and **install** XAMPP or WAMP:
   - XAMPP: [Official XAMPP Download Page](https://www.apachefriends.org/index.html)
   - WAMP: [Official WAMP Download Page](http://www.wampserver.com/)

2. **Start the local server** (Apache) and the database (MySQL) using the XAMPP or WAMP control panel.

## Step 2: Copy the Application Files to the Server Directory

1. Copy the application folder to the `htdocs` directory (for XAMPP) or the `www` directory (for WAMP). The destination directory should look as follows:
   - For XAMPP: `C:/xampp/htdocs/SmartStaff`
   - For WAMP: `C:/wamp/www/SmartStaff`

## Step 3: Create the Database

1. Open your web browser and go to [phpMyAdmin](http://localhost/phpmyadmin/).

2. Create a new database:
   - Click on "New" in the left-hand menu.
   - Enter the database name (e.g., `smartstaff`) and click "Create."

3. **Import the Database Structure**:
   - Go to the "Import" tab in phpMyAdmin.
   - Select the `.sql` file containing the SmartStaff database structure (you can find this in the project repository in the "DB" folder).
   - Click "Import" to upload the database structure.

## Step 4: Configure the Database Connection

1. Open the configuration file `baza.php` in the SmartStaff project folder.

2. If necessary, update the database settings to match your environment. A sample configuration might look like this:

   ```php
   <?php
   $host = 'localhost';
   $db   = 'smartstaff';
   $user = 'root';
   $pass = '';
   $charset = 'utf8mb4';
   ?>
   
- **user**: Ensure that you are using the correct MySQL user. For default XAMPP/WAMP installations, the user is usually `root`.
- **pass**: By default in XAMPP/WAMP, the password is empty (`''`), unless you have set a different one.
Save the file after making changes.

## Step 5: Launch the Application

1. Open your web browser and enter the local server address:

   http://localhost/SmartStaff
   

2. The SmartStaff application homepage should load. You can now log in with various accounts and test the application's functionality.

**Note**: Passwords in the database are encrypted, so they are not directly visible. For testing convenience, each test account has a password set to match its login.

## Step 6: Troubleshooting

- **Database Connection Error**: Check if the MySQL server is running in the XAMPP control panel and verify that the credentials in `baza.php` are correct.
- **404 Error**: Make sure the project folder is in the correct server directory (`htdocs` for XAMPP or `www` for WAMP).
- **Permission Issues**: Ensure you have the necessary access permissions to the project folders and the database.

---

**Note**: This guide is based on a local server (localhost) configuration, which was used during the development and testing of the application. Other configurations may require additional steps or modifications.


