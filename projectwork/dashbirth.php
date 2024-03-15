<?php
include "dash.php";
?>

<div class="p-4 pt-0 sm:ml-64">
    <h1 class="font-bold mb-8 text-green-500 underline">Birth Registration</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h1 class="font-bold text-white mb-3">:-On processing Registration</h1>
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
                        View
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $u_id = $_SESSION['logged_In'];
                $sql = mysqli_query($con, "SELECT users.*,birth_register.*, users.name AS user_name FROM birth_register JOIN users ON birth_register.user = users.id WHERE birth_register.approve_state != '1'");
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
                        <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer" onclick="document.querySelector('#birth_approval').classList.toggle('hidden');">View</a>
                        </td>
                    </tr>
                    <div id="birth_approval" class="fixed top-0 left-0 w-full z-50 h-full overflow-y-auto hidden class" style="background: #00000056;">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-auto" style="width: 85%;">
                            <div class="flex justify-between mb-4">
                                <img src="images/nepal-flag.gif" alt="Municipality Logo" class="h-16 w-auto">
                                <h2 class="text-2xl font-bold mb-4 text-center">Birth Certificate Approval</h2>
                                <div></div>
                            </div>
                            <div class="mb-4">
                                <p>This is to approve the birth certificate for the newborn child as per the information provided:</p>
                            </div>
                            <div class="mb-4">
                                <p>Parents Information:</p>
                                <ul>
                                    <li>Father's Name: <span class="font-bold"><?= $row['father'] ?></span></li>
                                    <li>Father's Citizenship No: <span class="font-bold"><?= $row['fa_citizen_no'] ?></span></li>
                                    <li>Mother's Name: <span class="font-bold"><?= $row['mother'] ?></span></li>
                                    <li>Mother's Citizenship No: <span class="font-bold"><?= $row['mo_citizen_no'] ?></span></li>
                                </ul>
                            </div>
                            <hr class="my-4">
                            <div class="mb-4">
                                <p>Child Information:</p>
                                <ul>
                                    <li>Child's Name: <span class="font-bold"><?= $row['name'] ?></span></li>
                                    <li>Child's Gender: <span class="font-bold"><?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?></span></li>
                                    <li>Child's Birth Date: <span class="font-bold"><?= $row['birth_date'] ?></span></li>
                                    <li>Child's Birth Time: <span class="font-bold"><?= $row['birth_time'] ?></span></li>
                                </ul>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Baby Photo:</p>
                                <img src="images/proof_img/<?= $row['baby_img']; ?>" alt="Baby Photo" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Hospital Certificate:</p>
                                <img src="images/proof_img/<?= $row['certificate']; ?>" alt="Hospital Certificate" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mt-8">
                                <p class="text-center">Applicant Name: <span class="font-bold"><?= $row['user_name']; ?></span></p>
                                <p class="text-center">Applicant Phone: <span class="font-bold"><?= $row['contact']; ?></span></p>
                            </div>
                            <?php if ($row['approve_state'] !== '1') { ?>
                                <div class="flex justify-between">
                                    <a href="update.php?birth_approve=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="return confirm('Are you sure all documnet is correct or wanna check again ?')">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                            Approve
                                        </button></a>
                                    <a href="update.php?birth_reject=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                            Reject
                                        </button></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <hr>
        <h1 class="font-bold text-white mb-3 mt-4">:-Approved Registration</h1>
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
                        View
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $u_id = $_SESSION['logged_In'];
                $sql = mysqli_query($con, "SELECT users.*,birth_register.*, users.name AS user_name FROM birth_register JOIN users ON birth_register.user = users.id WHERE birth_register.approve_state = '1'");
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
                        <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer" onclick="document.querySelector('#birth_approval').classList.toggle('hidden');">View</a>
                        </td>
                    </tr>
                    <div id="birth_approval" class="fixed top-0 left-0 w-full z-50 h-full overflow-y-auto hidden class" style="background: #00000056;">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-auto" style="width: 85%;">
                            <div class="flex justify-between mb-4">
                                <img src="images/nepal-flag.gif" alt="Municipality Logo" class="h-16 w-auto">
                                <h2 class="text-2xl font-bold mb-4 text-center">Birth Certificate Approval</h2>
                                <div></div>
                            </div>
                            <div class="mb-4">
                                <p>This is to approve the birth certificate for the newborn child as per the information provided:</p>
                            </div>
                            <div class="mb-4">
                                <p>Parents Information:</p>
                                <ul>
                                    <li>Father's Name: <span class="font-bold"><?= $row['father'] ?></span></li>
                                    <li>Father's Citizenship No: <span class="font-bold"><?= $row['fa_citizen_no'] ?></span></li>
                                    <li>Mother's Name: <span class="font-bold"><?= $row['mother'] ?></span></li>
                                    <li>Mother's Citizenship No: <span class="font-bold"><?= $row['mo_citizen_no'] ?></span></li>
                                </ul>
                            </div>
                            <hr class="my-4">
                            <div class="mb-4">
                                <p>Child Information:</p>
                                <ul>
                                    <li>Child's Name: <span class="font-bold"><?= $row['name'] ?></span></li>
                                    <li>Child's Gender: <span class="font-bold"><?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?></span></li>
                                    <li>Child's Birth Date: <span class="font-bold"><?= $row['birth_date'] ?></span></li>
                                    <li>Child's Birth Time: <span class="font-bold"><?= $row['birth_time'] ?></span></li>
                                </ul>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Baby Photo:</p>
                                <img src="images/proof_img/<?= $row['baby_img']; ?>" alt="Baby Photo" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Hospital Certificate:</p>
                                <img src="images/proof_img/<?= $row['certificate']; ?>" alt="Hospital Certificate" class="h-32 w-auto mx-auto">
                            </div>
                            <div class="mb-4">
                                <p>Parents Marriage Certificate:</p>
                                <img src="images/proof_img/<?= $row['parents_marriage']; ?>" alt="marriage Certificate" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mt-8">
                                <p class="text-center">Applicant Name: <span class="font-bold"><?= $row['user_name']; ?></span></p>
                                <p class="text-center">Applicant Phone: <span class="font-bold"><?= $row['contact']; ?></span></p>
                            </div>
                            <?php if ($row['approve_state'] !== '1') { ?>
                                <div class="flex justify-between">
                                    <a href="update.php?birth_approve=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="return confirm('Are you sure all documnet is correct or wanna check again ?')">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                            Approve
                                        </button></a>
                                    <a href="update.php?birth_reject=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                            Reject
                                        </button></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>