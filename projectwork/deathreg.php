<?php
include "header.php";
?>
<div class="container mt-1">
    <?php
    if (isset($_GET['update'])) {
        $id = $_GET['update'];
        $select = mysqli_query($con,"SELECT * FROM death_register WHERE id='$id'");
        if(mysqli_num_rows($select)>0){
            $row=mysqli_fetch_assoc($select);
    ?>
        <form class="max-w-xl mx-auto" action="update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $id?>" name="user">
            <div class="relative z-0 w-full mb-2 group">
                <input type="text" name="full_name" id="full_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="<?= $row['name'];?>" required />
                <label for="full_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full Name</label>
            </div>
            <div class="relative z-0 w-full group">
                <label class="text-sm text-gray-500">Gender</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="gender-male" type="radio" value="0" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['gender'] == 0) echo "checked";?> required>
                            <label for="gender-male" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="gender-female" type="radio" value="1" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['gender'] == 1) echo "checked";?> required>
                            <label for="gender-female" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="gender-other" type="radio" value="2" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['gender'] == 2) echo "checked";?> required>
                            <label for="gender-other" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Other</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative z-0 w-full group mb-2">
                <label class="text-sm text-gray-500">Mariage Status</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="mariageStatus">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="mariage-signle" type="radio" value="0" name="mariage_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['mariage_status'] == 0) echo "checked";?> required>
                            <label for="mariage-signle" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Single</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="meriage-maried" type="radio" value="1" name="mariage_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['mariage_status'] == 1) echo "checked";?> required>
                            <label for="meriage-maried" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Maried</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="mariage-divorced" type="radio" value="2" name="mariage_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['mariage_status'] == 2) echo "checked";?> required>
                            <label for="mariage-divorced" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Divorced</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative z-0 w-full group <?php if($row['mariage_status']==="0") echo "hidden";?>" id="child_count">
                <label for="" class="text-sm text-gray-500">How much children he/she has</label>
                <div class="flex items-center justify-center">
                    <button id="decrement" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-l hover:bg-blue-600">-</button>
                    <input type="number" id="counter" name="child" class="form-input w-16 text-center" value="<?=$row['child']; ?>">
                    <button id="increment" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-r hover:bg-blue-600">+</button>
                </div>
            </div>
            <div class="relative z-0 w-full group">
                <label class="text-sm text-gray-500">Death Reason</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="reason-natural" type="radio" value="0" name="reason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['reason'] == 0) echo "checked";?> required>
                            <label for="reason-natural" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Natural</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="reason-accident" type="radio" value="1" name="reason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['reason'] == 1) echo "checked";?> required>
                            <label for="reason-accident" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Accident</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600" title="PoliceCase">
                        <div class="flex items-center ps-3">
                            <input id="reason-crime" type="radio" value="2" name="reason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" <?php if($row['reason'] == 2) echo "checked";?> required>
                            <label for="reason-crime" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Police Case</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="death_place" id="death_place" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="<?= $row['death_place'];?>" required />
                <label for="death_place" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Death Place</label>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="birth_date" id="death_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "value="<?= $row['birth_date'];?>" required />
                    <label for="death_date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Birth Date</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="death_date" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="<?= $row['death_date'];?>" required />
                    <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Death Date</label>
                </div>
            </div>
            <div class="relative z-0 w-full group mb-3">
                <label for="underline_select" class="sr-only">Your Relationship with him/her</label>
                <select id="underline_select" class="block py-2.5 px-4 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer" name="relationship" required>
                    <option value="">Your Relationship with him/her</option>
                    <option value="0" <?php if($row['relationship'] == 0) echo "selected";?>>Child</option>
                    <option value="1" <?php if($row['relationship'] == 1) echo "selected";?>>Cousin</option>
                    <option value="2" <?php if($row['relationship'] == 2) echo "selected";?>>Wife</option>
                    <option value="3" <?php if($row['relationship'] == 3) echo "selected";?>>Other</option>
                </select>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full group">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Dead person previous Photo (jpg/gif/png)</label>
                    <img src="images/proof_img/<?= $row['dead_photo']?>" class="h-20" alt="">
                    <input class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file" accept="image/*" name="dead_photo" <?php if($row['dead_photo'] === "") echo "required"; ?>>
                </div>
                <div class="relative z-0 w-full group">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Dead person citizenship (jpg/gif/png)</label>
                    <img src="images/proof_img/<?= $row['citizenship']?>" class="h-20" alt="">
                    <input class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file" accept="image/*" name="citizenship" <?php if($row['citizenship'] === "") echo "required"; ?>>
                </div>
            </div>
            <button type="submit" class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="width: 100%;" name="update_death">Save</button>
        </form>
    <?php }} else { ?>
        <form class="max-w-xl mx-auto" action="insert.php" method="POST" enctype="multipart/form-data">
            <div class="relative z-0 w-full mb-2 group">
                <input type="text" name="full_name" id="full_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="full_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full Name</label>
            </div>
            <div class="relative z-0 w-full group">
                <label class="text-sm text-gray-500">Gender</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="gender-male" type="radio" value="0" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="gender-male" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="gender-female" type="radio" value="1" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="gender-female" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="gender-other" type="radio" value="2" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="gender-other" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Other</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative z-0 w-full group mb-2">
                <label class="text-sm text-gray-500">Mariage Status</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="mariageStatus">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="mariage-signle" type="radio" value="0" name="mariage_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="mariage-signle" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Single</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="meriage-maried" type="radio" value="1" name="mariage_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="meriage-maried" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Maried</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="mariage-divorced" type="radio" value="2" name="mariage_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="mariage-divorced" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Divorced</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative z-0 w-full group hidden" id="child_count">
                <label for="" class="text-sm text-gray-500">How much children he/she has</label>
                <div class="flex items-center justify-center">
                    <button id="decrement" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-l hover:bg-blue-600">-</button>
                    <input type="number" id="counter" name="child" class="form-input w-16 text-center" value="0">
                    <button id="increment" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-r hover:bg-blue-600">+</button>
                </div>
            </div>
            <div class="relative z-0 w-full group">
                <label class="text-sm text-gray-500">Death Reason</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="reason-natural" type="radio" value="0" name="reason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="reason-natural" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Natural</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="reason-accident" type="radio" value="1" name="reason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="reason-accident" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Accident</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600" title="PoliceCase">
                        <div class="flex items-center ps-3">
                            <input id="reason-crime" type="radio" value="2" name="reason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                            <label for="reason-crime" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Police Case</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="death_place" id="death_place" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="death_place" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Death Place</label>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="birth_date" id="death_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="death_date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Birth Date</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="death_date" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Death Date</label>
                </div>
            </div>
            <div class="relative z-0 w-full group mb-3">
                <label for="underline_select" class="sr-only">Your Relationship with him/her</label>
                <select id="underline_select" class="block py-2.5 px-4 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer" name="relationship" required>
                    <option value="">Your Relationship with him/her</option>
                    <option value="0">Son/Daughter</option>
                    <option value="1">Cousin</option>
                    <option value="2">Wife</option>
                    <option value="3">Other</option>
                </select>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full group">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Dead person previous Photo (jpg/gif/png)</label>
                    <input class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file" accept="image/*" name="dead_photo" required>
                </div>
                <div class="relative z-0 w-full group">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Dead person citizenship (jpg/gif/png)</label>
                    <input class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file" accept="image/*" name="citizenship" required>
                </div>
            </div>
            <button type="submit" class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="width: 100%;" name="death_form">Save</button>
        </form>
    <?php } ?>
</div>