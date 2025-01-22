<?php
namespace App\Helpers;

class ChartHelper
{
    public static function generatePieChartUrl($data, $labels, $colors)
    {
        $chartConfig = [
            'type' => 'pie',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'data' => $data,
                        'backgroundColor' => $colors,
                    ],
                ],
            ],
            'options' => [
                'legend' => [
                    'display' => true,
                    'fontSize' => 8,
                ],
            ],
        ];

        $chartUrl = 'https://quickchart.io/chart?width=270&height=180&c=' . urlencode(json_encode($chartConfig));
        return $chartUrl;
    }

    public static function generateBarChartUrl($data, $labels, $colors)
    {
        $chartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'data' => $data,
                        'backgroundColor' => $colors,
                    ],
                ],
            ],
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'stepSize' => 1,
                                'fontSize' => 8,
                            ],
                        ],

                    ],
                    'xAxes' => [
                        [
                            'ticks' => [
                                'fontSize' => 8,
                            ],
                        ],
                    ],
                ],
                'legend' => [
                    'display' => false,
                    'fontSize' => 8,
                ],
            ],
        ];

        $chartUrl = 'https://quickchart.io/chart?width=270&height=195&c=' . urlencode(json_encode($chartConfig));
        return $chartUrl;
    }
}