<?php 
    $menuItems = [
        'dashboard' => ['icon' => 'assets/dashboard.svg', 'label' => 'Dashboard', 'url' => 'admin/dashboard'],
        'account'   => ['icon' => 'assets/account.svg', 'label' => 'Account', 'url' => 'admin/account'],
        'payment'   => ['icon' => 'assets/payment.svg', 'label' => 'Payment', 'url' => 'admin/payment'],
        'menu'      => ['icon' => 'assets/menu.svg', 'label' => 'Menu', 'url' => 'admin/menu'],
        'history'   => ['icon' => 'assets/payment.svg', 'label' => 'History', 'url' => 'admin/history'],
    ];
?>

<div class="relative bg-[#8C0B40] rounded-lg pl-[36px] py-[45px] w-[310px] h-full">
    <div class="mb-[31px]">
        <img src="<?= base_url('assets/FrensirLogo2.svg') ?>" alt="logo" />
    </div>
    <nav class="w-[275px]">
        <?php foreach ($menuItems as $key => $item): ?>
            <?php if ($activePage === $key): ?>
                <!-- Active Menu Item -->
                <div class="relative flex items-center text-[#80002a] hover:cursor-pointer mb-[24px]">
                        <div class="flex flex-row space-x-2 bg-white px-4 py-2 rounded-lg w-[225px] font-bold items-center">
                            <img src="<?= base_url($item['icon']) ?>" alt="logo" />
                            <span><?= $item['label'] ?></span>
                        </div>
                    <div class="absolute w-[10px] h-full rounded bg-white right-0"></div>
                </div>
            <?php else: ?>
                <!-- Inactive Menu Items -->
                <div class="relative flex items-center text-white hover:cursor-pointer mb-[24px]">
                    <a href="<?= base_url($item['url']) ?>" class="flex flex-row items-center space-x-2 px-4 py-2 rounded-lg w-[225px] hover:bg-white hover:text-[#80002a] font-bold">
                        <img src="<?= base_url($item['icon']) ?>" alt="logo" />
                        <span><?= $item['label'] ?></span>
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </nav>
    <form action="<?= base_url('/logout') ?>" method="post">
        <button type="submit" class="absolute flex flex-row gap-2 hover:cursor-pointer bottom-[59px] w-full items-center">
            <img src="<?= base_url('assets/leave.svg') ?>" alt="logo" />
            <p class="font-bold text-white">Logout</p>
        </button>
    </form>
</div>