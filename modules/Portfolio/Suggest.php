<?php
namespace Modules\Portfolio;

use App\Models\User;
use App\Models\PortfolioByContry;
use App\Jobs\Job;

class Suggest extends Job
{

    public function __construct()
    {
    }

    public function handle(User $user, SuggestQueryParams $queryParams)
    {
        return PortfolioByContry::where(['CountryID' => $user->CountryID])
            ->firstOrFail()
            ->portfolio
            ->items
            ->first(function ($element) use($queryParams) {
                return [
                    'Type' => $element->Type,
                    'Size' => $element->Size,
                    'Age' => $element->Age,
                    'Weight' => $element->Weight,
                    'Needs' => $element->Needs
                ] === $queryParams->toArray();
            })
            ->product;
    }
}