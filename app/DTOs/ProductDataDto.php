<?php

namespace App\DTOs;

readonly class ProductDataDto
{
    public function __construct(
        public string $name,
        public string $description,
        public float  $price,
        public string $image,
        public string $url
    )
    {
    }

    public static function fromHtmlData(array $productHTML): self
    {
        return new self(
            name: $productHTML['name'],
            description: strlen($productHTML['description']) > 0 ? $productHTML['description'] : 'Pas de description disponible pour ce produit.',
            price: round($productHTML['offers']['price'], 2),
            image: $productHTML['image'],
            url: $productHTML['url']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'url' => $this->url,
        ];
    }
}
