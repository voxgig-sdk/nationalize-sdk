package sdktest

import (
	"encoding/json"
	"os"
	"path/filepath"
	"runtime"
	"strings"
	"testing"
	"time"

	sdk "github.com/voxgig-sdk/nationalize-sdk"
	"github.com/voxgig-sdk/nationalize-sdk/core"

	vs "github.com/voxgig/struct"
)

func TestPredictNationalityEntity(t *testing.T) {
	t.Run("instance", func(t *testing.T) {
		testsdk := sdk.TestSDK(nil, nil)
		ent := testsdk.PredictNationality(nil)
		if ent == nil {
			t.Fatal("expected non-nil PredictNationalityEntity")
		}
	})

	t.Run("basic", func(t *testing.T) {
		setup := predict_nationalityBasicSetup(nil)
		// Per-op sdk-test-control.json skip — basic test exercises a flow
		// with multiple ops; skipping any op skips the whole flow.
		_mode := "unit"
		if setup.live {
			_mode = "live"
		}
		for _, _op := range []string{"load"} {
			if _shouldSkip, _reason := isControlSkipped("entityOp", "predict_nationality." + _op, _mode); _shouldSkip {
				if _reason == "" {
					_reason = "skipped via sdk-test-control.json"
				}
				t.Skip(_reason)
				return
			}
		}
		// The basic flow consumes synthetic IDs from the fixture. In live mode
		// without an *_ENTID env override, those IDs hit the live API and 4xx.
		if setup.syntheticOnly {
			t.Skip("live entity test uses synthetic IDs from fixture — set NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID JSON to run live")
			return
		}
		client := setup.client

		// Bootstrap entity data from existing test data (no create step in flow).
		predictNationalityRef01DataRaw := vs.Items(core.ToMapAny(vs.GetPath("existing.predict_nationality", setup.data)))
		var predictNationalityRef01Data map[string]any
		if len(predictNationalityRef01DataRaw) > 0 {
			predictNationalityRef01Data = core.ToMapAny(predictNationalityRef01DataRaw[0][1])
		}
		// Discard guards against Go's unused-var check when the flow's steps
		// happen not to consume the bootstrap data (e.g. list-only flows).
		_ = predictNationalityRef01Data

		// LOAD
		predictNationalityRef01Ent := client.PredictNationality(nil)
		predictNationalityRef01MatchDt0 := map[string]any{}
		predictNationalityRef01DataDt0Loaded, err := predictNationalityRef01Ent.Load(predictNationalityRef01MatchDt0, nil)
		if err != nil {
			t.Fatalf("load failed: %v", err)
		}
		if predictNationalityRef01DataDt0Loaded == nil {
			t.Fatal("expected load result to be non-nil")
		}

	})
}

func predict_nationalityBasicSetup(extra map[string]any) *entityTestSetup {
	loadEnvLocal()

	_, filename, _, _ := runtime.Caller(0)
	dir := filepath.Dir(filename)

	entityDataFile := filepath.Join(dir, "..", "..", ".sdk", "test", "entity", "predict_nationality", "PredictNationalityTestData.json")

	entityDataSource, err := os.ReadFile(entityDataFile)
	if err != nil {
		panic("failed to read predict_nationality test data: " + err.Error())
	}

	var entityData map[string]any
	if err := json.Unmarshal(entityDataSource, &entityData); err != nil {
		panic("failed to parse predict_nationality test data: " + err.Error())
	}

	options := map[string]any{}
	options["entity"] = entityData["existing"]

	client := sdk.TestSDK(options, extra)

	// Generate idmap via transform, matching TS pattern.
	idmap := vs.Transform(
		[]any{"predict_nationality01", "predict_nationality02", "predict_nationality03"},
		map[string]any{
			"`$PACK`": []any{"", map[string]any{
				"`$KEY`": "`$COPY`",
				"`$VAL`": []any{"`$FORMAT`", "upper", "`$COPY`"},
			}},
		},
	)

	// Detect ENTID env override before envOverride consumes it. When live
	// mode is on without a real override, the basic test runs against synthetic
	// IDs from the fixture and 4xx's. Surface this so the test can skip.
	entidEnvRaw := os.Getenv("NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID")
	idmapOverridden := entidEnvRaw != "" && strings.HasPrefix(strings.TrimSpace(entidEnvRaw), "{")

	env := envOverride(map[string]any{
		"NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID": idmap,
		"NATIONALIZE_TEST_LIVE":      "FALSE",
		"NATIONALIZE_TEST_EXPLAIN":   "FALSE",
		"NATIONALIZE_APIKEY":         "NONE",
	})

	idmapResolved := core.ToMapAny(env["NATIONALIZE_TEST_PREDICT_NATIONALITY_ENTID"])
	if idmapResolved == nil {
		idmapResolved = core.ToMapAny(idmap)
	}

	if env["NATIONALIZE_TEST_LIVE"] == "TRUE" {
		mergedOpts := vs.Merge([]any{
			map[string]any{
				"apikey": env["NATIONALIZE_APIKEY"],
			},
			extra,
		})
		client = sdk.NewNationalizeSDK(core.ToMapAny(mergedOpts))
	}

	live := env["NATIONALIZE_TEST_LIVE"] == "TRUE"
	return &entityTestSetup{
		client:        client,
		data:          entityData,
		idmap:         idmapResolved,
		env:           env,
		explain:       env["NATIONALIZE_TEST_EXPLAIN"] == "TRUE",
		live:          live,
		syntheticOnly: live && !idmapOverridden,
		now:           time.Now().UnixMilli(),
	}
}
