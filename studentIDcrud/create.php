<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
   
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $IDnumber = isset($_POST['IDnumber']) && !empty($_POST['IDnumber']) && $_POST['IDnumber'] != 'auto' ? $_POST['IDnumber'] : NULL;
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : date('Y-m-d H:i:s');
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $econtactname = isset($_POST['econtactname']) ? $_POST['econtactname'] : '';
    $econtactnum = isset($_POST['econtactnum']) ? $_POST['econtactnum'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO records VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$lastname, $firstname, $middlename, $IDnumber, $address, $birthdate, $course, $econtactname, $econtactnum]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="lastname">Last name:</label> <br>
        <input type="text" id="lastname" name="lastname" placeholder=Dela Cruz"> <br>
        <label for="firstname">First name:</label> <br>
        <input type="text" id="firstname" name="firstname" placeholder="Juan"> <br>
        <label for="middlename">Middle name:</label> <br>
        <input type="text" id="middlename" name="middlename" placeholder="Rizal"> <br>

        <label for="IDnumber">ID number:</label><br>
        <input type="number" name="IDnumber" placeholder="XXXXXXXXX" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==9) return false;"> <br>

        <label for="address">Address</label> <br>
        <input type="text" name="address" placeholder="House Number, Street, Purok, Barangay, Municipality"> <br>

        <label for="birthdate">Birthdate</label> <br>
        <input type="date" name="birthdate"> <br>

        <label for="course">Course</label><br>
        <select id="course">

            <!--CJE-->
            <option>Bachelor of Science in Criminology</option>
            <option>Bachelor of Forensic Science</option>
            <option>Bachelor of Science in Industrial Security Management</option>

            <!--ICT-->
            <option>Associate in Computer Technology (ACT)</option>
            <option>Bachelor of Science in Information Technology (BSIT)</option>
            <option>Bachelor of Science in Computer Science (BSCS) </option>
            <option>Bachelor of Science in Data Analystics (BSDA) </option>
            <option>Bachelor of Libray and Information Science (BLIS)</option>
        
            <!--TE-->
            <option>Bachelor of Early Childhood Education (BECED)</option>
            <option>Bachelor of Elementary Education</option>
            <option>Bachelor of Special Needs Education</option>
            <option>Bachelor of Physical Education</option>
            <option>Bachelor of Secondary Education</option>
            <option>Certificate for Professional Education Completers (CPEC)</option>

            <!--CAS-->
            <option>Bachelor of Arts in English Language Studies</option>
            <option>Bachelor of Arts in Communication</option>
            <option>Bachelor of Arts in Political Science</option>
            <option>Bachelor of Arts in Behavioral Science</option>
            <option>Bachelor of Science in Psychology</option>
            <option>Bachelor of Science in Biology</option>

            <!--BA-->
            <option>Bachelor of Science in Business Administration</option>
            <option>Bachelor of Science in Entrepreneurship</option>

            <!--CEA-->
            <option>Bachelor in Fine Arts</option>
            <option>Bachelor of Science in Architecture</option>
            <option>Bachelor of Science in Civil Engineering</option>
            <option>Bachelor of Science in Computer Engineering</option>
            <option>Bachelor of Science in Electronics Engineering</option>
            <option>Bachelor of Science in Environmental and Sanitary Engineering</option>
            <option>Bachelor of Science in Environmental Planning</option>
            <option>Bachelor of Science in Mechatronics Engineering Major in Robotics </option> 

            <!--CHTM-->
            <option>Bachelor of Science in Hospitality Management</option>
            <option>Bachelor of Science in Tourism Management</option>

            <!--CON-->
            <option>Bachelor of Science in Nursing</option>

        </select> <br>

        <label for="econtactname">Emergency Contact Name:</label> <br>
        <input type="text" id="econtactname" name="econtactname" placeholder="Parent or Legal Guardian"> <br>

        <label for="econtactname">Emergency Contact Number:</label> <br>
        <input type="number" id="econtactnum" placeholder="09XXXXXXXXX" name="econtactnum" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;">
        <!--submit button-->
        <input type="submit" value="Register">
        <input type="reset" name="Reset">

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>