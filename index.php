<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <div class="container">
        <h1>Form</h1>
        <form id="contactForm" class="contact-form" action="submit.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <button type="submit">Submit</button>
        </form>

        <h2>Contacts</h2>
        <table id="contactsTable" border="1">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- This tbody will initially be empty and populated dynamically -->
            </tbody>
        </table>
    </div>

    <script>
        // Function to handle form submission
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            // Get form data
            var formData = new FormData(this);
            
            // Perform AJAX request to submit form data to the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', this.getAttribute('action'), true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // If the request is successful, parse the response JSON and update the table
                    var responseData = JSON.parse(xhr.responseText);
                    var newRow = document.createElement('tr');
                    var table = document.getElementById('contactsTable');
                    var rowCount = table.rows.length;
                    newRow.innerHTML = '<td>' + rowCount + '</td><td>' + responseData.name + '</td><td>' + responseData.email + '</td><td><button class="edit-btn">Edit</button><button class="delete-btn">Delete</button></td>';
                    document.querySelector('#contactsTable tbody').appendChild(newRow);
                    
                    // Clear the form fields after submission
                    document.getElementById('name').value = '';
                    document.getElementById('email').value = '';

                    // Add event listeners for edit and delete buttons in the new row
                    newRow.querySelector('.edit-btn').addEventListener('click', function() {
                        document.getElementById('name').value = responseData.name;
                        document.getElementById('email').value = responseData.email;
                        newRow.remove(); // Remove the row from the table after editing
                    });

                    newRow.querySelector('.delete-btn').addEventListener('click', function() {
                        newRow.remove(); // Remove the row from the table
                    });
                }
            };
            xhr.send(new URLSearchParams(formData));
        });
    </script>

</body>
</html>
