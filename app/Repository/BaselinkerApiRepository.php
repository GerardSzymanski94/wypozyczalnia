<?php

namespace App\Repository;

use App\Models\Configuration;
use App\Product;
use Illuminate\Http\Request;

class BaselinkerApiRepository
{

    private $conf;

    public function __construct()
    {
        $this->conf = Configuration::where('id', '>', 0)->first();
    }


    private function getApiToken()
    {
        return '6037-11841-P9JUWFMHXXNFHUAZEHQFGWG8RVBBBP4TRZSM4IARNB318629Y0EB6PQG33L0LZ3E';
    }

    private function getPost($payload)
    {
        $host = "https://api.baselinker.com/connector.php";

        $postdata = http_build_query($payload);
        $ch = curl_init($host);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        $resultArray = json_decode($result, true);
        return $resultArray;
    }

    public function addOrder($order)
    {
        $user = $order->user;
        $parameters = [];
        $deposit = 0;
        $parameters['order_status_id'] = $this->conf->status_id;
        $parameters['date_add'] = strtotime($order->created_at);
        $parameters['user_comments'] = "user_comments";
        $parameters['admin_comments'] = "admin_comments";
        $parameters['phone'] = $user->phone;
        $parameters['email'] = $user->email;
        $parameters['user_login'] = $user->login;
        $parameters['currency'] = "PLN";
        $parameters['payment_method'] = "Przelew";
        $parameters['payment_method_cod'] = "0";
        $parameters['paid'] = "1";
        $parameters['delivery_method'] = $order->delivery->name;
        $parameters['delivery_price'] = $order->delivery->price;
        $parameters['delivery_fullname'] = $user->name . " " . $user->surname;
        $parameters['delivery_company'] = "Firma";
        $parameters['delivery_address'] = $user->address;
        $parameters['delivery_city'] = $user->city;
        $parameters['delivery_postcode'] = $user->zip_code;
        $parameters['delivery_country_code'] = "PL";
        $parameters['delivery_point_id'] = $order->delivery_additional;
        $parameters['delivery_point_name'] = $order->delivery_additional;
        $parameters['delivery_point_address'] = $order->delivery_address;
        $parameters['delivery_point_postcode'] = $order->delivery_city;
        $parameters['delivery_point_city'] = "";
        $parameters['invoice_fullname'] = $user->name_invoice;
        $parameters['invoice_company'] = "Firma";
        $parameters['invoice_nip'] = $user->nip_invoice;
        $parameters['invoice_address'] = $user->address_invoice;
        $parameters['invoice_city'] = $user->city_invoice;
        $parameters['invoice_postcode'] = $user->zip_code_invoice;
        $parameters['invoice_country_code'] = "PL";
        $parameters['extra_field_1'] = "1";
        $parameters['extra_field_2'] = "1";
        if ($order->invoice == 1) {
            $parameters['want_invoice'] = "1";
        } else {
            $parameters['want_invoice'] = "0";
        }
        foreach ($order->orderProducts as $orderProduct) {
            $pr = [];
            $pr["storage"] = "DB";
            $pr["storage_id"] = "1";
            $pr["product_id"] = $orderProduct->product->baselinker_id;
            // $pr["variant_id"] = "";
            $pr["name"] = $orderProduct->product->name;
            // $pr["sku"] = $orderProduct->product->sku;
            // $pr["ean"] = $orderProduct->product->ean;
            $pr["price_brutto"] = $orderProduct->price;
            $pr["tax_rate"] = "23";
            if ($orderProduct->product->status == 1) {
                $pr["quantity"] = $orderProduct->amount;
                $deposit += $orderProduct->product->deposit * $orderProduct->amount;
            } else {
                $pr["quantity"] = $orderProduct->amount_additional;
            }
            //$pr["weight"] = "";

            $parameters['products'][] = $pr;
        }

        $pr = [];
        $pr["storage"] = "DB";
        $pr["storage_id"] = "1";
        $pr["product_id"] = $this->conf->baselinker_deposit_id;
        $pr["name"] = "Kaucja zwrotna";
        $pr["price_brutto"] = $deposit;
        $parameters['products'][] = $pr;


        $payload = [
            'token' => $this->conf->baselinker_key,
            'method' => 'addOrder',
            'parameters' => json_encode($parameters)
        ];

        $return = $this->getPost($payload);

        return $return;
    }

