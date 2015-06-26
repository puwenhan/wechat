<?php

/**
 * Location.php.
 *
 * Part of EasyWeChat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 overtrue <i@overtrue.me>
 *
 * @link      https://github.com/overtrue
 * @link      http://overtrue.me
 */

namespace EasyWeChat\Message;

use EasyWeChat\Exception;

/**
 * Class Location.
 */
class Location extends AbstractMessage implements MessageInterface
{
    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
                             'lat',
                             'lon',
                             'scale',
                             'label',
                            ];

    /**
     * 生成主动消息数组.
     */
    public function toStaff()
    {
        throw new Exception('暂时不支持发送链接消息');
    }

    /**
     * 生成回复消息数组.
     */
    public function toReply()
    {
        throw new Exception('暂时不支持回复链接消息');
    }
}
