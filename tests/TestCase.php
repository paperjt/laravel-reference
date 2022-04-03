<?php

namespace Tests;

use EnricoStahn\JsonAssert\Assert as JsonAssert;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        TestResponse::macro('assertSchemaCollection', function (string $name) {
            $data = json_decode($this->content(), false);

            if (!empty($data)) {
                $data = $data->data;
            }

            foreach ($data as $datum) {
                JsonAssert::assertJsonMatchesSchema(
                    $datum,
                    base_path('tests/Schemas/' . $name)
                );
            }
        });

        TestResponse::macro('assertSchemaResource', function (string $name) {
            $data = json_decode($this->content(), false);

            if (!empty($data)) {
                $data = $data->data;
            }

            JsonAssert::assertJsonMatchesSchema(
                $data,
                base_path('tests/Schemas/' . $name)
            );
        });
    }
}
