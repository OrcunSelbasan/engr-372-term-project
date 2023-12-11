<?php
    include("../controller/ControllerAuth.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $auth->checkAuth();
?>

  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script src="../jquery/jquery-3.7.1.js"></script>
     
    <title>Region Management</title>
    <!--
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px;
        }

        nav {
            margin-top: 10px;
        }

            nav ul {
                list-style-type: none;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }

            nav li {
                float: left;
            }

                nav li a {
                    display: block;
                    color: white;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                }

                    nav li a:hover {
                        background-color: #ddd;
                        color: black;
                    }

        main {
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        section {
            margin-top: 20px;
        }
    </style>
    -->
      <link rel="stylesheet" href="../css/index.css">
</head>
<body>
 <?php include("./header.php"); ?>

    <header>
        <h1>Region Management</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#home" onclick="showPage('home')">Home</a></li>
            <li><a href="#create" onclick="showPage('create')">Create Region</a></li>
            <li><a href="#update" onclick="showPage('update')">Update Region</a></li>
            <li><a href="#review" onclick="showPage('review')">Review Region</a></li>
        </ul>
    </nav>

    <main>
        <!-- Home Page Content -->
        <div id="home">
            <p>Welcome to the Region Management System!</p>
        </div>

        <!-- Create Region Page Content -->
        <div id="create" style="display: none;">
            <form id="regionForm" onsubmit="return false;">
                <label for="regionName">Region Name:</label>
                <input type="text" id="regionName" name="regionName" required>

                <!-- Add more form fields as needed -->

                <button type="button" onclick="submitForm('create')">Create Region</button>
            </form>
        </div>

        <!-- Update Region Page Content -->
        <div id="update" style="display: none;">
            <!-- Similar structure to the create page, with form fields for updating a region -->
        </div>

        <!-- Review Page Content -->
        <div id="review" style="display: none;">
            <!-- Similar structure to the create page, with a section for reviewing region details -->
        </div>
    </main>

    <script>// JavaScript functions to show/hide pages
    function showPage(pageId) {
      // Hide all pages
      const pages = ['home', 'create', 'update', 'review'];
      pages.forEach(page => {
        const element = document.getElementById(page);
        if (element) {
          element.style.display = 'none';
        }
      });

      // Show the selected page
      const selectedPage = document.getElementById(pageId);
      if (selectedPage) {
        selectedPage.style.display = 'block';
      }
    }

    // JavaScript function to handle form submission
    function submitForm(action) {
      // Collect form data based on the action (create, update, etc.)
      if (action === 'create') {
        const regionName = document.getElementById('regionName').value;
        // Collect other form data as needed for creation
        console.log('Creating Region:', regionName);
        // Perform further actions (e.g., send data to server, update database)
        // Reset form (optional)
        document.getElementById('regionForm').reset();
      }
      // Add similar logic for other actions (update, review, etc.)
    }</script>

</body>
</html>