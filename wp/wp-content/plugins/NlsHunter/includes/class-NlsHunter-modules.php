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

    public function nlsJobSearch_render($atts)
    {
        if (!$this->model) return;

        $categoryOptions = $this->model->categories();
        $scopeOptions = $this->model->jobScopes();
        $locationOptions = $this->model->regions();
        $hybridOptions = $this->model->hybrid();

        $searchResultsUrl = $this->model->get_link_by_slug('search-results');
        $searchParams = $this->getSearchParams(['category', 'scope', 'region', 'hybrid', 'keyword']);

        ob_start();
        echo render('search/searchModule', [
            'categoryOptions' => $categoryOptions,
            'scopeOptions' =>  $scopeOptions,
            'locationOptions' => $locationOptions,
            'hybridOptions' =>  $hybridOptions,
            'searchResultsUrl' => $searchResultsUrl,
            'searchParams' => $searchParams,
            'atts' => $atts
        ]);

        return ob_get_clean();
    }

    private function getSearchParams($params)
    {
        $res = [];
        if (!is_array($params)) return $res;

        foreach ($params as $param) {
            $val = $this->model->queryParam($param, false);
            if (!$val) continue;
            $res[$param] = $val;
        }

        return $res;
    }

    public function nlsSearchResults_render()
    {
        if (!$this->model) return;

        $searchParams = $this->getSearchParams(['category', 'scope', 'region', 'hybrid', 'keyword']);
        $jobs = $this->model->getJobHunterExecuteNewQuery2($searchParams);

        ob_start();
        echo render('jobs/searchResultsModule', [
            'searchResultsUrl' => $this->model->get_link_by_slug('search-results'),
            'jobs' => $jobs
        ]);

        return ob_get_clean();
    }

    public function nlsHotJobs_render()
    {
        if (!$this->model) return;

        $hotJobs = $this->model->getHotJobs();

        ob_start();
        echo render('hotJobs/hotJobsModule', [
            'applyUrl' => $this->model->get_link_by_slug('apply-cv'),
            'hotJobs' => $hotJobs,
            'searchResultsUrl' => $this->model->get_link_by_slug('search-results'),
        ]);

        return ob_get_clean();
    }
}
