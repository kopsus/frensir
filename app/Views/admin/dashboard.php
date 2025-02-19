<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Dashboard<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative bg-white px-[46px] pt-[53px] flex flex-row gap-[49px] flex-1 h-[96vh]">
    <?= view('templates/sidenav', ['activePage' => $activePage]) ?>
    <div id="content" class="flex flex-col gap-[25px] mt-[70px] w-full">
        <p class="font-bold text-[36px] text-[#8C0B40] ">Selamat Datang di Admin Page Frensir</p>
    </div>
</div>
<?= $this->endSection() ?>