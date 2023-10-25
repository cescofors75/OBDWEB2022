# OBD2SOLUTION Web Interface 

This repository contains the web interface for OBD2SOLUTION, a platform for searching product references related to OBD2. Users can interactively search for product references and view results directly on the webpage.

## Features 

- **Language Selection:** Supports multiple languages including English, French, German, and Spanish.
- **Reference Search:** Allows users to search for product references using a reference number.
- **Interactive UI:** Features hexagon-shaped UI elements for an engaging visual experience.
- **Database Interaction:** The backend communicates with a MySQL database to retrieve product reference details.

## Installation & Setup 

1. Clone the repository:
    ```bash
    git clone [repository-link]
    ```
2. Set up a MySQL server, ensuring the database schema aligns with what's anticipated by the PHP code.
3. Update the MySQL connection specifics within the PHP code.
4. Host the webpage on a web server that supports PHP.

## Usage 

- Navigate to the hosted webpage.
- Utilize the language flags to toggle between available languages.
- Input the product reference into the provided field and hit the search button to view results.
- Observe product details and other pertinent data displayed on the site.

## Dependencies 

- **Bootstrap:** Enables responsive design and UI elements.
- **jQuery:** Used for DOM operations and AJAX calls.
- **PHP:** Handles server-side scripting.
- **MySQL:** Manages the storage and fetching of product references.

## Contributing 

Pull requests are welcomed. For significant modifications, kindly open an issue beforehand to discuss your proposed changes.

## License 

MIT

