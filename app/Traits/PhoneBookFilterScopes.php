<?php

namespace App\Traits;

use App\Enum\PhoneBook;
use Illuminate\Database\Eloquent\Builder;

trait PhoneBookFilterScopes
{
    /**
     * Filter only by country code.
     */
    public function scopeWhereCountryCode(Builder $query, string $code): Builder
    {
        // Matches (212)...
        $escaped = preg_quote($code, '/');
        return $query->where('phone', 'REGEXP', "^\\($escaped\\)");
    }

    /**
     * Filter by phone state (valid or invalid) across all countries.
     */
    public function scopeWherePhoneState(Builder $query, bool $isValid): Builder
    {
        $patterns = PhoneBook::countryCodesPatterns();

        return $query->where(function ($q) use ($patterns, $isValid) {
            foreach ($patterns as $regex) {
                $pattern = $this->cleanPattern($regex);

                if ($isValid) {
                    // valid: matches any pattern
                    $q->orWhere('phone', 'REGEXP', $pattern);
                } else {
                    // invalid: must fail all patterns
                    $q->where('phone', 'NOT REGEXP', $pattern);
                }
            }
        });
    }

    /**
     * Remove surrounding slashes if present.
     */
    private function cleanPattern(string $pattern): string
    {
        return trim($pattern, '/');
    }
}
