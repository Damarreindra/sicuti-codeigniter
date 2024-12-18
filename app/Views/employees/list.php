<?= $this->extend('layouts/masterLayout'); ?>


<?= $this->section('main'); ?>
<div class="w-full flex flex-col gap-8">
    <h1 class="font-bold text-2xl">Employee List</h1>
    <form action="/"
        method="get"
        class="flex justify-between w-full">
        <div class="flex flex-col gap-2">
            <label class="font-semibold " for="nip">Search By NIP</label>
            <input type="text"
                name="nip"
                id="nip"
                placeholder="Enter NIP"
                class="py-1 px-3 rounded border border-gray-200">

        </div>
        <div class="flex flex-col gap-2">

            <label class="font-semibold " for="name">Search By Name</label>
            <input type="text"
                name="name"
                id="name"
                placeholder="Enter Name"
                class="py-1 px-3 rounded border border-gray-200">
        </div>
        <button class="bg-green-500 flex items-center justify-center font-semibold text-white px-5 py-1">Search </button>
    </form>

    <section>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <?php if (empty($employees)): ?>
                <p>No employees found.</p>
            <?php else: ?>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIP
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Employee Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gender
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $startIndex = ($pager->getCurrentPage('default') - 1) * $pager->getPerPage('default') + 1;
                        ?>
                        <?php foreach ($employees as $employee): ?>


                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $startIndex++; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?= $employee['nip']; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $employee['name']; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $employee['gender']; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $employee['phone_number']; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $employee['address']; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="#" class="font-medium text-red-500 hover:underline">Delete</a>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= $pager->links(); ?>
            <?php endif; ?>
        </div>
        <div class="flex justify-end mt-4">
            <a href="/employee/create">
                <button class="p-3 text-white bg-green-500 font-semibold flex items-center justify-center ">
                    Add New
                </button>
            </a>
        </div>
    </section>
</div>


<?= $this->endSection(); ?>