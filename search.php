<?php
$servername = "localhost";
$username = "id21021362_root";
$password = "Admin@1234";
$dbname = "id21021362_doctordatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get user input from the search form
$city = $_GET['city'];
$specialty = $_GET['specialty'];

// Prepare the SQL query based on the user input
$sql = "SELECT * FROM doctors WHERE location LIKE '%$city%'";

if (!empty($specialty)) {
  $sql .= " AND specialty = '$specialty'";
}

// Execute the query
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Doctor 334Searching Results</title>
</head>
<body>
  <h1>Doctor Searching Results</h1>
  <p>Search Location: <?php echo $city; ?></p>
  <p>Filter Specialty: <?php echo $specialty ?: 'All'; ?></p>
  
  <table>
    <tr>
      <th>Name</th>
      <th>Specialty</th>
      <th>Contact</th>
      <th>address</th>
      <th>city</th>
      <th>Experience</th>
      <th>Rating</th>
      <th>Image</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
      <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['specialty']; ?></td>
        <td><?php echo $row['contact']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['city']; ?></td>
        <td><?php echo $row['experience']; ?></td>
        <td><?php echo $row['rating']; ?></td>
        <td><img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" height="100"></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
