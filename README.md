# OpenAI Bridge

A bridge between Eastern Rome and OpenAI in PHP.

![designed by OpenAI DALL-E](./docs/img.png)

## API

USE POST.

### Authentication

You should hold a pass id to for a client to call this api (e.g. `PASS_ID`),
and know the secret configured for the client (e.g. `SECRET`).

Any request at one time (e.g. `TimeStampInSecond`) should hold the headers:

* `X-BRIDGE-PASS-TOKEN` : `md5('PASS_ID:SECRET@' + TimeStampInSecond)`
* `X-BRIDGE-PASS-ID` : `PASS_ID`
* `X-BRIDGE-PASS-TIME` : `TimeStampInSecond`

### Get Models

URL: SCHEMA://DOMAIN/bridge/OpenAiApiV1/getModels

### Completion

URL: SCHEMA://DOMAIN/bridge/OpenAiApiV1/completion

Parameters:

* model string defined and provided by OpenAI
* prompt string
* max_tokens int default as 1024
* temperature float optional
* top_p float optional
* n int default as 1

### Chat

URL: SCHEMA://DOMAIN/bridge/OpenAiApiV1/chat

Parameters:

* model string defined and provided by OpenAI
* messages

### Generate Image For Url

URL: SCHEMA://DOMAIN/bridge/OpenAiApiV1/generateImageForUrl

Parameters:

* prompt string

### Generate Image Directly for download

URL: SCHEMA://DOMAIN/bridge/OpenAiApiV1/generateImageForOutput

Parameters:

* prompt string