<?php

use App\Models\MinecraftServer;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
    Cache::flush();
});

test('minecraft servers list page renders successfully', function () {
    Http::fake([
        '*' => Http::response([
            'online' => true,
            'motd' => ['clean' => ['Line 1', 'Line 2']],
            'players' => ['online' => 5, 'max' => 20],
            'version' => '1.20.1',
        ], 200),
    ]);

    $server = MinecraftServer::create([
        'name' => 'UNEMO Survival',
        'ip' => 'play.oxyda.id',
        'ports' => [
            ['type' => 'java', 'port' => 30188],
            ['type' => 'bedrock', 'port' => 30155],
        ],
        'is_active' => true,
    ]);

    $this->get(route('servers.index'))
        ->assertStatus(200)
        ->assertSee('UNEMO Survival')
        ->assertSee('play.oxyda.id')
        ->assertSee('Java: 30188')
        ->assertSee('Bedrock: 30155')
        ->assertSee('Line 1')
        ->assertSee('5 / 20')
        ->assertSee('1.20.1');
});

test('minecraft servers section displays on home page only if active servers exist', function () {
    // 1. Initially, no active servers, home page should not render the section
    $this->get(route('home'))
        ->assertStatus(200)
        ->assertDontSee('Minecraft Servers')
        ->assertDontSee('Gabung ke In-Game Server Kami');

    // 2. Create an active server
    MinecraftServer::create([
        'name' => 'UNEMO Creative',
        'ip' => 'creative.unemo.ac.id',
        'ports' => [['type' => 'java', 'port' => 25565]],
        'is_active' => true,
    ]);

    // 3. Section should now display
    $this->get(route('home'))
        ->assertStatus(200)
        ->assertSee('Minecraft Servers')
        ->assertSee('Gabung ke In-Game Server Kami')
        ->assertSee('UNEMO Creative')
        ->assertSee('creative.unemo.ac.id');
});
