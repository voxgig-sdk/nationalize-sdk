package core

var UtilityRegistrar func(u *Utility)

var NewBaseFeatureFunc func() Feature

var NewTestFeatureFunc func() Feature

var NewPredictNationalityEntityFunc func(client *NationalizeSDK, entopts map[string]any) NationalizeEntity

