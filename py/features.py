# Nationalize SDK feature factory

from feature.base_feature import NationalizeBaseFeature
from feature.test_feature import NationalizeTestFeature


def _make_feature(name):
    features = {
        "base": lambda: NationalizeBaseFeature(),
        "test": lambda: NationalizeTestFeature(),
    }
    factory = features.get(name)
    if factory is not None:
        return factory()
    return features["base"]()
