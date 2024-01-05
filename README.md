# 🌟 National Service Scheme (NSS) Project

## 📜 About

The National Service Scheme (NSS) is a digital platform designed to streamline and simplify the application process for National Service enrollment. Developed to offer convenience, efficiency, and accessibility, NSS facilitates the digital submission of applications, making the process hassle-free for users.

## ✨ Features

- **💻 Digital Application Submission:**
  NSS allows users to easily submit their applications digitally. Users can fill in details and submit the downloaded form, simplifying the enrollment process.

- **📚 Student Portal:**
  The platform offers a dedicated portal for students. Here, they can edit and update their personal details. Additionally, students can access the latest news, notifications, and essential updates conveniently.

- **🔧 Admin Functionality:**
  NSS provides comprehensive tools for administrators. Admins can efficiently manage user data by generating reports of enrolled students, deleting users as needed, and adding important news and notifications.

## 🛠️ Installation

### Prerequisites

Before installation, ensure you have the following:

- [XAMPP Server] https://www.apachefriends.org/ .

### Database Setup

1. Create the necessary databases, tables, and columns:
   - **Database Name:** login;
   - **Tables:** 
     - **Table Name:** users
     - **Columns:**
     - id (INT, AUTO_INCREMENT, PRIMARY KEY)
     - username (VARCHAR)
     - title (VARCHAR)
     - photo (VARCHAR)
     - password (VARCHAR)
     - confirm_password (VARCHAR)
     - gender (VARCHAR)
     - category (VARCHAR)
     - address (VARCHAR)
     - contact (VARCHAR)
     - dob (DATE)
     - zip (VARCHAR)
     - city (VARCHAR)
     - department (VARCHAR)
     - year (INT)
     - rollno (VARCHAR)
     - father_name (VARCHAR)
     - surname (VARCHAR)
     - email (VARCHAR)
     - hobbies (TEXT)
     - special_interest (TEXT)
     - blood_group (VARCHAR)
     - height (VARCHAR)
     - voter (BOOLEAN)
     - voter_id (VARCHAR)
     - worked_in_nss (BOOLEAN)
     - toilet_attached (BOOLEAN)
     - parent_name (VARCHAR)
     - office_address (VARCHAR)
     - mother_name (VARCHAR)
     - parent_contact (VARCHAR)
     - relationship (VARCHAR)
     - profession (VARCHAR)
     - student_email (VARCHAR)

   #### SQL Query to Create (using XAMPP):
   
   ```sql
   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(255),
     title VARCHAR(255),
     photo VARCHAR(255),
     password VARCHAR(255),
     confirm_password VARCHAR(255),
     gender VARCHAR(255),
     category VARCHAR(255),
     address VARCHAR(255),
     contact VARCHAR(255),
     dob DATE,
     zip VARCHAR(255),
     city VARCHAR(255),
     department VARCHAR(255),
     year INT,
     rollno VARCHAR(255),
     father_name VARCHAR(255),
     surname VARCHAR(255),
     email VARCHAR(255),
     hobbies TEXT,
     special_interest TEXT,
     blood_group VARCHAR(255),
     height VARCHAR(255),
     voter BOOLEAN,
     voter_id VARCHAR(255),
     worked_in_nss BOOLEAN,
     toilet_attached BOOLEAN,
     parent_name VARCHAR(255),
     office_address VARCHAR(255),
     mother_name VARCHAR(255),
     parent_contact VARCHAR(255),
     relationship VARCHAR(255),
     profession VARCHAR(255),
     student_email VARCHAR(255)
   );
     -#### Table: content_text

- **Columns:**
  - id (INT, AUTO_INCREMENT, PRIMARY KEY)
  - scrolling_text (TEXT)
  - news (TEXT)
  - notification (TEXT)

#### SQL Query to Create (using XAMPP):

```sql
CREATE TABLE content_text (
  id INT AUTO_INCREMENT PRIMARY KEY,
  scrolling_text TEXT,
  news TEXT,
  notification TEXT
);


2. Ensure the column names and database credentials match your configuration.

## 🚀 Usage

To begin using the NSS platform, follow these steps:

1. Cloning the Repository
Clone the NSS project repository to your local machine using the following command:

2. Running the Application
Open a web browser and navigate to the project directory.
Start the XAMPP Apache server.
Access the NSS platform by typing http://localhost/Project-1-Nss in your browser's address bar.
You'll be directed to the NSS platform's homepage, where you can begin exploring its features.
3. Logging In or Registering
If you're a new user, click on the registration/sign-up link and fill in the required details to create an account.
If you already have an account, use your credentials to log in.
4. Exploring the Platform
Once logged in, navigate through the various sections:

Access the application submission feature.
Visit the student portal to edit details and view news or notifications.
For admins, manage users, generate reports, and handle important announcements.
