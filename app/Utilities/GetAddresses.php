<?php

namespace App\Utilities;

use App\Address;
use DateTime;
use DateTimeZone;

class GetAddresses
{
    public static function get_search_address($request) {
        $address = null;
        switch ($request->option) {
                case 'name_id':
                    if (is_numeric($request->search)) {
                        $address = Address::where('id',$request->search)->get();
                    }
                    else {
                        $address = Address::where('name','like','%'.$request->search.'%')->get();
                    }
                    break;
                case 'pin': $address = Address::where('pin','like','%'.$request->search.'%')->get();
                break;
                case 'phone': $address = Address::where('phone','like','%'.$request->search.'%')->get();
                break;
                case 'address': $address = Address::where('address','like','%'.$request->search.'%')->get();
                break;
                case 'po': $address = Address::where('city','like','%'.$request->search.'%')->get();//po is stored as city in database
                break;
                case 'creation_month':
                $date = new DateTime($request->start_year."-".$request->start_month."-01");
                $date_end = new DateTime($request->start_year."-".$request->start_month."-".$date->format('t')." 23:59:59");
                $date->setTimezone(new DateTimeZone("UTC"));
                $date_end->setTimezone(new DateTimeZone("UTC"));
                $address = Address::where([['created_at','>=',$date],['created_at','<=',$date_end]])->get();
                break;
                default:$address = array('error'=>True,'message'=>'Sorry couldn\'t search. Contact Admin');
                    break; 
            }
        return $address;
    }
}
?>