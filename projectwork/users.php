<?php
include "dash.php";
if($get['role']!=='1'){
    echo '<script>window.history.back();</script>';
    die;
}
?>

<div class="p-4 sm:ml-64">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contact
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Marriage
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Birth Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Photo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Citizenship
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($con, "SELECT * FROM users");
                foreach ($sql as $row) {
                ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $row['name']; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= $row['contact']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $row['email']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $row['gender'] == 0 ? "Male" : ($row['gender'] == 1 ? "Female" : "Other"); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $row['marriage'] == 0 ? "Single" : ($row['marriage'] == 1 ? "Married" : "Divorced"); ?>
                        </td>
                        <td class="px-6 py-4">
                          <?= $row['birth_date']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <img src="images/profile/<?= $row['profile_img']; ?>" alt="">
                        </td>
                        <td class="px-6 py-4">
                            <img src="images/profile/<?= $row['citizenship']; ?>" alt="">
                        </td>
                        <td class="px-6 py-4">
                            <form action="update.php" method="POST" id="role<?= $row['id'];?>" enctype="multipart/form-data">
                                <input type="hidden" value="<?= $row['id'];?>" name="user">
                            <select name="role" onchange="document.querySelector('#role<?= $row['id'];?>').submit();" class="block px-3 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option value="0" <?php if($row['role'] == 0)echo "selected" ?>>User</option>
                                <option value="1" <?php if($row['role'] == 1)echo "selected" ?>>Admin</option>
                                <option value="2"  <?php if($row['role'] == 2)echo "selected" ?>>Employee</option>
                            </select>
                            </form>
                        </td>
                    </tr>
                    <?php }?>
            </tbody>
        </table>
    </div>
</div>
