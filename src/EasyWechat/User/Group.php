<?php

/**
 * Group.php.
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

namespace EasyWeChat\User;

/**
 * 用户组.
 */
class Group
{
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/groups/get';
    const API_CREATE = 'https://api.weixin.qq.com/cgi-bin/groups/create';
    const API_UPDATE = 'https://api.weixin.qq.com/cgi-bin/groups/update';
    const API_DELETE = 'https://api.weixin.qq.com/cgi-bin/groups/delete';
    const API_USER_GROUP_ID = 'https://api.weixin.qq.com/cgi-bin/groups/getid';
    const API_MEMBER_UPDATE = 'https://api.weixin.qq.com/cgi-bin/groups/members/update';
    const API_MEMBER_BATCH_UPDATE = 'https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate';

    /**
     * Http对象
     *
     * @var Http
     */
    protected $http;

    /**
     * constructor.
     *
     * <pre>
     * $config:
     *
     * array(
     *  'app_id' => YOUR_APPID,  // string mandatory;
     *  'secret' => YOUR_SECRET, // string mandatory;
     * )
     * </pre>
     *
     * @param array $config configuration array
     */
    public function __construct(array $config)
    {
        $this->http = new Http(new AccessToken($config));
    }

    /**
     * 创建分组.
     *
     * @param string $name
     *
     * @return int
     */
    public function create($name)
    {
        $params = [
                   'group' => ['name' => $name],
                  ];

        $response = $this->http->jsonPost(self::API_CREATE, $params);

        return $response['group'];
    }

    /**
     * 获取所有分组.
     *
     * @return array
     */
    public function lists()
    {
        $response = $this->http->get(self::API_GET);

        return $response['groups'];
    }

    /**
     * 更新组名称.
     *
     * @param int    $groupId
     * @param string $name
     *
     * @return bool
     */
    public function update($groupId, $name)
    {
        $params = [
                   'group' => [
                               'id' => $groupId,
                               'name' => $name,
                              ],
                  ];

        return $this->http->jsonPost(self::API_UPDATE, $params);
    }

    /**
     * 删除分组.
     *
     * @param int $groupId
     *
     * @return bool
     */
    public function delete($groupId)
    {
        $params = [
                   'group' => ['id' => $groupId],
                  ];

        return $this->http->jsonPost(self::API_DELETE, $params);
    }

    /**
     * 获取用户所在分组.
     *
     * @param string $openId
     *
     * @return int
     */
    public function userGroup($openId)
    {
        $params = ['openid' => $openId];

        $response = $this->http->jsonPost(self::API_USER_GROUP_ID, $params);

        return $response['groupid'];
    }

    /**
     * 移动单个用户.
     *
     * @param string $openId
     * @param int    $groupId
     *
     * @return bool
     */
    public function moveUser($openId, $groupId)
    {
        $params = [
                   'openid' => $openId,
                   'to_groupid' => $groupId,
                  ];

        $this->http->jsonPost(self::API_MEMBER_UPDATE, $params);

        return true;
    }

    /**
     * 批量移动用户.
     *
     * @param array $openIds
     * @param int   $groupId
     *
     * @return bool
     */
    public function moveUsers(array $openIds, $groupId)
    {
        $params = [
                   'openid_list' => $openIds,
                   'to_groupid' => $groupId,
                  ];

        $this->http->jsonPost(self::API_MEMBER_BATCH_UPDATE, $params);

        return true;
    }
}
