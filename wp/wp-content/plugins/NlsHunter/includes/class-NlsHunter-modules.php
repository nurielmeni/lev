<?php
require_once 'Hunter/NlsHelper.php';
require_once NLS__PLUGIN_PATH . '/renderFunction.php';

/**
 * Description of class-NlsHunter-modules
 *
 * @author nurielmeni
 */
class NlsHunter_modules
{
    private $model;
    private $searchFields = ['category', 'employment-form', 'region', 'employment-type', 'keyword'];

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
        $locationOptions = $this->model->regions();
        $employmentType = $this->model->jobEmploymentType();
        $employmentForm = $this->model->jobEmploymentForm();

        $searchResultsUrl = $this->model->get_link_by_slug('search-results');
        $searchParams = $this->getSearchParams($this->searchFields);

        ob_start();
        echo render('search/searchModule', [
            'categoryOptions' => $categoryOptions,
            'employmentForm' =>  $employmentForm,
            'locationOptions' => $locationOptions,
            'employmentType' =>  $employmentType,
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

        $searchParams = $this->getSearchParams($this->searchFields);
        $jobs = $this->model->getJobHunterExecuteNewQuery2($searchParams);

        ob_start();
        echo render('jobs/searchResultsModule', [
            'model' => $this->model,
            'searchResultsUrl' => $this->model->get_link_by_slug('search-results'),
            'applyCvUrl' => $this->model->get_link_by_slug('apply-cv'),
            'jobs' => $jobs
        ]);

        return ob_get_clean();
    }

    public function nlsApplyCv_render()
    {
        if (!$this->model) return;

        $jobCode = $this->model->queryParam('job-code', false);
        $studyYearOptions = $this->model->studyYearOptions();


        ob_start();
        echo render('apply/applyModule', [
            'applyResultUrl' => $this->model->get_link_by_slug('apply-result'),
            'jobCode' => $jobCode,
            'studyYearOptions' => $studyYearOptions
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
