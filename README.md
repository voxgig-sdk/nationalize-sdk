# Nationalize SDK

Estimate the likely nationality of a person from their name

> TypeScript, Python, PHP, Golang, Ruby, Lua SDKs, a CLI, an interactive REPL, and an MCP server for AI agents — all generated from one OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).

## About Nationalize API

[Nationalize.io](https://nationalize.io/) predicts the likely nationality of a person from their name by matching against a large dataset of names and self-reported country information. The service is operated by Demografix ApS in Denmark, which also runs the sister APIs [Agify](https://agify.io/) and [Genderize](https://genderize.io/).

What you get from the API:

- A ranked list of country codes with probability scores for a given name.
- Support for diacritics, accents, and non-Latin alphabets.
- Optional geographic scoping to narrow predictions to a subset of countries.

The API is hosted at `https://api.nationalize.io` and is CORS-enabled, making it usable directly from browser code. A free tier allows a limited number of name lookups per day or month; higher volumes and commercial use require a paid plan and API key. Predictions are statistical estimates and should not be used as authoritative identifiers for individuals.

## Try it

**TypeScript**
```bash
npm install nationalize
```

**Python**
```bash
pip install nationalize-sdk
```

**PHP**
```bash
composer require voxgig/nationalize-sdk
```

**Golang**
```bash
go get github.com/voxgig-sdk/nationalize-sdk/go
```

**Ruby**
```bash
gem install nationalize-sdk
```

**Lua**
```bash
luarocks install nationalize-sdk
```

## 30-second quickstart

### TypeScript

```ts
import { NationalizeSDK } from 'nationalize'

const client = new NationalizeSDK({})

```

See the [TypeScript README](ts/README.md) for the
full guide, or scroll down for the same example in other languages.

## What's in the box

| Surface | Use it for | Path |
| --- | --- | --- |
| **SDK** (TypeScript, Python, PHP, Golang, Ruby, Lua) | App integration | `ts/` `py/` `php/` `go/` `rb/` `lua/` |
| **CLI** | Scripts, CI, ops, one-off API calls | `go-cli/` |
| **MCP server** | AI agents (Claude, Cursor, Cline) | `go-mcp/` |

## Use it from an AI agent (MCP)

The generated MCP server exposes every operation in this SDK as an
[MCP](https://modelcontextprotocol.io) tool that Claude, Cursor or Cline
can call directly. Build and register it:

```bash
cd go-mcp && go build -o nationalize-mcp .
```

Then add it to your agent's MCP config (Claude Desktop, Cursor, etc.):

```json
{
  "mcpServers": {
    "nationalize": {
      "command": "/abs/path/to/nationalize-mcp"
    }
  }
}
```

## Entities

The API exposes one entity:

| Entity | Description | API path |
| --- | --- | --- |
| **PredictNationality** | Nationality prediction for a single name; call the root endpoint with a `name` query parameter, e.g. `GET /?name=bock`, to receive an array of country codes with probabilities. | `/` |

Each entity supports the following operations where available: **load**,
**list**, **create**, **update**, and **remove**.

## Quickstart in other languages

### Python

```python
from nationalize_sdk import NationalizeSDK

client = NationalizeSDK({})


# Load a specific predictnationality
predictnationality, err = client.PredictNationality(None).load(
    {"id": "example_id"}, None
)
```

### PHP

```php
<?php
require_once 'nationalize_sdk.php';

$client = new NationalizeSDK([]);


// Load a specific predictnationality
[$predictnationality, $err] = $client->PredictNationality(null)->load(
    ["id" => "example_id"], null
);
```

### Golang

```go
import sdk "github.com/voxgig-sdk/nationalize-sdk/go"

client := sdk.NewNationalizeSDK(map[string]any{})

```

### Ruby

```ruby
require_relative "Nationalize_sdk"

client = NationalizeSDK.new({})


# Load a specific predictnationality
predictnationality, err = client.PredictNationality(nil).load(
  { "id" => "example_id" }, nil
)
```

### Lua

```lua
local sdk = require("nationalize_sdk")

local client = sdk.new({})


-- Load a specific predictnationality
local predictnationality, err = client:PredictNationality(nil):load(
  { id = "example_id" }, nil
)
```

## Unit testing in offline mode

Every SDK ships a test mode that swaps the HTTP transport for an
in-memory mock, so unit tests run offline.

### TypeScript

```ts
const client = NationalizeSDK.test()
const result = await client.PredictNationality().load({ id: 'test01' })
// result.ok === true, result.data contains mock data
```

### Python

```python
client = NationalizeSDK.test(None, None)
result, err = client.PredictNationality(None).load(
    {"id": "test01"}, None
)
```

### PHP

```php
$client = NationalizeSDK::test(null, null);
[$result, $err] = $client->PredictNationality(null)->load(
    ["id" => "test01"], null
);
```

### Golang

```go
client := sdk.TestSDK(nil, nil)
result, err := client.PredictNationality(nil).Load(
    map[string]any{"id": "test01"}, nil,
)
```

### Ruby

```ruby
client = NationalizeSDK.test(nil, nil)
result, err = client.PredictNationality(nil).load(
  { "id" => "test01" }, nil
)
```

### Lua

```lua
local client = sdk.test(nil, nil)
local result, err = client:PredictNationality(nil):load(
  { id = "test01" }, nil
)
```

## How it works

Every SDK call runs the same five-stage pipeline:

1. **Point** — resolve the API endpoint from the operation definition.
2. **Spec** — build the HTTP specification (URL, method, headers, body).
3. **Request** — send the HTTP request.
4. **Response** — receive and parse the response.
5. **Result** — extract the result data for the caller.

A feature hook fires at each stage (e.g. `PrePoint`, `PreSpec`,
`PreRequest`), so features can inspect or modify the pipeline without
forking the SDK.

### Features

| Feature | Purpose |
| --- | --- |
| **TestFeature** | In-memory mock transport for testing without a live server |

Pass custom features via the `extend` option at construction time.

### Direct and Prepare

For endpoints the entity model doesn't cover, use the low-level methods:

- **`direct(fetchargs)`** — build and send an HTTP request in one step.
- **`prepare(fetchargs)`** — build the request without sending it.

Both accept a map with `path`, `method`, `params`, `query`,
`headers`, and `body`. See the [How-to guides](#how-to-guides) below.

## How-to guides

### Make a direct API call

When the entity interface does not cover an endpoint, use `direct`:

**TypeScript:**
```ts
const result = await client.direct({
  path: '/api/resource/{id}',
  method: 'GET',
  params: { id: 'example' },
})
console.log(result.data)
```

**Python:**
```python
result, err = client.direct({
    "path": "/api/resource/{id}",
    "method": "GET",
    "params": {"id": "example"},
})
```

**PHP:**
```php
[$result, $err] = $client->direct([
    "path" => "/api/resource/{id}",
    "method" => "GET",
    "params" => ["id" => "example"],
]);
```

**Go:**
```go
result, err := client.Direct(map[string]any{
    "path":   "/api/resource/{id}",
    "method": "GET",
    "params": map[string]any{"id": "example"},
})
```

**Ruby:**
```ruby
result, err = client.direct({
  "path" => "/api/resource/{id}",
  "method" => "GET",
  "params" => { "id" => "example" },
})
```

**Lua:**
```lua
local result, err = client:direct({
  path = "/api/resource/{id}",
  method = "GET",
  params = { id = "example" },
})
```

## Per-language documentation

- [TypeScript](ts/README.md)
- [Python](py/README.md)
- [PHP](php/README.md)
- [Golang](go/README.md)
- [Ruby](rb/README.md)
- [Lua](lua/README.md)

## Using the Nationalize API

- Upstream: [https://nationalize.io/](https://nationalize.io/)

- Operated as a commercial service by Demografix ApS (Denmark).
- Free tier available without a credit card; paid plans for higher volume.
- No public licence is published for the returned data; treat results as for use within the service's terms.
- Check the homepage for the current pricing and terms before redistributing predictions.

---

Generated from the Nationalize API OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).
