<?php
//defining the database variables
$hostname = "localhost";
$db_username = "root";
$db_password = "sugam@123";
$db_name = "farmer_profiles";

$conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);
$query = "SELECT *
FROM profile
INNER JOIN contact_info ON profile.id = contact_info.id;";
$result = mysqli_query($conn,$query);
//$result1 = mysqli_query($conn,$query1);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
//$contact = mysqli_fetch_all($result1,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer's Database</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

  
</head>
<body class="container">
    <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Farmer's Database</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>
</nav>
    
<!-- MENU -->
<div class="container2"> 
<div class="container-sidebar">
  <div class="menu-box">
    <h6>MENU</h6>
    <ul>
      <li><a href="">Profile</a></li>
      <li><a href="">Transaction</a></li>
      <li><a href="">Report</a></li>
      <li><a href="">Configuration</a></li>
    </ul>
  </div>
</div>

<main class="main-content">
      <div class="profile-section">
        <h6>Profile Data</h6>
        <form class="insert-data-form" action="./insert_details.php">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
  </div>
  <div class="form-group">
    <label for="phone">Phone No:</label>
    <input type="text" id="phone" name="phone" required>
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="state">State:</label>
    <input type="text" id="state" name="state" required>
  </div>
  <div class="form-group">
    <label for="district">District:</label>
    <input type="text" id="district" name="district" required>
  </div>
  <div class="form-group">
    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>
  </div>
  <div class="form-group">
    <label for="document">Document Upload:</label>
    <input type="file" id="document" name="document" accept=".pdf, .doc, .docx, .jpg, .png">
  </div>
  <button type="submit" class="btn-primary">Insert Data</button>
</form>

        <table class="data-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>State</th>
              <th>District</th>
              <th>City</th>
              <th>Documents</th>
            </tr>
          </thead>
          <tbody>
            <!-- Table rows will be inserted here -->

              <?php foreach($rows as $data):?>
                <tr>
              <td><?= $data['name']?></td>
              <td><?= $data['email']?></td>
              <td><?= $data['phone_number']?></td>
              <td><?= $data['state']?></td>
              <td><?= $data['district']?></td>
              <td><?= $data['city']?></td>
              <td><?= $data['document']?></td>


              </tr>
              <?php endforeach?>

             
          </tbody>
        </table>
      </div>
    </main> 
    </div>
    

</body>
</html>