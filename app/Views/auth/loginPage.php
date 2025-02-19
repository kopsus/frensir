<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Login<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="flex flex-row h-screen w-full">
    <div class="bg-white flex flex-col h-full w-full">
        <div class="px-[88px] py-[55px] mb-[132px]">
            <img src="<?= base_url('assets/FrensirLogo.svg') ?>" alt="logo" />
        </div>
        <div class="px-[88px] mb-[58px]">
            <p class="font-bold text-[35px]">Welcome Back</p>
            <p class="font-regular text-gray-600">Please enter your credentials to access your account</p>
        </div>
        <form action="<?= base_url('/login') ?>" method="post">
            <div class="px-[88px] flex flex-col mb-[34px] gap-2">
                <div class="flex flex-row gap-2">
                    <img alt="user-icon" src="<?= base_url('assets/user-color.svg') ?>" />
                    <p class="font-reguler text-[14px] text-[#727984]">Username</p>
                </div>
                <div class="h-[42px] flex flex-row border rounded border-gray-300 px-4 py-3">
                    <img alt="password-icon" class="mr-2" src="<?= base_url('assets/user-gray.svg') ?>" />
                    <input type="text" id="username" name="username" class="w-full outline-none border-0" placeholder="Enter your username"/>
                </div>
            </div>
            <div class="px-[88px] flex flex-col mb-[37px] gap-2">
                <div class="flex flex-row gap-2">
                    <img alt="user-icon" src="<?= base_url('assets/lock-color.svg') ?>" />
                    <p class="font-reguler text-[14px] text-[#727984]">Password</p>
                </div>
                <div class="h-[42px] flex flex-row border rounded border-gray-300 px-4 py-3">
                    <img alt="password-icon" class="mr-2" src="<?= base_url('assets/lock-gray.svg') ?>" />
                    <input type="password" id="password" name="password" class="w-full outline-none border-0" placeholder="Enter your password" />
                </div>
            </div>
            <button class="px-[88px] hover:cursor-pointer h-[49px] w-full" type="submit">
                <div class="bg-[#8C0B40] w-full flex justify-center items-center py-[13px] rounded-lg">
                    <img src="<?= base_url('assets/login.svg') ?>" />
                </div>
            </button>
        </form>
    </div>
    <div class="relative bg-[#8C0B40] flex flex-col justify-center items-center w-full">
        <div class="w-[466px]">
            <p class="text-white font-extrabold mb-[18px] text-[39px] text-center">FRENSIR</p>
            <p class="text-white font-medium mb-[31px] text-[22px] text-center">Manage your business operations efficiently with our comprehensive dashboard</p>
            <div class="flex flex row justify-between">
                <div class="flex flex-col text-white text-center">
                    <p class="text-[35px] font-extrabold">1K+</p>
                    <p class="text-[18px] font-medium">Happy Customer</p>
                </div>
                <div class="flex flex-col text-white text-center">
                    <p class="text-[35px] font-extrabold">500+</p>
                    <p class="text-[18px] font-medium">Sales</p>
                </div>
                <div class="flex flex-col text-white text-center">
                    <p class="text-[35px] font-extrabold">24/7</p>
                    <p class="text-[18px] font-medium">Support</p>
                </div>
            </div>
        </div>
        <p class="text-white absolute bottom-[46px] right-[53px]">&copy; <span class="text-[20pxs] font-extrabold">Frensir</span></p>
    </div>
</div>
<?= $this->endSection() ?>
