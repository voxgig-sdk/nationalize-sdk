# Nationalize SDK utility: make_context

from projectname_sdk.core.context import NationalizeContext


def make_context_util(ctxmap, basectx):
    return NationalizeContext(ctxmap, basectx)
