
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['IDnumber'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
         $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
        $IDnumber = isset($_POST['IDnumber']) && !empty($_POST['IDnumber']) && $_POST['IDnumber'] != 'auto' ? $_POST['IDnumber'] : NULL;
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : date('Y-m-d H:i:s');
        $course = isset($_POST['course']) ? $_POST['course'] : '';
        $econtactname = isset($_POST['econtactname']) ? $_POST['econtactname'] : '';
        $econtactnum = isset($_POST['econtactnum']) ? $_POST['econtactnum'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE records SET lastname = ?, firstname = ?, middlename = ?, IDnumber = ?, address = ?, birthdate = ?, course = ?, $econtactname = ?, $econtactnum = ? WHERE IDnumber = ?');
        $stmt->execute([$lastname, $firstname, $middlename, $IDnumber, $address, $birthdate, $course, $econtactname, $econtactnum, $_GET['IDnumber']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM records WHERE IDnumber = ?');
    $stmt->execute([$_GET['IDnumber']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
    <h2>Update Contact #<?=$contact['IDnumber']?></h2>
    <form action="update.php?IDnumber=<?=$contact['IDnumber']?>" method="post">
        
        <label for="lastname">Last name:</label> <br>
        <input type="text" name="lastname" placeholder="Dela Cruz" value="<?=$contact['lastname']?>" IDnumber="lastname">

        <label for="firstname">First name:</label> <br>
        <input type="text" name="firstname" placeholder="Juan" value="<?=$contact['firstname']?>" IDnumber="firstname">

        <label for="lastname">Middle name:</label> <br>
        <input type="text" name="middlename" placeholder="Rizal" value="<?=$contact['middlename']?>" IDnumber="middlename">

        <label for="IDnumber">ID number:</label> <br>
        <input type="number" name="IDnumber" placeholder="XXXXXXXXX" value="<?=$contact['IDnumber']?>" IDnumber="IDnumber">

        <label for="address">Address:</label> <br>
        <input type="text" name="address" placeholder="House Number, Street, Purok, Barangay, Municipality" value="<?=$contact['address']?>" IDnumber="address">

        <label for="birthdate">Birthdate:</label> <br>
        <input type="date" name="birthdate" value="<?=$contact['birthdate']?>" IDnumber="birthdate">

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
        <input type="text" name="econtactname" placeholder="Parent or Legal Guardian" value="<?=$contact['econtactname']?>" IDnumber="econtactname">

        <label for="econtactnum">Emergency Contact Number:</label> <br>
        <input type="number" name="econtactnum" placeholder="09XXXXXXXXXX" value="<?=$contact['econtactnum']?>" IDnumber="econtactnum">

 
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>