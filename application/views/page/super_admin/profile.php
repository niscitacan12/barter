<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="flex flex-col lg:flex-row mx-auto max-w-7xl py-6 px-4 lg:px-0">
                <!-- Profile Picture -->
                <div class="lg:w-1/3 pr-4 mb-4 lg:mb-0">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="text-xl font-semibold mb-2">Profile Picture</div>
                        <div class="text-center">
                            <img class="w-32 h-32 rounded-full mx-auto mb-2" src="profile.jpg" alt="Profile Picture">
                            <p class="text-xs text-gray-500 mb-4">JPG or PNG no larger than 5 MB</p>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <label for="image" class="block mb-1">Upload new image</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="border rounded-md p-1">
                                <!-- Add preview image if needed -->
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="text-xl font-semibold mb-4">Account Details</div>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="username" class="block mb-1 text-sm">Username</label>
                                <input type="text" class="border rounded-md w-full p-2" value="JohnDoe" id="username"
                                    name="username">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block mb-1 text-sm">Email address</label>
                                <input type="text" value="<?php echo $superadmin->email; ?>"
                                    class="border rounded-md w-full p-2" id="email" name="email">
                            </div>
                            <div class="flex flex-col lg:flex-row lg:gap-4 mb-4">
                                <div class="w-full lg:w-1/2 mb-4 lg:mb-0">
                                    <label for="firstName" class="block mb-1 text-sm">First name</label>
                                    <input type="text" class="border rounded-md w-full p-2" value="John" id="firstName"
                                        name="firstName">
                                </div>
                                <div class="w-full lg:w-1/2">
                                    <label for="lastName" class="block mb-1 text-sm">Last name</label>
                                    <input type="text" class="border rounded-md w-full p-2" value="Doe" id="lastName"
                                        name="lastName">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block mb-1 text-sm">Password</label>
                                <input type="password" class="border rounded-md w-full p-2" id="password"
                                    name="password">
                            </div>
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-md" type="submit">Save
                                changes</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>