    public function getOrderStatusList()
    {

        //bez danych wejściowych
        $payload = [
            'token' => $this->conf->baselinker_key,
            'method' => 'getOrderStatusList',
        ];

        $return = $this->getPost($payload);
        dd($return);
    }

    public function getProductsList($data = [])
    {

        $parameters = [];
        $parameters['storage_id'] = "1";
        /*if ($data->has('filter_category_id') && $data->filter_category_id != null)
            $parameters['filter_category_id'] = (int)$data->filter_category_id;
        if ($data->has('filter_limit') && $data->filter_limit != null)
            $parameters['filter_limit'] = $data->filter_limit;
        if ($data->has('filter_sort') && $data->filter_sort != null)
            $parameters['filter_sort'] = $data->filter_sort;
        if ($data->has('filter_id') && $data->filter_id != null)
            $parameters['filter_id'] = $data->filter_id;
        if ($data->has('filter_ean') && $data->filter_ean != null)
            $parameters['filter_ean'] = $data->filter_ean;
        if ($data->has('filter_sku') && $data->filter_sku != null)
            $parameters['filter_sku'] = $data->filter_sku;
        if ($data->has('filter_name') && $data->filter_name != null)
            $parameters['filter_name'] = $data->filter_name;
        if ($data->has('filter_price_from') && $data->filter_price_from != null)
            $parameters['filter_price_from'] = $data->filter_price_from;
        if ($data->has('filter_price_to') && $data->filter_price_to != null)
            $parameters['filter_price_to'] = $data->filter_price_to;
        if ($data->has('filter_quantity_from') && $data->filter_quantity_from != null)
            $parameters['filter_quantity_from'] = $data->filter_quantity_from;
        if ($data->has('filter_quantity_to') && $data->filter_quantity_to != null)
            $parameters['filter_quantity_to'] = $data->filter_quantity_to;
        if ($data->has('filter_available') && $data->filter_available != null)
            $parameters['filter_available'] = $data->filter_available;*/

        /*
                storage_id	int	Identyfikator magazynu. Może być to jeden z wielu magazynów produktów utworzonych przez klienta w BaseLinkerze, lub magazyn zewnętrznego sklepu internetowego.
                filter_category_id	varchar(30)	(nieobowiązkowe) Pobranie produktów z konkretnej kategorii (nieobowiązkowe)
                filter_limit	varchar(30)	(nieobowiązkowe) limit zwróconych kategorii w formacie SQLowym ("ilość pomijanych, ilość pobieranych")
                filter_sort	varchar(30)	(nieobowiązkowe) wartość po której ma być sortowana lista produktów. Możliwe wartości: "id [ASC|DESC]", "name [ASC|DESC]", "quantity [ASC|DESC]", "price [ASC|DESC]"
                filter_id	varchar(30)	(nieobowiązkowe) ograniczenie wyników do konkretnego id produktu
                filter_ean	varchar(320)	(nieobowiązkowe) ograniczenie wyników do konkretnego ean
                filter_sku	varchar(32)	(nieobowiązkowe) ograniczenie wyników do konkretnego sku (numeru magazynowego)
                filter_name	varchar(100)	(nieobowiązkowe) filtr nazw przedmiotów (fragment szukanej nazwy lub puste pole)
                filter_price_from	float	(nieobowiązkowe) dolne ograniczenie ceny (nie wyświetlane produkty z niższą ceną)
                filter_price_to	float	(nieobowiązkowe) górne ograniczenie ceny
                filter_quantity_from	int	(nieobowiązkowe) dolne ograniczenie ilości produktów
                filter_quantity_to	int	(nieobowiązkowe) górne ograniczenie ilości produktów
                filter_available	int	(nieobowiązkowe) wyświetlanie tylko produktów oznaczonych jako dostępne (wartość 1) lub niedostępne (0) lub wszystkich (pusta wartość)
         */

        $payload = [
            'token' => $this->conf->baselinker_key,
            'method' => 'getProductsList',
            'parameters' => json_encode($parameters)
        ];
        $return = $this->getPost($payload);

        dd($return);

        $products = [];


        return $products;
    }
}
