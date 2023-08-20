<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FileReader
{
    /**
     * @var string
     */
    private $addresses;

    public function __construct(
        private string $filePath,
    ){}

    private function readFile()
    {
        $file = file_exists($this->filePath) ?
            json_decode(file_get_contents($this->filePath), true)
            : null;

        $this->setMessages($file['Entries']);

        return $file;
    }

    public function setMessages($file)
    {
        return $this->addresses = call_user_func_array(
            'array_merge',
            array_values($file ?? [])
        );
    }

    private function getCities()
    {
        $data = $this->readFile()['Entries']['Entry'];
        $messages = null;
        foreach ($data as $item) {
            $messages .= "{$item['message']} ";
        }
        return $messages;
    }

    public function getLocationsMap()
    {
        $messages = $this->getCities();
        //dd($messages);
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?';
        $url .= http_build_query([
            'address' => $messages,
            'key' => env('GOOGLE_MAP_KEY'),
        ]);
        $response = Http::get($url);

        $locations = $response->json();
        if ($response->successful() && isset($locations['results'])) {
            $locations = $locations['results'];
            return $this->getLocationsAccordingCity($locations);
        }

        return response()->json(['message' => 'some thing error'], 400);
    }


    private function getLocationsAccordingCity(array $locations)
    {
        $transformedCollection = collect($locations)->map(function ($location) {
            $address = collect($this->addresses)->filter(
                fn($address) => Str::contains(
                    $address['message'],
                    $location['address_components'][0]['short_name']
                ))->first();
            return [
                'name' => $location['address_components'][0]['short_name'],
                'sentiment' => $address['sentiment'],
                'message' => $address['message'],
                'location' => $location['geometry']['location'],
                'marker_color' => $this->getSentimentStatus($address['sentiment']),
            ];
        })->filter(
            fn($item) => request('status') ? $item['sentiment'] === request('status') : true
        );

        return $transformedCollection->all();
    }


    private function getSentimentStatus($status)
    {
        return match ($status) {
            'Positive' => 'green',
            'Neutrual' => 'yellow',
            'Negative' => 'red',
            default => 'black'
        };
    }
}
