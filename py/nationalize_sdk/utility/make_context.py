# Nationalize SDK utility: make_context

from nationalize_sdk.core.context import NationalizeContext


def make_context_util(ctxmap, basectx):
    return NationalizeContext(ctxmap, basectx)
