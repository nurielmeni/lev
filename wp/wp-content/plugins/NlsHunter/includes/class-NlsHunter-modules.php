<?php
require_once 'Hunter/NlsHelper.php';
require_once ABSPATH . 'wp-content/plugins/NlsHunter/renderFunction.php';

/**
 * Description of class-NlsHunter-modules
 *
 * @author nurielmeni
 */
class NlsHunter_modules
{
    private $model;

    public function __construct($model, $version)
    {
        $this->model = $model;
        $this->version = $version;
    }

    public function nlsApplicationForm_render()
    {
        if (!$this->model) return;
        $jobs = $this->model->getJobHunterExecuteNewQuery2();

        ob_start();
        echo render('applyForJobs', [
            'jobOptions' => $this->model->listItemsToSelectOptions($jobs['list'], 'JobCode', 'JobTitle'),
            'total' => $jobs['totalHits'],
            'model' => $this->model,
            'companyOptions' => []
        ]);

        return ob_get_clean();
    }

    public function nlsJobSearch_render()
    {
        if (!$this->model) return;

        $categoryOptions = $this->model->categories();
        $scopeOptions = $this->model->jobScopes();
        $locationOptions = $this->model->regions();
        $hybridOptions = $this->model->hybrid();

        ob_start();
        echo render('search/searchModule', [
            'categoryOptions' => $categoryOptions,
            'scopeOptions' =>  $scopeOptions,
            'locationOptions' => $locationOptions,
            'hybridOptions' =>  $hybridOptions
        ]);

        return ob_get_clean();
    }

    public function nlsHotJobs_render()
    {
        if (!$this->model) return;

        $hotJobs = $this->model->getHotJobs();

        ob_start();
        echo render('hotJobs/hotJobsModule', [
            'hotJobs' => $hotJobs
        ]);

        return ob_get_clean();
    }
}
