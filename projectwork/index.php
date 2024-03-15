<?php
include "header.php";
?>
<div class="container flex flex-wrap gap-2 justify-center">
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <button id="dropdownButton" data-dropdown-toggle="dropdown1" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>
            <div id="dropdown1" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a href="userdetails.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="<?= $user_profile ?>" alt="Bonnie image" />
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?= $user['name']; ?>/<?= $user['contact']; ?></h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">Personal Details</span>
        </div>
    </div>
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <button id="dropdownButton" data-dropdown-toggle="dropdown2" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>
            <div id="dropdown2" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white cursor-pointer" data-modal-target="death-edit" data-modal-toggle="death-edit">Edit/Export
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="images/death.jpg" alt="Bonnie image" />
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Register</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">Death Registration</span>
            <div class="flex mt-4 md:mt-6">
                <a href="deathreg.php" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register Death</a>
            </div>
        </div>
    </div>
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <button id="dropdownButton" data-dropdown-toggle="dropdown3" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>
            <div id="dropdown3" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white cursor-pointer" data-modal-target="birth-edit" data-modal-toggle="birth-edit">Edit/Export
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="images/birth.png" alt="Bonnie image" />
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Birth</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">Birth Registration</span>
            <div class="flex mt-4 md:mt-6">
                <a href="birthreg.php" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register Birth</a>
            </div>
        </div>
    </div>
</div>

<div id="death-edit" tabindex="-1" class="hidden fixed top-0 left-0 w-full h-full z-50 flex items-center justify-center" style="background: #00000056;">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Marriage
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reason
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Death Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $u_id = $_SESSION['logged_In'];
                $sql = mysqli_query($con, "SELECT * FROM death_register WHERE `user`='$u_id'");
                foreach ($sql as $row) {
                ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $row['name']; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $row['mariage_status'] == 0 ? "Single" : ($row['mariage_status'] == 1 ? "Married" : "Divorced"); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $row['reason'] == 0 ? "Natural" : ($row['reason'] == 1 ? "Accident" : "Police Case"); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $row['death_date']; ?>
                        </td>
                        <td class="px-6 py-4 font-bold">
                        <?php echo $row['approve_state'] === '1' ? "Approve" : ($row['approve_state'] === '0' ? "Reject" : "Processing"); ?>
                        </td>
                        <?php if($row['approve_state'] === '1'){?>
                        <td class="px-6 py-4">
                            <a href="deathCertificate.php?export=<?= $row['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Export</a>
                        </td>
                        <?php }else{?>
                        <td class="px-6 py-4">
                            <a href="deathreg.php?update=<?= $row['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                        <?php }?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div id="birth-edit" tabindex="-1" class="hidden fixed top-0 left-0 w-full h-full z-50 flex items-center justify-center" style="background: #00000056;">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Father
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Birth Place
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Birth Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $u_id = $_SESSION['logged_In'];
                $sql = mysqli_query($con, "SELECT * FROM birth_register WHERE `user`='$u_id'");
                foreach ($sql as $row) {
                ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $row['name']; ?>
                        </th>
                        <td class="px-6 py-4">
                        <?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $row['father']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $row['birth_place']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $row['birth_date']; ?>
                        </td>
                        <td class="px-6 py-4 font-bold">
                        <?php echo $row['approve_state'] === '1' ? "Approve" : ($row['approve_state'] === '0' ? "Reject" : "Processing"); ?>
                        </td>
                        <?php if($row['approve_state'] === '1'){?>
                        <td class="px-6 py-4">
                            <a href="birthCertificate.php?export=<?= $row['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Export</a>
                        </td>
                        <?php }else{?>
                        <td class="px-6 py-4">
                            <a href="birthreg.php?update=<?= $row['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                        <?php }?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>