<?php
require_once 'header.php';

use src\Repositories\ArticleRepository;
use src\Repositories\UserRepository;
// require_once '../src/Repositories/ArticleRepository.php';

$articles = (new ArticleRepository())->getAllArticles();
// $users = new UserRepository();

?>

<body>

    <?php require_once 'nav.php' ?>

    <!-- <form action="/upload_image" method="post" enctype="multipart/form-data">
        <input type="file" name="profile_picture">
        <input type="submit">
    </form> -->

    <!-- DISPLAY TEST INFO HERE: -->

    <!-- <?php echo $_SESSION['logged_in_user'] ;

    ?> -->

    <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">

        <h1 class="text-xl text-center font-semibold text-indigo-500 mt-10 mb-10 title">Articles</h1>

        <h6 class="text-center"><?= count($articles) === 0 ? "No articles yet :(" : ""; ?></span>

            <div class="sm:rounded-md mb-20">
                <ul role="list">
                    <?php foreach ($articles as $article) : ?>
                    <div class="mb-6 p-4 border rounded-md shadow-md">

                        <a href="<?php echo hsc($article->url); ?>" target="_blank" class="text-xl font-bold mb-2 block text-indigo-500"><?php echo hsc($article->title); ?></a>
                    <?php
                        $articleRepository = new ArticleRepository();
                        $author = $articleRepository->getArticleAuthor($article->id);
                    ?>

                    <p>Created at: <?php echo hsc($article->created_at); ?></p>

                    <?php if ($article->updated_at): ?>
                        <p>
                            Updated at: <?php echo hsc($article->updated_at); ?>
                        </p>
                    <?php endif; ?>

                    <p>Created By: <?php echo hsc($author->name); ?></p>

                        <?php if ($_SESSION['logged_in_user'] == $author->id): ?>
                            <div class="mt-4 flex justify-center space-x-2">

                                <form action="/articles/edit" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $article->id; ?>">
                                    <input type="submit" name="edit" value="Edit" class="btn btn-ghost normal-case ">
                                </form>

                                <form action="/articles/delete" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $article->id; ?>">
                                    <input type="submit" name="delete" value="Delete" class="btn btn-ghost normal-case ">
                                </form>

                            </div>

                        <?php endif; ?>
                            
                    </div>



                    <?php endforeach; ?>

                </ul>
            </div>
    </div>

</body>