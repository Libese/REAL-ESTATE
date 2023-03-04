<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $keyword = $_POST['keyword'];
  $type = $_POST['type'];
  $city = $_POST['city'];
  $bedrooms = $_POST['bedrooms'];
  $garages = $_POST['garages'];
  $bathrooms = $_POST['bathrooms'];
  $price = $_POST['price'];

  // Construct search query
  $query = "SELECT * FROM properties WHERE 1=1";

  if (!empty($keyword)) {
    $query .= " AND (property_name LIKE '%$keyword%' OR property_description LIKE '%$keyword%')";
  }

  if ($type !== 'All Type') {
    $query .= " AND property_type = '$type'";
  }

  if ($city !== 'All City') {
    $query .= " AND property_city = '$city'";
  }

  if ($bedrooms !== 'Any') {
    $query .= " AND property_bedrooms = '$bedrooms'";
  }

  if ($garages !== 'Any') {
    $query .= " AND property_garages = '$garages'";
  }

  if ($bathrooms !== 'Any') {
    $query .= " AND property_bathrooms = '$bathrooms'";
  }

  if ($price !== 'Unlimite') {
    $query .= " AND property_price >= '".str_replace(',', '', substr($price, 3))."'";
  }

  // Execute search query
  $result = mysqli_query($conn, $query);

  // Display search results
  while ($row = mysqli_fetch_assoc($result)) {
    echo $row['property_name']."<br>";
    echo $row['property_description']."<br>";
    echo $row['property_type']."<br>";
    echo $row['property_city']."<br>";
    echo $row['property_bedrooms']."<br>";
    echo $row['property_garages']."<br>";
    echo $row['property_bathrooms']."<br>";
    echo $row['property_price']."<br>";
  }
}
?>
