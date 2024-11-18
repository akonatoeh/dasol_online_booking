<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Booking::select('id', 'name', 'email', 'phone', 'checkin_date', 'checkout_date', 'status')
            ->whereIn('status', ['Ongoing', 'Finished'])
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Phone', 'Check-in Date', 'Check-out Date', 'Status'];
    }
}
