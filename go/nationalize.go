package voxgignationalizesdk

import (
	"github.com/voxgig-sdk/nationalize-sdk/go/core"
	"github.com/voxgig-sdk/nationalize-sdk/go/entity"
	"github.com/voxgig-sdk/nationalize-sdk/go/feature"
	_ "github.com/voxgig-sdk/nationalize-sdk/go/utility"
)

// Type aliases preserve external API.
type NationalizeSDK = core.NationalizeSDK
type Context = core.Context
type Utility = core.Utility
type Feature = core.Feature
type Entity = core.Entity
type NationalizeEntity = core.NationalizeEntity
type FetcherFunc = core.FetcherFunc
type Spec = core.Spec
type Result = core.Result
type Response = core.Response
type Operation = core.Operation
type Control = core.Control
type NationalizeError = core.NationalizeError

// BaseFeature from feature package.
type BaseFeature = feature.BaseFeature

func init() {
	core.NewBaseFeatureFunc = func() core.Feature {
		return feature.NewBaseFeature()
	}
	core.NewTestFeatureFunc = func() core.Feature {
		return feature.NewTestFeature()
	}
	core.NewPredictNationalityEntityFunc = func(client *core.NationalizeSDK, entopts map[string]any) core.NationalizeEntity {
		return entity.NewPredictNationalityEntity(client, entopts)
	}
}

// Constructor re-exports.
var NewNationalizeSDK = core.NewNationalizeSDK
var TestSDK = core.TestSDK
var NewContext = core.NewContext
var NewSpec = core.NewSpec
var NewResult = core.NewResult
var NewResponse = core.NewResponse
var NewOperation = core.NewOperation
var MakeConfig = core.MakeConfig
var NewBaseFeature = feature.NewBaseFeature
var NewTestFeature = feature.NewTestFeature
