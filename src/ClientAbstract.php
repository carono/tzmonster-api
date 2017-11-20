<?php

namespace carono\tzmonster;


use carono\rest\Client;

abstract class ClientAbstract extends Client
{
    public $url = 'http://tzmonster.pro/api/engine/v1';
    public $login;
    public $apikey;
    public $method = 'post';
    public $output_type = self::TYPE_JSON;
    public $type = self::TYPE_JSON;
    public $postDataInBody = true;
    public $useAuth = false;

    /**
     * @return \SimpleXMLElement|\stdClass|string
     */
    public function getBalance()
    {
        return $this->request('GetBalance');
    }

    /**
     * @param $id
     * @param array $keys
     * @return \SimpleXMLElement|\stdClass|string
     */
    public function setGroupInWork($id, $keys = [])
    {
        $data = ['id' => $id, 'keys' => $keys];
        return $this->request('SetGroupsInWork', ['grps' => [$data]]);
    }

    /**
     * @param array $keys
     * @return \SimpleXMLElement|\stdClass|string
     */
    public function setGroupsInWork($keys = [])
    {
        $data = [];
        foreach ($keys as $id => $groups) {
            $data[$id] = $groups;
        }
        return $this->request('SetGroupsInWork', ['grps' => $data]);
    }

    /**
     * @param array $groups
     * @return \SimpleXMLElement|\stdClass|string
     */
    public function getGroupsResult($groups)
    {
        return $this->request('GetGroupsResult', ['grps' => $groups]);
    }

    /**
     * @param string $group
     * @return \SimpleXMLElement|\stdClass|string
     */
    public function getGroupResult($group)
    {
        return $this->request('GetGroupsResult', ['grps' => [$group]]);
    }

    /**
     * @param array $data
     * @return array
     */
    public function beforePrepareData(array $data)
    {
        $data['login'] = $this->login;
        $data['apikey'] = $this->apikey;
        return parent::beforePrepareData($data);
    }

    /**
     * @param $cmd
     * @param array $data
     * @return \SimpleXMLElement|\stdClass|string
     */
    public function request($cmd, $data = [])
    {
        $data['cmd'] = $cmd;
        return $this->getContent('', $data);
    }
}