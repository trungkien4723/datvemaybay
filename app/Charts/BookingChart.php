<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Booking;

class BookingChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        // if ($request->has('date_from') && $request->input('date_from') != '' && $request->has('date_to') && $request->input('date_to') != '') {
        //     $datefrom = $request->input('date_from');
        //     $dateto = $request->input('date_to');
        //     // $content = $content->where(function($query) use ($datefrom, $dateto){
        //     //                            $query->whereBetween('op_date',array($datefrom, $dateto));
        //     //                          });
        //     //$content = $content->whereBetween('create_at', [$datefrom, $dateto]);
        // }
        $dateFrom = $request->date_from; $dateTo = $request->date_to;
        $period = CarbonPeriod::create($dateFrom, $dateTo);

        $bookings = array();

        foreach ($period as $date) {
            $listOfDates[] = $date->format('d-m-y');
            array_push($bookings, Booking::whereDate('booked_time', '=', $date)->count());
        }

        return Chartisan::build()
            ->labels($listOfDates)
            ->dataset('vé đặt', $bookings);
    }
}