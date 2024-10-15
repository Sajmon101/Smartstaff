# SmartStaff

**SmartStaff** is an application developed in Polish that supports work organization in gastronomic establishments. It is built using HTML, CSS, PHP, and JavaScript. The application enables efficient order handling and staff management by dividing roles and automating kitchen and bar processes.

## Features

The application offers various functionalities depending on the account type. The available roles are: **Manager**, **Chef**, **Bartender**, and **Waiter**. Below is a detailed description of the functions available for each role:

### 1. Manager
- **Dish Management**: Adding new menu items, including the option to add photos that are automatically optimized for size.
- **Employee Management**: Adding new employees to the system with assigned roles and photos, which are also automatically resized.
- **Statistics**: Viewing the number of units sold for individual dishes in a given month and the number of orders handled by each employee over a selected period.

<p align="center">
  <img src="Images/BossView.png" alt="Main Menu" width="500"/>
</p>

### 2. Waiter
- **Order Entry**: Waiters can add orders for tables, with dishes automatically assigned to chefs and drinks to bartenders.
- **Order Monitoring**: The waiter can see all orders, with those entered by other waiters grayed out for better clarity.
- **Readiness Notifications**: After a dish is prepared by the chef or bartender, the waiter responsible for the order receives a readiness notification.

<img src="Images/WaiterView.png" alt="Game Screenshot" width="500"/> <img src="Images/Order.png" alt="Game Screenshot" width="500"/> 

### 3. Chef and Bartender
- **Order Fulfillment**: The dishes and drinks are divided between chefs and bartenders to ensure efficient order preparation.
- **Notifications**: Once a dish or drink is ready, the person responsible marks it as ready, which generates a notification for the appropriate waiter.

<p align="center">
  <img src="Images/ChefView.png" alt="Main Menu" width="500"/>
</p>

## Database Structure

The application uses a relational database. Below is the database schema showing the main tables and relationships between them.

<p align="center">
  <img src="Images/DBStructure.png" alt="Main Menu" width="600"/>
</p>

> **Note:** The database schema below shows a refactored version that has not yet been implemented in the current code.

## Use Case Diagram

The use case diagram illustrates the interactions between individual users and the system, providing a better understanding of the application's functionality and information flow.

<p align="center">
  <img src="Images/UseCaseDiagram.png" alt="Main Menu" width="600"/>
</p>

## Technologies

- **HTML5** and **CSS3**: Frontend of the application, responsible for the visual layer and user interface.
- **JavaScript**: Used to handle dynamic elements of the page.
- **PHP**: Backend of the application, responsible for logic and data processing.
- **MySQL**: Database storing information about users, dishes, orders, etc.

## Running the Application

For detailed instructions on how to run the SmartStaff application on a local server, please refer to the [INSTALL.md](./INSTALL.md) file. There, you will find the necessary steps to set up the environment and run the application.
