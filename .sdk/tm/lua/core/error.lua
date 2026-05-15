-- Nationalize SDK error

local NationalizeError = {}
NationalizeError.__index = NationalizeError


function NationalizeError.new(code, msg, ctx)
  local self = setmetatable({}, NationalizeError)
  self.is_sdk_error = true
  self.sdk = "Nationalize"
  self.code = code or ""
  self.msg = msg or ""
  self.ctx = ctx
  self.result = nil
  self.spec = nil
  return self
end


function NationalizeError:error()
  return self.msg
end


function NationalizeError:__tostring()
  return self.msg
end


return NationalizeError
