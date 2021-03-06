<?php

namespace OpenCoders\Podb\Provider\REST\v1;


use OpenCoders\Podb\REST\v1\json\ProjectController;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class ProjectControllerProvider implements ControllerProviderInterface
{

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $app['rest.v1.json.project_controller'] = $app->share(function ($app) {
            return new ProjectController($app, $app['project'], $app['authentication']);
        });

        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/project', 'rest.v1.json.project_controller:getList')->bind('rest.v1.json.project.list');
        $controllers->get('/project/{projectName}', 'rest.v1.json.project_controller:get')->bind('rest.v1.json.project.get');
        $controllers->get('/project/{projectName}/contributors', 'rest.v1.json.project_controller:getContributors')
            ->bind('rest.v1.json.project.contributor.list');
        $controllers->get('/project/{projectName}/categories', 'rest.v1.json.project_controller:getCategories')
            ->bind('rest.v1.json.project.category.list');
        $controllers->get('/project/{projectName}/languages', 'rest.v1.json.project_controller:getLanguages')
            ->bind('rest.v1.json.project.language.list');

        $controllers->post('/project', 'rest.v1.json.project_controller:post')->bind('rest.v1.json.project.create');
        $controllers->put('/project/{id}', 'rest.v1.json.project_controller:put')->bind('rest.v1.json.project.update');
        $controllers->delete('/project/{id}', 'rest.v1.json.project_controller:delete')->bind('rest.v1.json.project.delete');

        return $controllers;
    }
}