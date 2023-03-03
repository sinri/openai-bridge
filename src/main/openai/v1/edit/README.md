# EDIT

```
Create edit
POST
 
https://api.openai.com/v1/edits

Creates a new edit for the provided input, instruction, and parameters.

Request body
model
string
Required
ID of the model to use. You can use the text-davinci-edit-001 or code-davinci-edit-001 model with this endpoint.

input
string
Optional
Defaults to ''
The input text to use as a starting point for the edit.

instruction
string
Required
The instruction that tells the model how to edit the prompt.

n
integer
Optional
Defaults to 1
How many edits to generate for the input and instruction.

temperature
number
Optional
Defaults to 1
What sampling temperature to use, between 0 and 2. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic.

We generally recommend altering this or top_p but not both.

top_p
number
Optional
Defaults to 1
An alternative to sampling with temperature, called nucleus sampling, where the model considers the results of the tokens with top_p probability mass. So 0.1 means only the tokens comprising the top 10% probability mass are considered.

We generally recommend altering this or temperature but not both.
```

```bash
curl https://api.openai.com/v1/edits \
  -H 'Content-Type: application/json' \
  -H 'Authorization: Bearer YOUR_API_KEY' \
  -d '{
  "model": "text-davinci-edit-001",
  "input": "What day of the wek is it?",
  "instruction": "Fix the spelling mistakes"
}'
```

```python
{
  "object": "edit",
  "created": 1589478378,
  "choices": [
    {
      "text": "What day of the week is it?",
      "index": 0,
    }
  ],
  "usage": {
    "prompt_tokens": 25,
    "completion_tokens": 32,
    "total_tokens": 57
  }
}

```