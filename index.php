<?php

        $db = mysqli_connect('localhost', 'root', '', 'database');
        $data = mysqli_query($db, "SELECT * FROM logbook");
        $datas = mysqli_query($db, "SELECT * FROM logbook");

        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $temp = $_POST['temp'];
            
            mysqli_query($db, "INSERT INTO logbook (name, date, time, temp) VALUES ('$name', '$date', '$time', '$temp')");
            header('location: index.php');
        }


        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $temp = $_POST['temp'];
            

            mysqli_query($db, "UPDATE logbook SET name='$name', date='$date', time='$time', temp='$temp' WHERE id=$id");
            header('location: index.php');
        }

         // delete
        if (isset($_GET['del'])) {
            $id = $_GET['del'];
            mysqli_query($db, "DELETE FROM logbook WHERE id=$id");
            $_SESSION['message'] = "Address deleted!"; 
            header('location: index.php');
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .show {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        display: none;
        overflow: hidden;
        -webkit-overflow-scrolling: touch;
        outline: 0;
        }

    </style>
    <title>Document</title>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen items-center justify-center">
               <div class="bg-white rounded-lg p-6 shadow-sm" style="width:50%;">
                <span class="text-lg uppercase"> Simple Logbook System</span> 
                <div class="flex justify-between pb-5">
                    <h1 class="font-medium text-gray-700">List of Records</h1>
                    <div>
                        <a href="#addUser" data-toggle="modal">
                          <i class="fas fa-plus text-gray-400"></i>
                        </a>
                    </div>
                </div>
                 <table class="min-w-full divide-y divide-gray-200">
                    <thead class="">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Time
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Temperature
                        </th>
                        <th scope="col" class="relative px-3 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        </tr>
                    </thead>
                   <tbody class="bg-white divide-y divide-gray-200">
                    <?php while ($row = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="ml-4">
                                    <small><?php echo $row['name']?></small>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="ml-4">
                                    <small><?php echo $row['date']?></small>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="ml-4">
                                    <small><?php echo $row['time']?></small>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="ml-4">
                                    <small><?php echo $row['temp']?></small>
                                </div>
                            </td>

                            <td class="px-6 py-4 space-x-2 whitespace-nowrap text-right font-medium" style="font-size: 13px">
                                <a href="#edit<?php echo $row['id'];?>" data-toggle="modal" class="text-indigo-600 hover:text-indigo-900 w-full transition-all">Edit</a>
                                <a href="?del=<?php echo $row['id']; ?>" data-toggle="modal" class="text-red-300 hover:text-indigo-900 w-full transition-all">Delete</a>
                            </td>
                           
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

             <div id="addUser" class="show fade ">
                    <div class="flex overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="user_modal">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all">
                                <div class="bg-white p-5 mx-5 my-5" style="max-width: 500px">
                                    <div class="flex justify-between items-center pb-8">
                                        <h1 class="font-semibold text-gray-600 text-xl">Add record</h1>
                                        <i class="fas fa-close text-gray-300 cursor-pointer" data-dismiss="modal"></i>
                                    </div>
                                    <form action="" method="post" class="space-y-2">
                                    <input type="hidden" name="id" value="">
                                        <div class="space-y-2">
                                            <p class="text-sm">Name <span class="text-red-500">*</span></p>
                                            <input type="text" value="" autocomplete="off" name="name" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm">Date <span class="text-red-500">*</span></p>
                                            <input type="text" value="" autocomplete="off" name="date" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm">Time <span class="text-red-500">*</span></p>
                                            <input type="text" value="" autocomplete="off" name="time" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm">Temperature <span class="text-red-500">*</span></p>
                                            <input type="text" value="" autocomplete="off" name="temp" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="flex justify-center">
                                            <div style="font-size: 14px">
                                                <button type="button"  data-dismiss="modal" class="px-6 py-2 bg-gray-100 rounded text-gray-500">
                                                    Cancel
                                                </button>
                                                <button class="px-6 bg-green-500 hover:bg-green-400 py-2 text-white rounded ml-3" name="add" type="submit">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php while ($row = mysqli_fetch_array($datas)) { ?>
                <!-- modal -->
                <div id="edit<?php echo $row['id']; ?>" class="show fade ">
                    <div class="flex overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="user_modal">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all">
                                <div class="bg-white p-5 mx-5 my-5" style="max-width: 500px">
                                    <div class="flex justify-between items-center pb-8">
                                        <h1 class="font-semibold text-gray-600 text-xl">Update record</h1>
                                        <i class="fas fa-close text-gray-300 cursor-pointer" data-dismiss="modal"></i>
                                    </div>
                                    <form action="" method="post" class="space-y-2">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <div class="space-y-2">
                                            <p class="text-sm">Name <span class="text-red-500">*</span></p>
                                            <input type="text" value="<?php echo $row['name']; ?>" autocomplete="off" name="name" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm">Date <span class="text-red-500">*</span></p>
                                            <input type="text" value="<?php echo $row['date']; ?>" autocomplete="off" name="date" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm">Time <span class="text-red-500">*</span></p>
                                            <input type="text" value="<?php echo $row['time']; ?>" autocomplete="off" name="time" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm">Temperature <span class="text-red-500">*</span></p>
                                            <input type="text" value="<?php echo $row['temp']; ?>" autocomplete="off" name="temp" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                        </div>
                                        <div class="flex justify-center">
                                            <div style="font-size: 14px">
                                                <button type="button"  data-dismiss="modal" class="px-6 py-2 bg-gray-100 rounded text-gray-500">
                                                    Cancel
                                                </button>
                                                <button class="px-6 bg-green-500 hover:bg-green-400 py-2 text-white rounded ml-3" name="update" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/bootstrap.min.js"></script>
     <script>
        function triggerClick(e) {
            document.querySelector("#profileImage").click();
        }

        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document
                        .querySelector("#profileDisplay")
                        .setAttribute("src", e.target.result);
                };
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
</body>
</html>