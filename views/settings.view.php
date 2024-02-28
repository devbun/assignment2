

<?php require_once 'header.php'; ?>

<?php require_once 'nav.php' ?>

<?php
    use src\Repositories\UserRepository;
    $userRepository = new UserRepository();
    $user = $userRepository->getUserById($_SESSION['logged_in_user']);
?>

<div class="mx-auto max-w-4xl sm:px-6 lg:px-8 mt-10">

    <form class="space-y-6 col-start-4 col-span-6 p-8 bg-white shadow-md rounded-md mx-auto" action="/settings/update" enctype="multipart/form-data" method="POST">

        <h2 class="normal-case text-xl">Update User</h2>
        <img src="<?php echo $user->profile_picture; ?>" alt="">
        <input type="hidden" name="id" value="<?php echo $user->id; ?>">

        <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
        <input type="text" name="email" id="email" value="<?php echo $user->email; ?>"  readonly
            class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">

        <label for="name" class="block text-sm font-medium text-gray-600 mt-4">Name</label>
        <input type="name" name="name" id="name" value="<?php echo $user->name; ?>" required
            class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">

         <input type="file" name="profile_picture" id="profile_picture">

        <input type="submit" value="Submit" id="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
    </form>

</div>
