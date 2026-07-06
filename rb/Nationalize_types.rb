# frozen_string_literal: true

# Typed models for the Nationalize SDK.
#
# GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
# params (op.<name>.points[].args.params[]). Member types come from the
# canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
# @voxgig/apidef VALID_CANON). Ruby types are unenforced; these YARD
# annotations document the shapes. Do not edit by hand.

# PredictNationality entity data model.
#
# @!attribute [rw] country
#   @return [Array, nil]
#
# @!attribute [rw] name
#   @return [String, nil]
PredictNationality = Struct.new(
  :country,
  :name,
  keyword_init: true
)

# Request payload for PredictNationality#load.
#
# @!attribute [rw] country
#   @return [Array, nil]
#
# @!attribute [rw] name
#   @return [String, nil]
PredictNationalityLoadMatch = Struct.new(
  :country,
  :name,
  keyword_init: true
)

