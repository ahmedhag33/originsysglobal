<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\JsonTrait;

class HotelsController extends Controller
{
    use JsonTrait;

    /**
     * Get Hotal By Name and Price and Date
     * 
     * @param string $hotel,$minPrice,$maxPrice,$fromDate,$toDate
     * 
     * @param int $minPrice
     * 
     * @param int $maxPrice
     * 
     * @param int $maxPrice
     * 
     * @param date $fromDate,$toDate
     * 
     * @param date $toDate
     * 
     * @return array
     */
    private function GetHotel($hotel, $city, $minPrice, $maxPrice, $fromDate, $toDate)
    {
        $result = [];

        $file = 'https://api.npoint.io/dd85ed11b9d8646c5709';
        
        $jsonitem = file_get_contents($file);

        $objitems = json_decode($jsonitem);

        $pricerange = array('min' => $minPrice, 'max' => $maxPrice);

        foreach ($objitems->hotels as $item) {
            foreach ($item->availability as $value) {
                if (
                    $item->name == $hotel &&
                    $item->city = $city &&
                    $item->price >= $pricerange['min'] &&
                    $item->price <= $pricerange['max'] &&
                    $value->from == $fromDate &&
                    $value->to == $toDate
                ) {
                    $hotelname = ['name' => $item->name];

                    $price = ['price' => $item->price];

                    $result[] = array_merge($hotelname, $price);
                }
            }
        }
        return $result;
    }

    /**
     * Get and poll hotel room search with range prices, date range.
     *
     * @param Illuminate\Http\Request $request
     * 
     * @return array
     */
    public function SearchHotel(Request $request)
    {
        try {
            $hotel = $request->hotel;

            $city = $request->city;

            $minPrice = $request->minPrice;

            $maxPrice = $request->maxPrice;

            $fromDate = $request->fromDate;

            $toDate   = $request->toDate;

            $search = $this->GetHotel($hotel, $city, $minPrice, $maxPrice, $fromDate, $toDate);

            if ($search) {
                $data = ['hotal' => $search];

                return $this->RequestSucessfulMessage($data);
            }
        } catch (Exception $e) {
            return $this->ErrorMessage($e->getMessage());
        }
    }
}
