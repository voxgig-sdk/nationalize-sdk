# ProjectName SDK exists test

import pytest
from nationalize_sdk import NationalizeSDK


class TestExists:

    def test_should_create_test_sdk(self):
        testsdk = NationalizeSDK.test(None, None)
        assert testsdk is not None
