# Nationalize SDK utility: feature_add
module NationalizeUtilities
  FeatureAdd = ->(ctx, f) {
    ctx.client.features << f
  }
end
