<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\View\View;

class PhoneNumbers extends Controller
{
    public function index(): View
    {
        $countryCode = request()->query('country_code');
        $state = request()->query('state');

        /**
         * HINTs
         * 1- in case this filteration logic get more complex move it to service layer
         * 2- in case query get more complex logic move it to repository layer
         */
        $collection = Customer::query()
            ->when($countryCode && !$state, fn($q) => $q->whereCountryCode($countryCode))
            ->when(!$countryCode && $state, fn($q) => $q->wherePhoneState($state === 'valid'))
            ->when($countryCode && $state, fn($q) => $q->whereCountryCode($countryCode)->wherePhoneState($state === 'valid'))
            ->simplePaginate()
            ->withQueryString();

        return view('phone-numbers.index', [
            'collection' => $collection,
            'countries' => $this->countries(),
            'states' => $this->states(),
        ]);
    }


    private function countries(): array
    {
        return [
            '' => 'All',
            '237' => 'Cameroon',
            '251' => 'Ethiopia',
            '212' => 'Morocco',
            '258' => 'Mozambique',
            '256' => 'Uganda',
        ];
    }

    private function states(): array
    {
        return [
            '' => 'All',
            'valid' => 'Valid (OK)',
            'invalid' => 'Invalid (NOK)',
        ];
    }
}
