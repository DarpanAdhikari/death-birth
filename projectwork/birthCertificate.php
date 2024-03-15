<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "connection.php";
if ((!isset($_GET['export']) || $_GET['export'] === "")) {
    header('Location: index.php');
    die;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificate</title>
    <link rel="shortcut icon" href="images/nepal-flag.gif" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 pt-0">
    <?php
    $id = $_GET['export'];
    $u_id = $_SESSION['logged_In'];
    $select = mysqli_query($con, "SELECT users.*, birth_register.*, users.name AS user_name, approved_users.name AS approved_by_name 
    FROM birth_register
    JOIN users ON birth_register.user = users.id 
    JOIN users AS approved_users ON birth_register.approved_by = approved_users.id 
    WHERE birth_register.id = '$id' AND birth_register.user = '$u_id'");
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        if($row['approve_state'] !== '1'){
            $_SESSION['error'] = "The birth registration of ".$row['name']." is still not approved";
            echo '<script>window.history.back();</script>';
            exit;
        }
    ?>
        <div class="container mx-auto p-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="print-btn">
                    <button class="float-right flex items-center justify-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 focus:outline-none" onclick="window.print()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm0 0h12v4H6V2zM6 12h12m-7 8h2m-2-4h2m-7-4h2m0 8h2"></path>
                        </svg>
                        <span class="hidden md:inline">Print</span>
                    </button>
                </div>

                <div class="flex justify-between mb-4 print:hidden">
                    <img src="images/nepal-flag.gif" alt="Municipality Logo" class="h-16 w-auto">
                    <h2 class="text-2xl font-bold mb-4 text-center">
                        <Span class="font-bold text-red-500">Kohalpur Municipality, Banke</Span><br>
                        Birth Certificate
                    </h2>
                    <div></div>
                </div>
                <div class="flex justify-between mb-4">
                    <div>Registration No.: <span class="font-bold"><?= $row['registration_no'] ?></span></div>
                    <div>Date of Registration: <span class="font-bold"><?= $row['upload_date'] ?></span></div>
                </div>
                <hr class="my-4">
                <div class="mb-4">
                    <p>This is to certify that Mr./Mrs. <span class="font-bold"><?= $row['father'] ?></span> ( Citizenship No. <span class="font-bold"><?= $row['fa_citizen_no'] ?></span> ) and Mr./Mrs. <span class="font-bold"><?= $row['mother'] ?></span> ( Citizenship No. <span class="font-bold"><?= $row['mo_citizen_no'] ?></span> ) are the proud parents of a child born baby <span class="font-bold"><?php echo $row['gender'] == 0 ? "Boy" : ($row['gender'] == 1 ? "Girl" : ""); ?></span> on <span class="font-bold"><?= $row['birth_date'] ?></span> at <span class="font-bold"><?= $row['birth_time'] ?></span>.</p>
                    <p>Their bundle of joy, named <span class="font-bold"><?= $row['name'] ?></span>, has brought immeasurable happiness and blessings to their lives.</p>
                    <p>We extend our heartfelt congratulations and best wishes to the proud parents on this joyous occasion. May the arrival of this precious child fill your home with love, laughter, and countless cherished memories.</p>
                </div>
                <div class="flex justify-between">
                    <div class="mb-4">
                        Baby Photo:
                        <img src="images/proof_img/<?= $row['baby_img']; ?>" alt="Baby Photo" class="h-32 w-auto">
                    </div>
                    <div class="mb-4">
                        Hospital Certificate:
                        <img src="images/proof_img/<?= $row['certificate']; ?>" alt="Hospital Certificate" class="h-32">
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
            </div>
        </div>
    <?php } ?>
</body>

</html>