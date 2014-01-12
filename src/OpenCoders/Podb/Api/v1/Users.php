<?php

namespace OpenCoders\Podb\Api\v1;

use DateTime;
use Luracast\Restler\RestException;
use OpenCoders\Podb\Api\AbstractBaseApi;
use OpenCoders\Podb\Entity\Project;
use OpenCoders\Podb\Entity\User;
use OpenCoders\Podb\Exception\PodbException;
use OpenCoders\Podb\Api\ApiUrl;
use OpenCoders\Podb\Repository\UserRepository;

class Users extends AbstractBaseApi
{
    /**
     * @var string EntityClassName (FQN)
     */
    protected $entityName = 'OpenCoders\Podb\Entity\User';

    /**
     * @url GET /users
     *
     * @return array
     */
    public function getList()
    {
        $data = array();

        $repository = $this->getRepository();
        $users = $repository->findAll();

        /**
         * @var $user User
         */
        foreach ($users as $user) {
            $data[] = $user->asShortArrayWithAPIInformation($this->apiVersion);
        }

        return $data;
    }

    /**
     * @param $userName
     *
     * @url GET /users/:userName
     *
     * @throws \Luracast\Restler\RestException
     *
     * @return array
     */
    public function get($userName)
    {
        $repository = $this->getRepository();
        /**
         * @var $user User
         */
        if (intval($userName) == 0) {
            $user = $repository->findOneBy(array(
                'username' => $userName
            ));
        } else {
            $user = $repository->find($userName);
        }

        if ($user == null) {
            throw new RestException(404, "No user found with identifier $userName.");
        }
        return $user->asArrayWithAPIInformation($this->apiVersion);
    }

    /**
     * @param $userName
     *
     * @url GET /users/:userName/projects
     *
     * @return array
     */
    public function getProjects($userName)
    {
        $data = array();

        /**
         * @var $repository UserRepository
         */
        $repository = $this->getRepository();
        if (intval($userName) == 0) {
            $projects = $repository->getProjectsByUserName($userName);
        } else {
            $projects = $repository->getProjects($userName);
        }

        /**
         * @var $project Project
         */
        foreach ($projects as $project) {
            $data[] = $project->asShortArrayWithAPIInformation($this->apiVersion);
        }

        return $data;

//        $apiBaseUrl = ApiUrl::getBaseApiUrl();
//
//        return array(
//            array(
//                'id' => 12344567,
//                'name' => 'Fake-Project-1',
//                'owner' => array(),
//                'url' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-1",
//                'url_html' => '',
//                'url_members' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-1/members",
//                'url_domains' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-1/domains",
//                'url_languages' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-1/languages"
//            ),
//            array(
//                'id' => 12344567,
//                'name' => 'Fake-Project-2',
//                'owner' => array(),
//                'url' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-2",
//                'url_html' => '',
//                'url_members' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-2/members",
//                'url_domains' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-2/domains",
//                'url_languages' => $apiBaseUrl . "/{$this->apiVersion}/projects/Fake-Project-2/languages"
//            )
//        );
    }

    /**
     * @param $userName
     * @url GET /users/:userName/languages
     *
     * @return array
     */
    public function getLanguages($userName)
    {

        $apiBaseUrl = ApiUrl::getBaseApiUrl();

        return array(
            array(
                'id' => 1,
                'locale' => 'de_DE',
                'label' => 'Deutsch',
                'url' => $apiBaseUrl . "/languages/de_DE",
                'url_projects' => $apiBaseUrl . "/languages/de_DE/projects"
            ),
            array(
                'id' => 2,
                'locale' => 'en_GB',
                'label' => 'Deutsch',
                'url' => $apiBaseUrl . "/languages/en_GB",
                'url_projects' => $apiBaseUrl . "/languages/en_GB/projects"
            ),
        );
    }

    /**
     * @param $userName
     * @url GET /users/:userName/translations
     *
     * @return array
     */
    public function getTranslations($userName)
    {

        $baseUrl = ApiUrl::getBaseApiUrl();

        return array(
            array(
                'id' => 123456789,
                'language' => 'en_US',
                'msg_str' => 'test',
                'msg_str1' => '',
                'msg_str2' => '',
                'fuzzy' => true,
                'created_at' => 12345678,
                'modified_at' => 12345678,
                'url_dataset' => $baseUrl . "/{$this->apiVersion}/datasets/123456789",
                'url_created_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
                'url_modified_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
            ),
            array(
                'id' => 123456789,
                'language' => 'en_US',
                'msg_str' => 'test',
                'msg_str1' => '',
                'msg_str2' => '',
                'fuzzy' => true,
                'created_at' => 12345678,
                'modified_at' => 12345678,
                'url_dataset' => $baseUrl . "/{$this->apiVersion}/datasets/123456789",
                'url_created_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
                'url_modified_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
            ),
            array(
                'id' => 123456789,
                'language' => 'en_US',
                'msg_str' => 'test',
                'msg_str1' => '',
                'msg_str2' => '',
                'fuzzy' => true,
                'created_at' => 12345678,
                'modified_at' => 12345678,
                'url_dataset' => $baseUrl . "/{$this->apiVersion}/datasets/123456789",
                'url_created_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
                'url_modified_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
            ),
            array(
                'id' => 123456789,
                'language' => 'en_US',
                'msg_str' => 'test',
                'msg_str1' => '',
                'msg_str2' => '',
                'fuzzy' => true,
                'created_at' => 12345678,
                'modified_at' => 12345678,
                'url_dataset' => $baseUrl . "/{$this->apiVersion}/datasets/123456789",
                'url_created_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
                'url_modified_by' => $baseUrl . "/{$this->apiVersion}/users/dax",
            ),
        );
    }

    /**
     * @param $request_data
     *
     * @url POST /users
     * @protected
     * @status 201
     *
     * @throws \Luracast\Restler\RestException
     *
     * @return array
     */
    public function post($request_data = NULL)
    {
        $user = new User();
        $user->setDisplayName($request_data['displayName']);
        $user->setEmail($request_data['email']);
        $user->setUsername($request_data['userName']);
        $user->setPassword(sha1($request_data['password']));
        $user->setCreateDate(new DateTime());
        $user->setLastUpdateDate(new DateTime());

        $user->setState(0);

        try {
            $em = $this->getEntityManager();
            $em->persist($user);
            $em->flush();
        } catch (\Exception $e) {
            throw new RestException(400, $e->getMessage());
        };

        return $user->asArrayWithAPIInformation($this->apiVersion);
    }

    /**
     * @param $id
     * @param $request_data
     *
     * @url PUT /users/:id
     * @protected
     *
     * @throws \Luracast\Restler\RestException
     *
     * @return bool
     */
    public function put($id, $request_data = NULL)
    {
        $repository = $this->getRepository();
        /**
         * @var $user User
         */
        $user = $repository->find($id);

        try {
            $user->update($request_data);
            $this->getEntityManager()->flush($user);
        } catch (PodbException $e) {
            throw new RestException(400, $e->getMessage());
        }

        return $user->asArrayWithAPIInformation($this->apiVersion);
    }

    /**
     * @param $id
     *
     * @url DELETE /users/:id
     * @protected
     *
     * @throws \Luracast\Restler\RestException
     *
     * @return array
     */
    public function delete($id)
    {
        if (intval($id) == 0) {
            throw new RestException(400, 'Invalid ID ' . $id);
        }

        $em = $this->getEntityManager();
        $user = $em->getPartialReference($this->entityName, array('id' => $id));
        $em->remove($user);
        $em->flush();

        return array(
            'success' => true
        );
    }

} 