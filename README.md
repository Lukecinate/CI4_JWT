# Authentication System with PHP CI4, JWT, and Dibi

## Overview

Welcome to our project where we demonstrate how to implement robust authentication using PHP CodeIgniter 4 (CI4), JSON Web Tokens (JWT), and the Dibi database framework. This project is designed for developers who want to enhance the security of their web applications by leveraging modern authentication methods. In this project I'm not covering you a fully token management system and authentication management system, this is just basics for whom want to try the JWT token only.

## Project Goals

1. **Environment Setup**: Guide you through setting up a development environment with CI4, JWT, and Dibi.
2. **Authentication**: Implement login and secure token generation.
3. **Token Validation**: Ensure that only authenticated users can access certain parts of the application by validating JWT tokens.
4. **Security Best Practices**: Apply best practices to keep user data and tokens secure.

## Key Features

- **User Login**: Authenticate users and generate JWT tokens upon successful login.
- **Token Management**: Issue and validate JWT token.
- **Protected Routes**: Restrict access to certain parts of the application based on authentication status.

## Technologies Used

- **CodeIgniter 4**: To provide a robust framework for building PHP applications.
- **JWT**: To handle the creation and verification of tokens.
- **Dibi**: To manage database operations efficiently.

## Getting Started

### Prerequisites

- PHP (>= 7.4)
- Composer

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/Lukecinate/CI4_JWT.git
    ```
2. Navigate to the project directory:
    ```bash
    cd yourproject
    ```
3. Install dependencies:
    ```bash
    composer install firebase/php-jwt
    composer install dibi/dibi
    ```

### Configuration

1. Copy the `.env` and set your environment variables.
2. Configure CodeIgniter 4:
    - Set the base URL and database settings in `app/Config/App.php` and `app/Config/Database.php`.
    - Set the filters at `app/Config/Filters` and `app/Filters`
3. Configure JWT:
    - Set the JWT secret key in your `.env` file.
4. Configure Dibi:
    - Set the database connection settings in your `app/Models/[Your_Models]` file.

### Running the Application

1. Start the development server:
    ```bash
    php spark serve
    ```
2. Access the application at `http://localhost:8080`.

## Project Structure

The project is organized into the following directories:

- **app/Controllers**: Contains the logic for handling user requests and responses.
- **app/Models**: Defines the structure and interactions with the database.
- **app/Views**: Holds the frontend files (if any) for the user interface.
- **config**: Contains configuration files for CI4, JWT, and Dibi.

## Conclusion

By following this guide, you will successfully implement an authentication system using PHP CI4, JWT, and Dibi. This system will allow you to securely manage user authentication, and protect routes. Happy coding!

