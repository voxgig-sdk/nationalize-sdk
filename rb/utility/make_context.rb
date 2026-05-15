# Nationalize SDK utility: make_context
require_relative '../core/context'
module NationalizeUtilities
  MakeContext = ->(ctxmap, basectx) {
    NationalizeContext.new(ctxmap, basectx)
  }
end
