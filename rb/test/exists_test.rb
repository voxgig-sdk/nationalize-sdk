# Nationalize SDK exists test

require "minitest/autorun"
require_relative "../Nationalize_sdk"

class ExistsTest < Minitest::Test
  def test_create_test_sdk
    testsdk = NationalizeSDK.test(nil, nil)
    assert !testsdk.nil?
  end
end
