@extends('layout')

@section('utility')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
@endsection

@section('content')
<div class="bg-white bg-opacity-50 p-5 rounded-lg dark:bg-slate-900 dark:bg-opacity-80 mx-auto">
    <h3 class="text-center uppercase py-6 text-4xl font-bold dark:text-white">Reports</h3>

    <table id="selection-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        No
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Customer Name
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>

                <th>
                    <span class="flex items-center">
                        Customer Email
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>

                <th>
                    <span class="flex items-center">
                        Customer Address
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>

                <th>
                    <span class="flex items-center">
                        Customer Phone
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Action
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @php
                            $name = Illuminate\Support\Str::limit($customer->customer_name, 30, '...');
                        @endphp
                        {{ $name}}
                    </td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $customer->customer_email }}
                    </td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @php
                        $address = Illuminate\Support\Str::limit($customer->customer_address, 30, '...');
                        @endphp
                        {{ $address }}
                    </td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $customer->customer_phone }}
                    </td>
                    <td class="">
                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" onclick="showPurchases({{ $customer->id }})">
                            Show Purchases
                        </button>
                        <div id="purchases-{{ $customer->id }}" class="hidden">
                            @foreach ($customer->purchases as $purchase)
                                <div class="purchase-item">
                                    <span class="purchase-date">{{ $purchase->purchase_date }}</span>
                                    <span class="purchase-price">{{ $purchase->total_price }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>



    <!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Purchases
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4 text-black dark:text-white" id="modal-body">
              
            </div>
           
        </div>
    </div>
</div>


</div>


@endsection


@section('scripts')
<script>
    // if you installed via CDN
    const dataTable = new simpleDatatables.DataTable("#selection-table");



    function showPurchases(customerId) {
        const purchasesDiv = document.getElementById(`purchases-${customerId}`);
        const purchases = purchasesDiv.querySelectorAll('.purchase-item');

        let purchasesTable = '<table class="min-w-full divide-y divide-gray-200"><thead><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th></tr></thead><tbody>';

        purchases.forEach(purchase => {
            const date = purchase.querySelector('.purchase-date').innerText;
            const price = purchase.querySelector('.purchase-price').innerText;
            purchasesTable += `<tr><td class="px-6 py-4 whitespace-nowrap">${date}</td><td class="px-6 py-4 whitespace-nowrap">${price}</td></tr>`;
        });

        purchasesTable += '</tbody></table>';
        document.getElementById('modal-body').innerHTML = purchasesTable;

    }
</script>
@endsection