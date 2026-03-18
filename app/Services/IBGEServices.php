<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class IBGEServices
{
    public static function buscaCep(string $search): array
    {
        if (empty($search)) {
            return [];
        }

        /** @var Response $response */
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get('https://viacep.com.br/ws/' . $search . '/json/');

        if ($response->failed()) {
            return [];
        }

        $data = $response->json();

        // ViaCEP retorna {"erro": true} quando o CEP não existe
        if (isset($data['erro']) && $data['erro'] === true) {
            return [];
        }

        return $data ?? [];
    }

    public static function ufs(): array
    {
        return cache()->remember('ibge_ufs', now()->addDay(), function () {
            /** @var Response $response */
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');

            if ($response->failed()) {
                return [];
            }

            $estados = $response->json() ?? [];

            $opcoes = [];

            if (is_array($estados)) {
                foreach ($estados as $estado) {
                    $opcoes[$estado['sigla']] = $estado['nome'];
                }
            }

            // Ordena alfabeticamente pelo nome do estado
            asort($opcoes);

            return $opcoes;
        });
    }

    public static function cidadesPorUf(string $uf): array
    {
        return cache()->remember("ibge_cidades_{$uf}", now()->addDay(), function () use ($uf) {
            /** @var Response $response */
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios?orderBy=nome");

            if ($response->failed()) {
                return [];
            }

            $cidades = $response->json() ?? [];

            $opcoes = [];
            if (is_array($cidades)) {
                foreach ($cidades as $cidade) {
                    $opcoes[$cidade['nome']] = $cidade['nome'];
                }
            }

            return $opcoes;
        });
    }
}
