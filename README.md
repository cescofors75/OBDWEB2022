OBD2SOLUTION Web Interface
This repository contains the web interface for OBD2SOLUTION, a platform for searching product references related to OBD2. Users can interactively search for product references and view results directly on the webpage.

Features
Language Selection: The interface supports multiple languages including English, French, German, and Spanish.
Reference Search: Allows users to search for product references using a reference number.
Interactive UI: Uses hexagon-shaped UI elements for a visually appealing experience.
Database Interaction: The backend interacts with a MySQL database to fetch product reference information.
Installation & Setup
Clone the repository:

bash
Copy code
git clone [repository-link]
Set up a MySQL server and ensure the database schema matches what's expected by the PHP code.

Update the MySQL connection details in the PHP code.

Host the webpage on a web server with PHP support.

Usage
Navigate to the hosted webpage.
Use the language flags to switch between supported languages.
Enter the product reference in the input field and click the search button to view results.
View product details and other relevant information displayed on the page.
Dependencies
Bootstrap: For responsive design and UI components.
jQuery: For DOM manipulation and AJAX requests.
PHP: For server-side scripting.
MySQL: For storing and retrieving product references.
Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

License
MIT
