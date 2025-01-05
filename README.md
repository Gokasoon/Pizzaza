# Pizzaiolo & PIZZAZA

## Overview

This project includes a web application for managing a pizzeria and a desktop application for viewing upcoming pizzas to be cooked. It includes functionalities for handling orders, managing pizzas, and interacting with customers.

## Project Structure

- **Pizzaiolo/**: Contains the Java backend code.
  - `src/`: Source code for the backend.
  - `bin/`: Compiled classes.
  - `mysql-connector-j-8.0.33.jar`: MySQL connector for database interactions.

- **PIZZAZA/**: Contains the PHP frontend code.
  - `config/`: Configuration files.
  - `controller/`: PHP controllers.
  - `css/`: Stylesheets.
  - `img/`: Images.
  - `index.php`: Entry point for the web application.
  - `model/`: PHP models.
  - `view/`: PHP views.

## Prerequisites

- PHP 7.4 or higher
- MySQL
- Apache or any other web server
- Java 17
- Apache Tomcat (for running the Java backend)

## Setup

### Backend (Pizzaiolo)

1. **Import the project into Eclipse**:
   - Open Eclipse.
   - Go to `File -> Import -> Existing Projects into Workspace`.
   - Select the `Pizzaiolo` directory.

2. **Add MySQL Connector**:
   - Ensure `mysql-connector-j-8.0.33.jar` is added to the build path.

3. **Run the backend**:
   - Right-click on the project.
   - Select `Run As -> Java Application`.

### Frontend (PIZZAZA)

1. **Set up the web server**:
   - Place the `PIZZAZA` directory in the web server's root directory (e.g., `htdocs` for XAMPP).

2. **Configure the database**:
   - Update the database configuration in `PIZZAZA/config/config.php`.

3. **Start the web server**:
   - Start Apache or your preferred web server.

4. **Access the application**:
   - Open your web browser and navigate to `http://localhost/PIZZAZA/index.php`.

## Usage

- Access the web application through the browser.
- Use the provided interface to manage pizzas, orders, and customers.