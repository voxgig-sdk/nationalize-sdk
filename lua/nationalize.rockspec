package = "voxgig-sdk-nationalize"
version = "0.0-1"
source = {
  url = "git://github.com/voxgig-sdk/nationalize-sdk.git"
}
description = {
  summary = "Nationalize SDK for Lua",
  license = "MIT"
}
dependencies = {
  "lua >= 5.3",
  "dkjson >= 2.5",
  "dkjson >= 2.5",
}
build = {
  type = "builtin",
  modules = {
    ["nationalize_sdk"] = "nationalize_sdk.lua",
    ["config"] = "config.lua",
    ["features"] = "features.lua",
  }
}
