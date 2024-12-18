<?= $this->extend('layouts/masterLayout'); ?>

<?= $this->section('main'); ?>
<div class="w-full flex flex-col gap-8 border border-gray-200 p-3 rounded-xl">
    <h1 class="font-bold text-2xl">Add Leave Form</h1>
    <?php if (session()->get('errors')): ?>
        <div class="bg-red-200 rounded-xl p-3">
            <ul>
                <?php foreach (session()->get('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="/leave/store"
        method="post"
        class="flex justify-between flex-col w-full gap-4 ">
        <?php csrf_field(); ?>
        <div class="flex gap-2">
            <label class="font-semibold min-w-32" for="nip">Employee</label>
            <input type="hidden" name="selected-ids" id="selected-ids">
            <textarea id="display-selected-nips"
                class="py-1 px-3 rounded border border-gray-200 w-full"
                readonly></textarea>
            <button data-modal-target="small-modal"
                data-modal-toggle="small-modal"
                class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                Search
            </button>
        </div>

        <!-- Modal -->
        <div id="small-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">

                <div class="relative bg-white rounded-lg shadow">

                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-medium text-gray-900">
                            Employee List
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                            data-modal-hide="small-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 space-y-4">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">No</th>
                                        <th scope="col" class="px-6 py-3">Select</th>
                                        <th scope="col" class="px-6 py-3">NIP</th>
                                        <th scope="col" class="px-6 py-3">Employee Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($employees as $employee): ?>
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                <?= $i++; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <input type="checkbox"
                                                    class="select-employee"
                                                    data-nip="<?= $employee['nip']; ?>"
                                                    data-id="<?= $employee['id']; ?>">
                                            </td>
                                            <td class="px-6 py-4">
                                                <?= $employee['nip']; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?= $employee['name']; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex items-center p-4 border-t rounded-b">
                        <button id="confirm-selection"
                            data-modal-hide="small-modal"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Confirm
                        </button>
                        <button data-modal-hide="small-modal"
                            type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-2">
            <label class="font-semibold min-w-32" for="leave_date">Leave Date</label>
            <input type="date" name="leave_date" id="leave_date" class="py-1 px-3 rounded border border-gray-200">
        </div>

        <div class="flex gap-2">
            <label class="font-semibold min-w-32" for="leave_duration">Leave Duration</label>
            <input type="number" name="leave_duration" id="leave_duration" readonly class="py-1 px-3 rounded border border-gray-200 bg-gray-200">
        </div>

        <div class="flex gap-2">
            <label class="font-semibold min-w-32" for="reason">Reason</label>
            <textarea name="reason" id="reason" class="py-1 px-3 rounded border border-gray-200"></textarea>
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

<script>
    document.getElementById('confirm-selection').addEventListener('click', function() {
        const selectedNips = [];
        const selectedIds = [];
        document.querySelectorAll('.select-employee:checked').forEach((checkbox) => {
            selectedNips.push(checkbox.dataset.nip);
            selectedIds.push(checkbox.dataset.id)
        });
        document.getElementById('selected-ids').value = selectedIds.join(',');
        document.getElementById('display-selected-nips').value = selectedNips.join(', ');
    });
</script>

<?= $this->endSection(); ?>