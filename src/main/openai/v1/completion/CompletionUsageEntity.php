<?php

namespace sinri\openai\bridge\openai\v1\completion;

use sinri\openai\bridge\openai\AbstractEntity;

/**
 * @property-read int prompt_tokens
 * @property-read int completion_tokens
 * @property-read int total_tokens
 */
class CompletionUsageEntity extends AbstractEntity
{
}