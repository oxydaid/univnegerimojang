<?php

namespace App\Livewire\Landing;

use App\Models\MinecraftServer;
use App\Services\MinecraftPingService;
use Livewire\Component;

class ServerList extends Component
{
    public function render(MinecraftPingService $pingService)
    {
        $servers = MinecraftServer::where('is_active', true)->get();

        $serversWithStatus = $servers->map(function ($server) use ($pingService) {
            $ports = $server->ports ?? [];
            $javaPort = collect($ports)->firstWhere('type', 'java')['port'] ?? null;
            $bedrockPort = collect($ports)->firstWhere('type', 'bedrock')['port'] ?? null;

            $pingPort = $javaPort ?? $bedrockPort;
            $status = $pingService->ping($server->ip, $pingPort ? (int) $pingPort : null);

            return [
                'id' => $server->id,
                'name' => $server->name,
                'ip' => $server->ip,
                'ports' => $ports,
                'status' => $status,
            ];
        });

        return view('livewire.landing.server-list', [
            'servers' => $serversWithStatus,
        ])->title('Server Minecraft | UNEMO');
    }
}
