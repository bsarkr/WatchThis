# WatchThis

By Bilash Sarkar

WatchThis is a full-stack web application that helps users find out where to watch any movie or TV show. Inspired by the design and simplicity of Netflix, this site allows users to search titles, browse by genre or popularity, and explore detailed info about their favorite content.

This project was built for the final assignment in Internet and Web Design (CISC 3300) and incorporates everything learned throughout the course—from frontend HTML/CSS and JavaScript to backend PHP/MySQL—all wrapped in an MVC architecture.

The goal of WatchThis is to create a modern, professional-level movie streaming guide with:
- A clean, engaging frontend inspired by Netflix
- Dynamic interaction using AJAX and PHP APIs
- A scalable MVC backend with user authentication and a MySQL database
- Real-world features like user reviews, personalized content, and friend functionality

  

Technologies Used

Frontend:
- HTML, CSS, JavaScript
- jQuery for AJAX calls
- Responsive styling (custom layout)

Backend:
- PHP (with MVC structure)
- RESTful routing
- MySQL (hosted on XAMPP)
- External movie data fetched using a third-party API

Tools:
- Visual Studio Code
- GitHub for version control
- Postman for API testing
- XAMPP for local server/database



Setup & Installation
1. Clone the Repo: git clone https://github.com/yourusername/WatchThis.git
2. Start your server:
    - Launch XAMPP (or MAMP), and start Apache and MySQL.
3. Database setup:
    - Import the included .sql file into phpMyAdmin to create the necessary tables.
    - Make sure your config.php includes the correct database credentials.
4. Run the site: 
    - Visit http://localhost/WatchThis in your browser.
  



How to Use

Search:
- Search for any movie or TV show using the top search bar.

Browse:
- Explore trending content, top-rated shows, or filter by genres like Action, Comedy, or Drama.

Movie Detail Page:
- Each result includes:
	•	Title, poster, overview
	•	Cast, director
	•	Runtime, trailer
	•	Genre tags

Submit Reviews:
- Users can leave general public feedback on the site (anonymous or logged in).




Key Learnings & Challenges

This project pushed me to master the full stack—bringing together the frontend, backend, and database while keeping things modular and clean with an MVC structure. A major challenge was handling real-time search with AJAX and dynamically rendering results without a full page reload. Another hurdle was implementing secure login and data validation in PHP to protect the database.

Through building WatchThis, I learned how to:
	•	Use APIs effectively with AJAX
	•	Structure a scalable MVC backend
	•	Validate and sanitize user input securely
	•	Debug across the full stack



Roadmap & Future Features

These features are planned for future versions:
	•	Logged-in homepage with personalized recommendations
	•	Watch Later lists (solo and shared with friends)
	•	Friend system: add/remove/message users
	•	Real-time notifications
	•	Full user profiles with history and preferences
