<?php
// Contoh data array
$items = [
    [
        'name' => 'Big Burger XL',
        'price' => 25000,
        'desc'  => 'a',
        'qty'   => 1,
        'img'   => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrhaG2AttXH93ENiDs7yJPU6gzSLBHlkQ0QA&s'
    ],
    [
        'name' => 'Cheese Burger',
        'price' => 30000,
        'desc'  => 'b',
        'qty'   => 2,
        'img'   => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrhaG2AttXH93ENiDs7yJPU6gzSLBHlkQ0QA&s'
    ],
    [
        'name' => 'Cheese Burger',
        'price' => 30000,
        'desc'  => 'b',
        'qty'   => 2,
        'img'   => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrhaG2AttXH93ENiDs7yJPU6gzSLBHlkQ0QA&s'
    ],
    [
        'name' => 'Chicken Burger JUMBOO',
        'price' => 20000,
        'desc'  => 'c',
        'qty'   => 1,
        'img'   => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrhaG2AttXH93ENiDs7yJPU6gzSLBHlkQ0QA&s'
    ],
];
?>

<div class="relative min-h-screen">
    <div class="py-10 px-4">
        <div class="absolute top-10 left-0 w-[203px] bg-[#FFFBF0] h-[49px] content-center text-center rounded-r-lg">
            <p class="relative font-bold text-[18px]">Current Order</p>
        </div>
        <div class="relative z-30 overflow-x-hidden overflow-y-auto mt-[84px] h-[696px] hitespace-normal">
        <?php for ($i = 0; $i < count($items); $i++): ?>
            <?php
                $item = $items[$i];
                // Cek posisi item di array
                $isFirst = ($i === 0);
                $isLast  = ($i === count($items) - 1);
            ?>
            <?php if ($isFirst): ?>
                <!-- (1) content top as first of array data -->
                <div class="relative flex w-full flex-col gap-4 rounded-t-2xl bg-[#FFFBF0] px-4 pt-4">
                    <div class="flex flex-row gap-4">
                        <div class="w-2/4 place-items-center">
                            <img class="w-[67px] h-[67px] object-cover" src="<?= $item['img'] ?>" />
                        </div>
                        <div class="flex w-2/1 flex-col">
                            <div class="mb-6 flex w-full justify-between font-semibold">
                                <p><?= $item['name'] ?></p>
                                <p>button</p>
                            </div>
                            <div class="relative flex flex-row">
                                <p>
                                <span class="font-bold text-[#8C0B40]">Rp<?= number_format($item['price'], 0, ',', '.') ?> </span>
                                <span class="text-gray-400">/pc</span>
                                </p>
                                <p class="ml-4 text-gray-400"><?= $item['desc'] ?></p>
                                <p class="absolute right-2">x<?= $item['qty'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="h-10">
                        <div class="absolute left-0 bottom-0 h-10 w-5 rounded-r-full bg-[#EAE1C0]"></div>
                        <div class="absolute w-full bottom-5 flex items-center">
                        <div class="w-full border border-dashed border-[#EAE1C0]"></div>
                        </div>
                        <div class="absolute right-0 bottom-0 h-10 w-5 rounded-l-full bg-[#EAE1C0]"></div>
                    </div>
                </div>
            <?php elseif ($isLast): ?>
                <!-- (3) when as a last item on array data -->
                <div class="relative flex w-full flex-col gap-4 bg-[#FFFBF0] px-4 pt-4">
                    <div class="flex flex-row gap-4">
                        <div class="w-2/4 place-items-center">
                            <img class="w-[67px] h-[67px] object-cover" src="<?= $item['img'] ?>" />
                        </div>
                        <div class="flex w-2/1 flex-col">
                        <div class="mb-6 flex w-full justify-between font-semibold">
                            <p><?= $item['name'] ?></p>
                            <p>button</p>
                        </div>
                        <div class="relative flex flex-row h-[50px]">
                            <p>
                                <span class="font-bold text-[#8C0B40]">Rp<?= number_format($item['price'], 0, ',', '.') ?> </span>
                                <span class="text-gray-400">/pc</span>
                            </p>
                            <p class="ml-4 text-gray-400"><?= $item['desc'] ?></p>
                            <p class="absolute right-2">x<?= $item['qty'] ?></p>
                        </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- (2) array data when its not as a first or last item on array -->
                <div class="relative flex w-full flex-col gap-4 bg-[#FFFBF0] px-4 pt-4">
                <div class="flex flex-row gap-4">
                    <div class="w-2/4 place-items-center">
                    <img class="w-[67px] h-[67px] object-cover" src="<?= $item['img'] ?>" />
                    </div>
                    <div class="flex w-2/1 flex-col">
                    <div class="mb-6 flex w-full justify-between font-semibold">
                        <p><?= $item['name'] ?></p>
                        <p>button</p>
                    </div>
                    <div class="relative flex flex-row">
                        <p>
                        <span class="font-bold text-[#8C0B40]">Rp<?= number_format($item['price'], 0, ',', '.') ?> </span>
                        <span class="text-gray-400">/pc</span>
                        </p>
                        <p class="ml-4 text-gray-400"><?= $item['desc'] ?></p>
                        <p class="absolute right-2">x<?= $item['qty'] ?></p>
                    </div>
                    </div>
                </div>
                <div class="h-10">
                    <div class="absolute left-0 bottom-0 h-10 w-5 rounded-r-full bg-[#EAE1C0]"></div>
                    <div class="absolute w-full bottom-5 flex items-center">
                    <div class="w-full border border-dashed border-[#EAE1C0]"></div>
                    </div>
                    <div class="absolute right-0 bottom-0 h-10 w-5 rounded-l-full bg-[#EAE1C0]"></div>
                </div>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
        <div>
            <!-- (4) total items -->
            <div class="w-full bg-white flex flex-col gap-3 rounded-b-2xl">
                <div class="flex flex-row w-full justify-between font-semibold pt-4 px-20">
                    <p>Subtotal</p>
                    <p>Rp100.000</p>
                </div>
                <div class="flex flex-row w-full justify-between font-semibold px-20">
                    <p>Total Sales Tax</p>
                    <p>Rp50.000</p>
                </div>
                <div class="relative h-10">
                    <div class="absolute left-0 bottom-0 h-10 w-5 rounded-r-full bg-[#EEECE9] z-10"></div>
                    <div class="absolute w-full bottom-5 flex items-center justify-center">
                    <div class="w-full border border-dashed border-[#EAE1C0]"></div>
                    </div>
                    <div class="absolute right-0 bottom-0 h-10 w-5 rounded-l-full bg-[#EEECE9] z-10"></div>
                </div>
                <div class="flex justify-between h-12 px-20 font-bold text-[16px] rounded-2xl">
                    <p>Total</p>
                    <p>Rp150.000</p>
                </div>
            </div>
        </div>
    </div>
    <div class="z-10 absolute bottom-0 left-0 rounded-t-3xl w-full bg-[#EEECE9] h-[400px]"></div>
</div>