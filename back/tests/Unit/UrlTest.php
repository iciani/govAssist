<?php

namespace Tests\Unit\Api\V1;

use App\Enums\UrlStates;
use App\Helpers\TestsHelper;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UrlTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testGetIndexUrls(): void
    {
        $this->assertEquals(0, Url::all()->count());
        $cant = 2;
        $urls = Url::factory($cant)->create();
        $response = $this->actingAs($this->user)->get("/api/urls");
        TestsHelper::dumpApiResponsesWithErrors($response);
        $jsonResponse = json_decode($response->getContent(), true);
        $response->assertStatus(Response::HTTP_OK)->assertJsonStructure(
            [
                "data",
                "links",
                "meta"
            ]
        )->assertJsonPath('data', UrlResource::collection($urls)->toArray(new \Illuminate\Http\Request()));
        $this->assertEquals($cant, count($jsonResponse['data']));
    }

    public function testStoreUrls(): void
    {
        $this->assertEquals(0, Url::all()->count());
        $data = [
            'destination' => $this->faker->url(),
            'description' => $this->faker->paragraph(rand(10, 20))
        ];
        $response = $this->actingAs($this->user)->post("/api/urls", $data);
        TestsHelper::dumpApiResponsesWithErrors($response);
        $url = Url::firstOrFail();
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'success' => true,
                'data' => (new UrlResource($url))->toArray(new \Illuminate\Http\Request())
            ]);
    }

    public function testStateEditUrls(): void
    {
        $this->assertEquals(0, Url::all()->count());
        $originalUrlObject = Url::factory()->create();
        $this->assertEquals($originalUrlObject->state, UrlStates::ACTIVE->value);
        $data = [
            'id' => 1,
            'state' => UrlStates::INACTIVE->value
        ];
        $response = $this->actingAs($this->user)->post("/api/urls/state", $data);
        TestsHelper::dumpApiResponsesWithErrors($response);
        $editedUrlObject = Url::firstOrFail();
        $response->assertStatus(Response::HTTP_OK)->assertJson(['success' => true]);
        $this->assertEquals($editedUrlObject->state, UrlStates::INACTIVE->value);
    }
}
