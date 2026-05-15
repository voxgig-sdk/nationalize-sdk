
import { test, describe } from 'node:test'
import { equal } from 'node:assert'


import { NationalizeSDK } from '..'


describe('exists', async () => {

  test('test-mode', async () => {
    const testsdk = await NationalizeSDK.test()
    equal(null !== testsdk, true)
  })

})
