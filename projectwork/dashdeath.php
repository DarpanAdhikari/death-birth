<?php
include "dash.php";
?>

<div class="p-4 pt-0 sm:ml-64">
    <h1 class="font-bold mb-8 text-green-500 underline">Death Registration</h1>
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
                        Marriage
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reason
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Death Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        View
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($con, "SELECT users.*,death_register.*, users.name AS user_name FROM death_register JOIN users ON death_register.user = users.id WHERE death_register.approve_state != '1'");
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
                        <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer" onclick="document.querySelector('#death_approval').classList.toggle('hidden');">View
                        </td>
                    </tr>
                    <div id="death_approval" class="fixed top-0 left-0 w-full z-50 h-full overflow-y-auto hidden" style="background: #00000056;">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-auto" style="width: 85%;">
                            <div class="flex justify-between mb-4">
                                <img src="images/nepal-flag.gif" alt="Municipality Logo" class="h-16 w-auto">
                                <h2 class="text-2xl font-bold mb-4 text-center">Death Certificate Approval</h2>
                                <div></div>
                            </div>
                            <div class="mb-4">
                                <p>This is to approve the death certificate for the deceased individual as per the information provided:</p>
                            </div>
                            <div class="mb-4">
                                <p>Deceased Information:</p>
                                <ul>
                                    <li>Name: <span class="font-bold"><?= $row['name'] ?></span></li>
                                    <li>Gender: <span class="font-bold"><?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?></span></li>
                                    <li>Marital Status: <span class="font-bold"><?php echo $row['mariage_status'] == 0 ? "Single" : ($row['mariage_status'] == 1 ? "Married" : "Divorced"); ?></span></li>
                                    <li>Children: <span class="font-bold"><?= $row['child'] ?></span></li>
                                    <li>Death Date: <span class="font-bold"><?= $row['death_date']; ?></span></li>
                                    <li>Place of Death: <span class="font-bold"><?= $row['death_place']; ?></span></li>
                                    <li>Cause of Death: <span class="font-bold"><?php echo $row['reason'] == 0 ? "Natural" : ($row['reason'] == 1 ? "Accident" : "Police Case"); ?></span></li>
                                </ul>
                            </div>
                            <hr class="my-4">
                            <div class="mb-4">
                                <p>Birth Date: <span class="font-bold"><?= $row['birth_date']; ?></span></p>
                                <p>Death Date: <span class="font-bold"><?= $row['death_date']; ?></span></p>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Previous Photo of the deceased:</p>
                                <img src="images/proof_img/<?= $row['dead_photo']; ?>" alt="Previous Photo of the deceased" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Death Person Citizenship:</p>
                                <img src="images/proof_img/<?= $row['citizenship']; ?>" alt="Death Person Citizenship" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mt-8">
                                <p class="text-center">Applicant Name: <span class="font-bold"><?= $row['user_name']; ?></span></p>
                                <p class="text-center">Applicant Phone: <span class="font-bold"><?= $row['contact']; ?></span></p>
                                <p class="text-center">Applicant Relationship: <span class="font-bold"><?php echo $row['relationship'] == 0 ? "Child" : ($row['relationship'] == 1 ? "Cousin" : ($row['relationship'] == 2 ? "Wife" : "Other")); ?></span></p>
                            </div>
                            <?php if($row['approve_state'] !== '1'){?>
                                <div class="flex justify-between">
                                <a href="update.php?death_approve=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="return confirm('Are you sure all documnet is correct or wanna check again ?')">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                        Approve
                                    </button></a>
                                <a href="update.php?death_reject=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                        Reject
                                    </button></a>
                            </div>
                                <?php }?>
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
                        Marriage
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reason
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Death Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        View
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($con, "SELECT users.*,death_register.*, users.name AS user_name FROM death_register JOIN users ON death_register.user = users.id WHERE death_register.approve_state = '1'");
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
                        <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer" onclick="document.querySelector('#death_approval').classList.toggle('hidden');">View
                        </td>
                    </tr>
                    <div id="death_approval" class="fixed top-0 left-0 w-full z-50 h-full overflow-y-auto hidden" style="background: #00000056;">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-auto" style="width: 85%;">
                            <div class="flex justify-between mb-4">
                                <img src="images/nepal-flag.gif" alt="Municipality Logo" class="h-16 w-auto">
                                <h2 class="text-2xl font-bold mb-4 text-center">Death Certificate Approval</h2>
                                <div></div>
                            </div>
                            <div class="mb-4">
                                <p>This is to approve the death certificate for the deceased individual as per the information provided:</p>
                            </div>
                            <div class="mb-4">
                                <p>Deceased Information:</p>
                                <ul>
                                    <li>Name: <span class="font-bold"><?= $row['name'] ?></span></li>
                                    <li>Gender: <span class="font-bold"><?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?></span></li>
                                    <li>Marital Status: <span class="font-bold"><?php echo $row['mariage_status'] == 0 ? "Single" : ($row['mariage_status'] == 1 ? "Married" : "Divorced"); ?></span></li>
                                    <li>Children: <span class="font-bold"><?= $row['child'] ?></span></li>
                                    <li>Death Date: <span class="font-bold"><?= $row['death_date']; ?></span></li>
                                    <li>Place of Death: <span class="font-bold"><?= $row['death_place']; ?></span></li>
                                    <li>Cause of Death: <span class="font-bold"><?php echo $row['reason'] == 0 ? "Natural" : ($row['reason'] == 1 ? "Accident" : "Police Case"); ?></span></li>
                                </ul>
                            </div>
                            <hr class="my-4">
                            <div class="mb-4">
                                <p>Birth Date: <span class="font-bold"><?= $row['birth_date']; ?></span></p>
                                <p>Death Date: <span class="font-bold"><?= $row['death_date']; ?></span></p>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Previous Photo of the deceased:</p>
                                <img src="images/proof_img/<?= $row['dead_photo']; ?>" alt="Previous Photo of the deceased" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mb-4">
                                <p>Death Person Citizenship:</p>
                                <img src="images/proof_img/<?= $row['citizenship']; ?>" alt="Death Person Citizenship" class="h-32 w-auto mx-auto">
                            </div>
                            <hr>
                            <div class="mt-8">
                                <p class="text-center">Applicant Name: <span class="font-bold"><?= $row['user_name']; ?></span></p>
                                <p class="text-center">Applicant Phone: <span class="font-bold"><?= $row['contact']; ?></span></p>
                                <p class="text-center">Applicant Relationship: <span class="font-bold"><?php echo $row['relationship'] == 0 ? "Child" : ($row['relationship'] == 1 ? "Cousin" : ($row['relationship'] == 2 ? "Wife" : "Other")); ?></span></p>
                            </div>
                            <?php if($row['approve_state'] !== '1'){?>
                                <div class="flex justify-between">
                                <a href="update.php?death_approve=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="return confirm('Are you sure all documnet is correct or wanna check again ?')">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                        Approve
                                    </button></a>
                                <a href="update.php?death_reject=<?= $row['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                        Reject
                                    </button></a>
                            </div>
                                <?php }?>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>