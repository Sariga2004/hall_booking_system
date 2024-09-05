<?php
// Establish database connection
$servername = "localhost"; // Assuming MySQL is running locally
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password, if any
$database = "booking"; // Your database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve selected hall from the form
$selectedHall = $_POST['selected_hall'];
$eventDate = $_POST['eventDate']; // Assuming you need the event date for booking
$timing = $_POST['timing']; // Assuming you need the timing for booking

// Insert booking details into the database
$query = "INSERT INTO hall (hall_name, eventDate, timing) VALUES ('$selectedHall', '$eventDate', '$timing')";

if (mysqli_query($connection, $query)) {
    echo "Booking successful. You have booked $selectedHall for $eventDate ($timing).";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}

// Close database connection
mysqli_close($connection);
?>
