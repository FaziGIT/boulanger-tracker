<?php

namespace App\Services;

use App\DTOs\ProductDataDto;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductScrapingService
{
    /**
     * Grab and parse data with DTO
     *
     * @param string $url
     * @return array
     */
    public function fetchAndParseProductData(string $url): array
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                'Accept-Language' => 'en-US,en;q=0.9,fr;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br, zstd',
            ])->get($url);

            if ($response->successful()) {
                try {
                    // Parse le HTML pour extraire les données JSON-LD
                    $pattern = '/<script\s+type="application\/ld\+json">(.*?)<\/script>/is';
                    preg_match_all($pattern, $response->body(), $matches);

                    if (!isset($matches[1][2])) {
                        return [
                            'success' => false,
                            'error' => 'Impossible de trouver les données du produit dans la page.',
                        ];
                    }

                    $productHTML = json_decode($matches[1][2], true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return [
                            'success' => false,
                            'error' => 'Erreur lors du parsing des données JSON.',
                        ];
                    }

                    $dto = ProductDataDto::fromHtmlData($productHTML);

                    return [
                        'success' => true,
                        'dto' => $dto,
                    ];

                } catch (\Exception $e) {
                    Log::error('Erreur lors du parsing des données produit', [
                        'url' => $url,
                        'error' => $e->getMessage(),
                    ]);

                    return [
                        'success' => false,
                        'error' => 'Erreur lors du traitement des données du produit.',
                    ];
                }
            }

            return [
                'success' => false,
                'error' => 'Impossible de récupérer les informations du produit à partir de l\'URL fournie. Veuillez vérifier l\'URL et réessayer.',
                'status_code' => $response->status(),
            ];

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des données produit', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'Une erreur est survenue lors de la récupération des données.',
            ];
        }
    }
}
