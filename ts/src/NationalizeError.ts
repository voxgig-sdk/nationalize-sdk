
import { Context } from './Context'


class NationalizeError extends Error {

  isNationalizeError = true

  sdk = 'Nationalize'

  code: string
  ctx: Context

  constructor(code: string, msg: string, ctx: Context) {
    super(msg)
    this.code = code
    this.ctx = ctx
  }

}

export {
  NationalizeError
}

