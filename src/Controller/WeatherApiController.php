<?php

namespace App\Controller;

use App\Entity\Measurment;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherApiController extends AbstractController
{
    #[Route('/api/v1/weather', name: 'app_weather_api', methods: ['GET'])]
    public function index(
        WeatherUtil $util,
        #[MapQueryParameter] string $country,
        #[MapQueryParameter] string $city,
        #[MapQueryParameter(filter: \FILTER_VALIDATE_REGEXP, options: ['regexp' => '/^(json|csv)$/'])]
        string $format = 'json',
        #[MapQueryParameter('twig')] bool $twig = false,
    ): Response {
        $measurements = $util->getWeatherForCountryAndCity($country, $city);

        if ($format === 'csv') {
            if ($twig) {
                return $this->render(
                    'weather_api/index.csv.twig',
                    [
                        'city' => $city,
                        'country' => $country,
                        'measurements' => $measurements,
                    ],
                    new Response('', Response::HTTP_OK, ['Content-Type' => 'text/csv'])
                );
            }

            $lines = ['city,country,date,celsius,fahrenheit'];

            foreach ($measurements as $m) {
                $lines[] = implode(',', [
                    $city,
                    $country,
                    $m->getDate()->format('Y-m-d'),
                    $m->getCelsius(),
                    $m->getFahrenheit(),
                ]);
            }

            return new Response(
                implode("\n", $lines),
                Response::HTTP_OK,
                ['Content-Type' => 'text/csv']
            );
        }

        if ($twig) {
            return $this->render(
                'weather_api/index.json.twig',
                [
                    'city' => $city,
                    'country' => $country,
                    'measurements' => $measurements,
                ],
                new Response('', Response::HTTP_OK, ['Content-Type' => 'application/json'])
            );
        }

        return $this->json([
            'city' => $city,
            'country' => $country,
            'measurements' => array_map(fn(Measurment $m) => [
                'date' => $m->getDate()->format('Y-m-d'),
                'celsius' => $m->getCelsius(),
                'fahrenheit' => $m->getFahrenheit(),
            ], $measurements),
        ]);
    }
}
