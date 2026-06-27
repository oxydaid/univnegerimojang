<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MinecraftPingService
{
    /**
     * Ping a Minecraft server and return its status, motd, version, players.
     */
    public function ping(string $ip, ?int $port = null): array
    {
        $address = $ip.($port ? ':'.$port : '');
        $cacheKey = 'mc_ping_'.md5($address);

        return Cache::remember($cacheKey, 60, function () use ($address, $ip, $port) {
            try {
                $response = Http::timeout(5)->get('https://api.mcsrvstat.us/3/'.urlencode($address));

                if ($response->successful()) {
                    $data = $response->json();

                    if (isset($data['online']) && $data['online'] === true) {
                        $motd = '';
                        if (isset($data['motd']['clean']) && is_array($data['motd']['clean'])) {
                            $motd = implode("\n", $data['motd']['clean']);
                        }

                        return [
                            'online' => true,
                            'motd' => $motd,
                            'players_online' => $data['players']['online'] ?? 0,
                            'players_max' => $data['players']['max'] ?? 0,
                            'version' => $data['version'] ?? 'Unknown',
                            'icon' => $data['icon'] ?? null,
                            'hostname' => $data['hostname'] ?? $ip,
                            'port' => $data['port'] ?? $port,
                        ];
                    }
                }
            } catch (\Throwable $e) {
                Log::error("Minecraft Ping failed for {$address}: ".$e->getMessage());
            }

            return [
                'online' => false,
                'motd' => 'Offline atau tidak dapat dijangkau',
                'players_online' => 0,
                'players_max' => 0,
                'version' => '-',
                'icon' => null,
                'hostname' => $ip,
                'port' => $port,
            ];
        });
    }
}
