<?php
// Establish database connection
$servername = "localhost"; // Assuming MySQL is running locally
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password, if any
$database = "hall_booking"; // Your database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$eventDate = $_POST['eventdate'];
$timing = $_POST['timing'];

// Example database query to check if any halls are available for the selected date and timing
$query = "SELECT * FROM hall WHERE eventDate = '$eventDate' AND timing = '$timing'";
$result = mysqli_query($connection, $query);

// Check if any halls are available for the selected date and timing
if (mysqli_num_rows($result) > 0) {
    // Display available halls
    echo "<h2>Available Halls</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row['hall_name'] . "</li>";
    }
    echo "</ul>";
} else {
    // If no halls are available for the selected date and timing, fetch all hall names from the database
    $queryAllHalls = "SELECT DISTINCT hall_name FROM hall";
    $resultAllHalls = mysqli_query($connection, $queryAllHalls);

    // Display dropdown list for user selection
  
    echo "<p>Please select from the following halls:</p>";
    echo '<form action="availability.php" method="POST">';
   
    echo '<select name="selected_hall">';
    while ($row = mysqli_fetch_assoc($resultAllHalls)) {
        echo '<option value="' . $row['hall_name'] . '">' . $row['hall_name'] . '</option>';
    }
    echo '</select>';
    echo '<button type="submit">Book Selected Hall</button>';
    echo '</form>';
}

// Close database connection
mysqli_close($connection);
?>

