<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Wallet Withdrawals') }}
            </h2>
        </div>
    </x-slot>

    <x-content-container>
        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>#</x-table.th>
                    <x-table.th>Total Amount</x-table.th>
                    <x-table.th>Date</x-table.th>
                    <x-table.th>User</x-table.th>
                    <x-table.th>Status</x-table.th>
                    <x-table.th></x-table.th>
                </tr>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($withdrawals_transactions as $transaction)
                    <tr>
                        <x-table.td>
                            <svg width="46" height="46" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M19 10.2798V17.4298C18.97 20.2798 18.19 20.9998 15.22 20.9998H5.78003C2.76003 20.9998 2 20.2498 2 17.2698V10.2798C2 7.5798 2.63 6.7098 5 6.5698C5.24 6.5598 5.50003 6.5498 5.78003 6.5498H15.22C18.24 6.5498 19 7.2998 19 10.2798Z"
                                    fill="#292D32" />
                                <path
                                    d="M22 6.73V13.72C22 16.42 21.37 17.29 19 17.43V10.28C19 7.3 18.24 6.55 15.22 6.55H5.78003C5.50003 6.55 5.24 6.56 5 6.57C5.03 3.72 5.81003 3 8.78003 3H18.22C21.24 3 22 3.75 22 6.73Z"
                                    fill="#292D32" />
                                <path
                                    d="M6.96027 18.5601H5.24023C4.83023 18.5601 4.49023 18.2201 4.49023 17.8101C4.49023 17.4001 4.83023 17.0601 5.24023 17.0601H6.96027C7.37027 17.0601 7.71027 17.4001 7.71027 17.8101C7.71027 18.2201 7.38027 18.5601 6.96027 18.5601Z"
                                    fill="#292D32" />
                                <path
                                    d="M12.5494 18.5601H9.10938C8.69938 18.5601 8.35938 18.2201 8.35938 17.8101C8.35938 17.4001 8.69938 17.0601 9.10938 17.0601H12.5494C12.9594 17.0601 13.2994 17.4001 13.2994 17.8101C13.2994 18.2201 12.9694 18.5601 12.5494 18.5601Z"
                                    fill="#292D32" />
                                <path d="M19 11.8599H2V13.3599H19V11.8599Z" fill="#292D32" />
                            </svg>
                        </x-table.td>
                        <x-table.td>
                            <h3 class="text-xl font-bold text-indigo-950">Rp
                                {{ number_format($transaction->amount, 0, ',', '.') }}</h3>
                        </x-table.td>
                        <x-table.td>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $transaction->created_at->format('M d, Y') }}</h3>
                        </x-table.td>
                        <x-table.td>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $transaction->user->name }}</h3>
                        </x-table.td>
                        <x-table.td>
                            @if ($transaction->is_paid)
                                <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                                    PAID
                                </span>
                            @else
                                <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                                    PENDING
                                </span>
                            @endif
                        </x-table.td>
                        <x-table.td>
                            <a href="{{ route('admin.wallet_transactions.show', $transaction) }}"
                                class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                View Details
                            </a>
                        </x-table.td>
                    </tr>
                @endforeach
            </x-table.tbody>
        </x-table>
    </x-content-container>
</x-app-layout>
