<?php
namespace App\Traits;

use App\Enum\PhoneBook;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait PhoneBookComputedAttributes {
    public function phoneNumber(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (preg_match('/^\(\d+\)\s?(.*)$/', $this->phone, $matches)) {
                    return $matches[1];
                }

                return null;
            }
        );
    }

    public function stateLabel(): Attribute
    {
        return Attribute::make(
            get: function () {
                $code = $this->extractCountryCode();

                if (!$code) return 'NOK';

                $patterns = PhoneBook::countryCodesPatterns();

                return !isset($patterns[$code]) ? 'NOK' : (preg_match($patterns[$code], $this->phone) ? 'OK' : 'NOK');
            }
        );
    }


    public function countryName(): Attribute
    {
        return Attribute::make(
            get: function () {
                $code = $this->extractCountryCode();

                if (!$code) return '--';

                return PhoneBook::countryCodesAsKeyValue()[$code] ?? '--';
            }
        );
    }


    private function extractCountryCode(): ?string
    {
        if (preg_match('/^\((\d+)\)/', $this->phone, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
