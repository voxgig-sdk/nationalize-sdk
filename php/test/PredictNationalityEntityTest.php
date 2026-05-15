<?php
declare(strict_types=1);

// PredictNationality entity test

require_once __DIR__ . '/../nationalize_sdk.php';
require_once __DIR__ . '/Runner.php';

use PHPUnit\Framework\TestCase;
use Voxgig\Struct\Struct as Vs;

class PredictNationalityEntityTest extends TestCase
{
    public function test_create_instance(): void
    {
        $testsdk = NationalizeSDK::test(null, null);
        $ent = $testsdk->PredictNationality(null);
        $this->assertNotNull($ent);
    }

    public function test_basic_flow(): void
    {
        $setup = predict_nationality_basic_setup(null);
        // Per-op sdk-test-control.json skip.
        $_live = !empty($setup["live"]);
        foreach (["load"] as $_op) {
            [$_shouldSkip, $_reason] = Runner::is_control_skipped("entityOp", "predict_nationality." . $_op, $_live ? "live" : "unit");
            if ($_shouldSkip) {
                $this->markTestSkipped($_reason ?? "skipped via sdk-test-control.json");
                return;
            }
        }
        // The basic flow consumes synthetic IDs from the fixture. In live mode
        // without an *_ENTID env override, those IDs hit the live API and 4xx.
        if (!empty($setup["synthetic_only"])) {
            $this->markTestSkipped("live entity test uses synthetic IDs from fixture — set NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID JSON to run live");
            return;
        }
        $client = $setup["client"];

        // Bootstrap entity data from existing test data.
        $predict_nationality_ref01_data_raw = Vs::items(Helpers::to_map(
            Vs::getpath($setup["data"], "existing.predict_nationality")));
        $predict_nationality_ref01_data = null;
        if (count($predict_nationality_ref01_data_raw) > 0) {
            $predict_nationality_ref01_data = Helpers::to_map($predict_nationality_ref01_data_raw[0][1]);
        }

        // LOAD
        $predict_nationality_ref01_ent = $client->PredictNationality(null);
        $predict_nationality_ref01_match_dt0 = [];
        [$predict_nationality_ref01_data_dt0_loaded, $err] = $predict_nationality_ref01_ent->load($predict_nationality_ref01_match_dt0, null);
        $this->assertNull($err);
        $this->assertNotNull($predict_nationality_ref01_data_dt0_loaded);

    }
}

function predict_nationality_basic_setup($extra)
{
    Runner::load_env_local();

    $entity_data_file = __DIR__ . '/../../.sdk/test/entity/predict_nationality/PredictNationalityTestData.json';
    $entity_data_source = file_get_contents($entity_data_file);
    $entity_data = json_decode($entity_data_source, true);

    $options = [];
    $options["entity"] = $entity_data["existing"];

    $client = NationalizeSDK::test($options, $extra);

    // Generate idmap.
    $idmap = [];
    foreach (["predict_nationality01", "predict_nationality02", "predict_nationality03"] as $k) {
        $idmap[$k] = strtoupper($k);
    }

    // Detect ENTID env override before envOverride consumes it. When live
    // mode is on without a real override, the basic test runs against synthetic
    // IDs from the fixture and 4xx's. Surface this so the test can skip.
    $entid_env_raw = getenv("NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID");
    $idmap_overridden = $entid_env_raw !== false && str_starts_with(trim($entid_env_raw), "{");

    $env = Runner::env_override([
        "NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID" => $idmap,
        "NATIONALIZE_TEST_LIVE" => "FALSE",
        "NATIONALIZE_TEST_EXPLAIN" => "FALSE",
        "NATIONALIZE_APIKEY" => "NONE",
    ]);

    $idmap_resolved = Helpers::to_map(
        $env["NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID"]);
    if ($idmap_resolved === null) {
        $idmap_resolved = Helpers::to_map($idmap);
    }

    if ($env["NATIONALIZE_TEST_LIVE"] === "TRUE") {
        $merged_opts = Vs::merge([
            [
                "apikey" => $env["NATIONALIZE_APIKEY"],
            ],
            $extra ?? [],
        ]);
        $client = new NationalizeSDK(Helpers::to_map($merged_opts));
    }

    $live = $env["NATIONALIZE_TEST_LIVE"] === "TRUE";
    return [
        "client" => $client,
        "data" => $entity_data,
        "idmap" => $idmap_resolved,
        "env" => $env,
        "explain" => $env["NATIONALIZE_TEST_EXPLAIN"] === "TRUE",
        "live" => $live,
        "synthetic_only" => $live && !$idmap_overridden,
        "now" => (int)(microtime(true) * 1000),
    ];
}
