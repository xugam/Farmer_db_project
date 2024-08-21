<?php
//defining the database variables
$hostname = "localhost";
$db_username = "root";
$db_password = "sugam@123";
$db_name = "farmer_profiles";

// for connection establishment
$conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

//for profile table
$query = "SELECT *
FROM profile
INNER JOIN contact_info ON profile.id = contact_info.id;";
$result = mysqli_query($conn,$query);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

//for transactions table
$query_transactions = "SELECT * FROM transactions;";
$result1 = mysqli_query($conn,$query_transactions);
$transactions = mysqli_fetch_all($result1,MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer's Database</title>

  <!-- Sort Link -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- Sort Link End -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>


<script>
function toggleForm(formId, buttonId) {
    var form = document.getElementById(formId);
    var button = document.getElementById(buttonId);
    if (form.style.display === 'none') {
        form.style.display = 'block';
        button.textContent = 'Hide Form';
    } else {
        form.style.display = 'none';
        button.textContent = 'Insert Data';
    }
}
document.querySelectorAll(".insertButton").forEach(button => {
  button.addEventListener("click", function() {
    const formId = this.getAttribute("data-form");
    document.getElementById(formId).style.display = "block";
  });
});

document.getElementById("transactionInsertButton").addEventListener("click", function() {
  document.getElementById("transactionForm").style.display = "block";
});
</script>

</head>
<body class="container">
    <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Farmer's Database</a>
  
    <div class="d-flex-navi">
      <!-- Settings -->
      <a href="#" class="nav-link" id="nav-settings-link">
        <i class="fas fa-cog"></i> </a>
      <!-- User Profile -->
      <a href="#" class="nav-link" id="nav-profile-link">
        <i class="fas fa-user-circle"></i></a>
        <a href="/logout" class="nav-link" id="nav-out-link">
        <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
    </div>
</nav>
    
<!-- MENU -->
<div class="container2"> 
<div class="container-sidebar">
  <div class="menu-box">
    <h6><i class="fas fa-bars"></i>MENU</h6>
    <ul>
      <li id="menu-profile"><a href="#" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a></li>
      <li id="menu-transaction"><a href="#" onclick="showSection('transaction')"> <i class="fas fa-exchange-alt"></i>Transaction</a></li>
      <li id="menu-report"><a href="#" onclick="showSection('report')"><i class="fas fa-file-alt"></i>Report</a></li>
      <li id="menu-configuration"><a href="#" onclick="showSection('configuration')"> <i class="fas fa-cog"></i>Configuration</a></li>
    </ul>
    <div id="indicator"></div>
  </div>
</div>

<main class="main-content">
      <div id="profile" class="section">
        <h6>Profile Data</h6>

        <!-- Insert data into profile -->
        <button id="toggleButtonProfile" class="btn-primary mb-3" onclick="toggleForm('insertForm', 'toggleButtonProfile')">Insert Data</button>
        <form id="insertForm" class="insert-data-form" action="./insert_details.php" style="display:none;">
                  <div class="form-fields-container">
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
    <select id="state" name="state" required onchange="updateDistricts()">
    <option value="">Select State</option>
    <option value="Koshi">Koshi</option>
    <option value="Madesh">Madesh</option>
    <option value="Bagmati">Bagmati</option>
    <option value="Gandaki">Gandaki</option>
    <option value="Lumbini">Lumbini</option>
    <option value="Karnali">Karnali</option>
    <option value="Sudurpashchim">Sudurpashchim</option>
    </select>
  </div>
  <div class="form-group">
    <label for="district">District:</label>
    <select id="district" name="district" required>
        <option value="">Select District</option>
    </select>
  </div>
  <div class="form-group">
    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>
  </div>
  <div class="form-group">
    <label for="document">Document Upload:</label>
    <input type="file" id="document" name="document" accept=".pdf, .doc, .docx, .jpg, .png">
  </div>
  </div>
  <button type="submit" class="btn-primary2" onclick="insertAlert()">Submit</button>
</form>

<!-- Delete Button -->
<form method="post" action="delete_selected.php">
  <div class="delete-button-container">
      <button type="submit" name="delete" class="btn-delete" onclick="deleteAlert()">Delete Selected</button>
      </div>

<!-- profile data table -->
        <table id="profile-table" class="data-table">
          <thead>
            <tr>
            <th>Select  </th>
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
              <td><input type="checkbox" name="select[]" value="<?= $data['id']?>"></td>
              <td><?= $data['name']?></td>
              <td><?= $data['email']?></td>
              <td><?= $data['phone_number']?></td>
              <td><?= $data['state']?></td>
              <td><?= $data['district']?></td>
              <td><?= $data['city']?></td>
              <td><?= $data['document_name']?></td>
              </tr>
              <?php endforeach?>

             
          </tbody>
        </table>
        </form>
</div>



<!-- Transaction -->
<div id="transaction" class="section" style="display: none;">
    <h6>Transaction Data</h6>

    <!-- Insert data into transaction -->
    <button id="toggleButtonTransaction" class="btn-primary mb-3" onclick="toggleForm('transactionForm', 'toggleButtonTransaction')">Insert Data</button>
    <form id="transactionForm" class="insert-data-form" action="insert_transaction.php"  style="display:none;">
        <div class="form-fields-container" id="form-transaction">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="inflow">Inflow:</label>
                <input type="text" id="inflow" name="inflow" required>
            </div>
            <div class="form-group">
                <label for="expenditure">Expenditure:</label>
                <input type="text" id="expenditure" name="expenditure" required>
            </div>
            <div class="form-group">
                <label for="balance">Balance:</label>
                <input type="text" id="balance" name="balance" required>
            </div>
        </div>
        <button id="transactionInsertButton" type="submit" class="btn-primary2" onclick="insertAlert()">Submit</button>
    </form>

               <!-- Delete Button -->
<form method="post" action="delete_selected_transactions.php">
  <div class="delete-button-container">
      <button type="submit" name="delete" class="btn-delete" onclick="deleteAlert()">Delete Selected</button>
      </div>

            <table id="transaction-table" class="data-table" >
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Transaction ID</th>
                        <th>Email</th>
                        <th>Date & Time</th>
                        <th>Inflow</th>
                        <th>Expenditure</th>
                        <th>Balance</th> 
                    </tr>
                </thead>
                <tbody>
                    <!-- Example rows -->
                    <?php foreach($transactions as $data):?>
                    <tr>
                        <td><input type="checkbox" name="select[]" value="<?= $data['t_id']?>"></td>
                        <td><?= $data['t_id']?></td>
                        <td><?= $data['email']?></td>
                        <td><?= $data['created_at']?></td>
                        <td><?= $data['inflow']?></td>
                        <td><?= $data['expenditure']?></td>
                        <td><?= $data['remaining_blc']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
      </div>
    </main> 
</body>
</html>

<!-- Sort Operation -->
 <script>
$(document).ready( function () {
    $('#transaction-table').DataTable({
        "order": [[ 1, "desc" ]] // Sort by the second column (Date Inserted) in descending order
    });
    $('#profile-table').DataTable({
        "order": [[ 1, "desc" ]] // Sort by the second column (Date Inserted) in descending order
    });
});
</script>


<script>
    const districtsByState = {
        "Koshi": ["Bhojpur", "Dhankuta", "Illam", "Jhapa", "Khotang", "Morang", "Okhaldhunga", "Pachthar", "Sankhuwasabha", 
        "Solukhumbu", "Sunsari", "Taplejung", "Terathum", "Udayapur"],
        "Madesh": ["Saptari", "Siraha", "Dhanusha", "Mahottari", "Sarlahi", "Bara", "Parsa", "Rautahat"],
        "Bagmati": ["Sindhuli", "Ramechhap", "Dolakha", "Bhaktapur", "Dhading", "Kathmandu", "Kavrepalanchowk", "Lalitpur", 
        "Nuwakot", "Rasuwa", "Sindhupalchok", "Chitwan", "Makwanpur"],
        "Gandaki": ["Baglung", "Gorkha", "Kaski", "Lamjung", "Manang", "Mustang", "Myagdi", "Nawalpur", "Parbat", 
        "Syangja", "Tanahun"],
        "Lumbini": ["Kapilvastu", "Parasi", "Rupandehi", "Arghakhanchi", "Gulmi", "Palpa", "Dang", "Pyuthan", "Rolpa", 
        "Eastern Rukum", "Banke", "Bardiya"],
        "Karnali": ["Western Rukum", "Salyan", "Dolpa", "Humla", "Jumla", "Kalikot", "Mugu", "Surkhet", "Dailekh", "Jajarkot"],
        "Sudurpashchim": ["Kailali", "Achham", "Doti", "Bajhang", "Bajura", "Kanchanpur", "Dadeldhura", "Baitadi", "Darchula"]
    };

    function updateDistricts() {
        const stateSelect = document.getElementById('state');
        const districtSelect = document.getElementById('district');
        const selectedState = stateSelect.value;

        // Clear current district options
        districtSelect.innerHTML = '<option value="">Select District</option>';

        // Populate districts based on selected state
        if (districtsByState[selectedState]) {
            districtsByState[selectedState].forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    }
</script>


<!-- Menu Swap Js -->

<script>
  //send alert msg
  function insertAlert(){
    alert("Successfully Inserted");
  }
  function deleteAlert(){
    alert("Successfully Deleted");
  }
        function showSection(sectionId) {
            // Get all section elements
            const sections = document.querySelectorAll('.section');
            
            // Hide all sections
            sections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }
    </script>



<!-- Menu Line Highlight script -->
<script>
function showSection(sectionId) {
  // Get all section elements
  const sections = document.querySelectorAll('.section');
  
  // Hide all sections
  sections.forEach(section => {
    section.style.display = 'none';
  });
  
  // Show the selected section
  const selectedSection = document.getElementById(sectionId);
  if (selectedSection) {
    selectedSection.style.display = 'block';
  }

  // Move the indicator
  const menuItems = document.querySelectorAll('.menu-box ul li');
  let topPosition = 0;
  menuItems.forEach(item => {
    if (item.querySelector('a').getAttribute('onclick') === `showSection('${sectionId}')`) {
      topPosition = item.offsetTop;
    }
  });

  const indicator = document.getElementById('indicator');
  indicator.style.top = `${topPosition}px`;
}

</script>