<?php require_once 'header.php'; ?>

<body>

    <?php require_once 'nav.php'; ?>

    <div class="flex min-h-full items-center justify-center px-4 mt-16 sm:px-6 lg:px-8">
    <form class="space-y-6 col-start-4 col-span-6 p-8 bg-white shadow-md rounded-md mx-auto" action="/articles/store" method="POST">

        <h2 class="normal-case text-xl">Submit New Article</h2>

        <label for="title" class="block text-sm font-medium text-gray-600">Submission Title</label>
        <input type="text" name="title" id="title" required
               class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">

        <label for="url" class="block text-sm font-medium text-gray-600 mt-4">Submission Link</label>
        <!-- Change this input to url later for validation -->
        <input type="url" name="url" id="url" required
               class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">

       <div class="mt-6">
              <input type="submit" value="Submit" id="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
       </div>
    </form>
</div>


</body>

