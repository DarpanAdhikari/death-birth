<?php
session_start();
include "connection.php";
if ((!isset($_GET['export']) || $_GET['export'] === "")) {
    header('Location: index.php');
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/nepal-flag.gif" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Death Registration Certificate</title>
</head>

<body class="bg-gray-100 pt-4">
    <?php
    $id = $_GET['export'];
    $u_id = $_SESSION['logged_In'];
    $select = mysqli_query($con, "SELECT users.*, death_register.*, users.name AS user_name, approved_users.name AS approved_by_name 
    FROM death_register 
    JOIN users ON death_register.user = users.id 
    JOIN users AS approved_users ON death_register.approved_by = approved_users.id 
    WHERE death_register.id = '$id' AND death_register.user = '$u_id'");
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        if($row['approve_state'] !== '1'){
            $_SESSION['error'] = "The death registration of ".$row['name']." is still not approved";
            echo '<script>window.history.back();</script>';
            exit;
        }
    ?>
        <div class="container mx-auto px-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <button class="float-right flex items-center justify-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 focus:outline-none print-btn" onclick="window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm0 0h12v4H6V2zM6 12h12m-7 8h2m-2-4h2m-7-4h2m0 8h2"></path>
                    </svg>
                    <span class="hidden md:inline">Print</span>
                </button>

                <div class="flex justify-between mb-4">
                    <img src="images/nepal-flag.gif" alt="Municipality Logo" class="h-16 w-auto">
                    <h2 class="text-2xl font-bold mb-4 text-center">
                        <Span class="font-bold text-red-500">Kohalpur Municipality, Banke</Span><br>
                        Death Certificate</h2>
                    <div></div>
                </div>
                <div class="flex justify-between mb-4">
                    <div>Registration No.: <span class="font-bold"><?= $row['registration_no'] ?></span></div>
                    <div>Date of Registration: <span class="font-bold"><?= $row['upload_date'] ?></span></div>
                </div>
                <hr class="my-4">
                <p class="text-justify">This is to certify, as per the death register maintained at this office and the information provided, that Mr./Miss/Ms. <span class="font-bold"><?= $row['name'] ?></span>, gender <span class="font-bold"><?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?></span>, marital status <span class="font-bold"><?php echo $row['mariage_status'] == 0 ? "Single" : ($row['mariage_status'] == 1 ? "Married" : "Divorced"); ?></span>, with <span class="font-bold"><?= $row['child'] ?></span> children, died on <span class="font-bold"><?= $row['death_date']; ?></span> at <span class="font-bold"><?= $row['death_place']; ?></span>. The cause of death was <span class="font-bold"><?php echo $row['reason'] == 0 ? "Natural" : ($row['reason'] == 1 ? "Accident" : "Police Case"); ?></span>.</p>
                <div class="mt-4">
                    <p>Birth Date: <span class="font-bold"><?= $row['birth_date']; ?></span></p>
                    <p>Death Date: <span class="font-bold"><?= $row['death_date']; ?></span></p>
                </div>
                <div class="flex justify-between">
                    <div>
                        <p class="mt-4">Previous Photo of the deceased:</p>
                        <img src="images/proof_img/<?= $row['dead_photo']; ?>" alt="Previous Photo" class="mt-2 h-20">
                    </div>
                    <div>
                        <p class="mt-4">Death Person Citizenship:</p>
                        <img src="images/proof_img/<?= $row['citizenship']; ?>" alt="Previous Photo" class="mt-2 h-20">
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between">
                        <div>Name of Local Registrar: <span class="font-bold"><?= $row['approved_by_name'] ?></span></div>
                    </div>
                    <div class="flex justify-between">
                        <div>Signature: <tt class="font-bold"><i><?= $row['approved_by_name'] ?></i></tt></div>
                        <div>Issuance Date: <span class="font-bold"><?= $row['issue_date'] ?></span></div>
                    </div>
                </div>
                <div class="mt-8 applicant-details">
                    <p class="text-center">Applicant Name: <span class="font-bold"><?= $row['user_name']; ?></span></p>
                    <p class="text-center">Applicant Phone: <span class="font-bold"><?= $row['contact']; ?></span></p>
                    <p class="text-center">Applicant Relationship: <span class="font-bold"><?php echo $row['relationship'] == 0 ? "Child" : ($row['relationship'] == 1 ? "Cousin" : ($row['relationship'] == 2 ? "Wife" : "Other")); ?></span></p>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>