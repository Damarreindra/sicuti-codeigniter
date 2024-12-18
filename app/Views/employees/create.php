<?= $this->extend('layouts/masterLayout'); ?>


<?= $this->section('main'); ?>
<div class="w-full flex flex-col gap-8 border border-gray-200 p-3 rounded-xl">
    <h1 class="font-bold text-2xl">Add Employee Form</h1>
    <?php if (session()->get('errors')): ?>
        <div class="bg-red-200 rounded-xl">
            <ul>
                <?php foreach (session()->get('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="/employee/store"
        method="post"
        class="flex justify-between flex-col w-full gap-4 ">
        <?php csrf_field(); ?>
        <div class="flex gap-2 ">
            <label class="font-semibold min-w-32 " for="nip">NIP</label>
            <input type="text"
                name="nip"
                id="nip"
                placeholder="Auto Generated NIP"
                readonly
                class="py-1 px-3 rounded border border-gray-200 bg-gray-300">

        </div>
        <div class="flex gap-2">

            <label class="font-semibold min-w-32" for="name">Employee Name</label>
            <input type="text"
                name="name"
                id="name"
                placeholder="Enter Name"
                class="py-1 px-3 rounded border border-gray-200">
        </div>
        <div class="flex gap-2">

            <label class="font-semibold min-w-32" for="gender">Gender</label>
            <select name="gender" id="gender"
                class="py-1 px-3 rounded border border-gray-200">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

        </div>
        <div class="flex gap-2">
            <label class="font-semibold min-w-32" for="phone">Phone</label>
            <input type="text"
                name="phone"
                id="phone"
                placeholder="Enter Phone Number"
                class="py-1 px-3 rounded border border-gray-200">
        </div>

        <div class="flex gap-2">

            <label class="font-semibold min-w-32" for="address">Address</label>
            <textarea name="address"
                id="address"

                class="py-1 px-3 rounded border border-gray-200">
            </textarea>
        </div>
        <div class="flex gap-2">
            <label class="font-semibold min-w-32" for="dob">Date of Birth</label>
            <input type="date"
                name="dob"
                id="dob"
                class="py-1 px-3 rounded border border-gray-200">
        </div>

        <div class="flex justify-end gap-4 mt-4">
            <button type="submit" class="py-2 px-4 bg-green-500 text-white font-semibold rounded hover:bg-green-600">
                Submit
            </button>
            <a href="/" class="py-2 px-4 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>

    </form>


</div>


<?= $this->endSection(); ?>