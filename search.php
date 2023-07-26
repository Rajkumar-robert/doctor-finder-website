<?php
$servername = "localhost";
$username = "root";
$password = "";
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
$sql = "SELECT * FROM doctors WHERE city LIKE '%$city%'";


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
  <title>Doctor Seagfgjrching Results</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

</head>
<body class="body2">
  <div class="head">
  <h1>Doctor Searching Results</h1>
  <button class="home-button" ><a href="index.html" >HOME</a></button>
  </div>
  <div Class="filter">
    <p>Search Location: <?php echo $city; ?></p>
  <p>Filter Specialty: <?php echo $specialty ?: 'All'; ?></p>
  </div>
  <div class="results-grid">
  <?php if ($result->num_rows > 0) : ?>
      <?php while ($row = $result->fetch_assoc()) : ?>
       
        <div class="record-container">
          <div id="profile-pic">
        <img src="<?php echo $row['image']; ?>" alt=""  id="profile-pic">
        
          </div>
          <div class="doc-details">
              <div id="doc-name"> <?php echo $row['name']; ?></div>  
              <div id="speciality"><?php echo $row['specialty']; ?></div>              
              <div id="contact"><?php echo $row['contact']; ?></div>
              <div id="address"><?php echo $row['address']; ?>,<?php echo $row['city']; ?></div>
              <div id="exp">Experience <?php echo $row['experience']; ?></div>
              <div class="star-rating">
      <?php
        $rating = min($row['rating'], 5);
        $fullStars = floor($rating);
        $hasHalfStar = ($rating - $fullStars) >= 0.5;
        for ($i = 1; $i <= $fullStars; $i++) {
          echo '<span style="font-size:150%;color:rgb(235, 255, 0);">&starf;</span>';
        }
        for ($i = $fullStars + ($hasHalfStar ? 1 : 1); $i <= 5; $i++) {
          echo '<span style="font-size:150%;color:rgb(235, 255, 0);">&star;</span>';
        }
      ?>
    </div>
    <button class="call">Call</button>
          </div>
        </div>
      <?php endwhile; ?>
  <?php else : ?>
    <div class="nf">Not found!</div>
  <?php endif; ?>
  </div>
</body>
</html>
