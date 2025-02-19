<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title><?= $this->renderSection('title') ?></title>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <main class="min-h-screen w-full">
    <!-- Main Section -->
    <?= $this->renderSection('main-content') ?>
    <!-- Main Section -->
    </main>
</body>
</html>