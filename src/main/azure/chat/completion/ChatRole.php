<?php

namespace sinri\openai\bridge\azure\chat\completion;
/**
 * A description of the intended purpose of a message within a chat completions interaction.
 */
class ChatRole
{
    const ROLE_ASSISTANT = 'assistant';
    const ROLE_FUNCTION = 'function';
    const ROLE_SYSTEM = 'system';
    const ROLE_USER = 'user';

//    /**
//     * 对系统指示的用户提示输入做出响应的角色
//     */
//    public static function roleAssistant(): ChatRole
//    {
//        return new ChatRole('assistant');
//    }
//
//    /**
//     * 为聊天补全提供函数结果的角色
//     */
//    public static function roleFunction(): ChatRole
//    {
//        return new ChatRole('function');
//    }
//
//    /**
//     * 指示或设置助手行为的角色
//     */
//    public static function roleSystem(): ChatRole
//    {
//        return new ChatRole('system');
//    }
//
//    /**
//     * 为聊天补全提供输入的角色
//     */
//    public static function roleUser(): ChatRole
//    {
//        return new ChatRole('user');
//    }
//
//    private string $role;
//
//    private function __construct(string $role)
//    {
//        $this->role = $role;
//    }
//
//    public function __toString()
//    {
//        return $this->role;
//    }
}
