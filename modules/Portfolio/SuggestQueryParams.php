<?php
namespace Modules\Portfolio;

use Modules\Portfolio\PortfolioItem\Type;
use Modules\Portfolio\PortfolioItem\Size;
use Modules\Portfolio\PortfolioItem\Age;
use Modules\Portfolio\PortfolioItem\Weight;
use Modules\Portfolio\PortfolioItem\Needs;

class SuggestQueryParams
{

    public function __construct(
        public string $type,
        public string $size,
        public string $age,
        public string $weight,
        public string $needs
    ) {

        $this->type = Type::isValid($type) ? $type : throw new \Exception("Argumento invalido");
        $this->size = Size::isValid($size) ? $size : throw new \Exception("Argumento invalido");
        $this->age = Age::isValid($age) ? $age : throw new \Exception("Argumento invalido");
        $this->weight = Weight::isValid($weight) ? $weight : throw new \Exception("Argumento invalido");
        $this->needs = Needs::isValid($needs) ? $needs : throw new \Exception("Argumento invalido");
    }

    public function toArray() {
        return [
            'Type' => $this->type,
            'Size' => $this->size,
            'Age' => $this->age,
            'Weight' => $this->weight,
            'Needs' => $this->needs
        ];
    }
}