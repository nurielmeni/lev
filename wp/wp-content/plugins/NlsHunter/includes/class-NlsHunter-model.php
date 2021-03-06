<?php
include_once 'Hunter/NlsConfig.php';
require_once 'Hunter/NlsCards.php';
require_once 'Hunter/NlsSecurity.php';
require_once 'Hunter/NlsDirectory.php';
require_once 'Hunter/NlsSearch.php';
require_once 'Hunter/NlsHelper.php';
require_once 'Hunter/NlsFilter.php';
/**
 * Description of class-NlsHunter-modules
 *
 * @author nurielmeni
 */
class NlsHunter_model
{
    const STATUS_OPEN = 1;

    private $nlsSecutity;
    private $auth;
    private $nlsCards;
    private $nlsSearch;
    private $nlsDirectory;
    private $supplierId;

    private $nlsConfig;

    private $nlsFlashCache  = true;
    private $nlsCacheTime  = 20 * 60;

    private $regions;

    public function __construct()
    {
        $this->nlsConfig = new NlsConfig;
        try {
            $this->nlsSecutity = new NlsSecurity($this->nlsConfig);
        } catch (\Exception $e) {
            $this->notice(
                __('Could not create Model.', 'NlsHunter'),
                __('Error: NlsHunter_model: ', 'NlsHunter')
            );
            return null;
        }
        $this->auth = $this->nlsSecutity->isAuth();
        $this->nlsFlashCache = true;
        $this->nlsCacheTime = 20 * 60;
        $this->supplierId = $this->queryParam('sid', $this->nlsConfig->getNlsSupplierId());

        if (!$this->auth) {
            $username = $this->nlsConfig->getNlsUser();
            $password = $this->nlsConfig->getNlsPassword();
            $this->auth = $this->nlsSecutity->authenticate($username, $password);

            // Check if Auth is OK and convert to object
            if ($this->nlsSecutity->isAuth() === false) {
                $this->notice('Authentication Error', 'Can not connect to Niloos Service.');
            }
        }

        // Load data on ajax calls
        if (!wp_doing_ajax()) {
        }
    }

    /**
     * type: page/post
     */
    public function get_link_by_slug($slug, $type = 'page')
    {
        $post = get_page_by_path($slug, OBJECT, $type);
        if (!$post) return '/';

        return get_permalink($post->ID);
    }

    public function getDefaultLogo()
    {
        return esc_url(plugins_url('NlsHunter/public/images/employer-logo.svg'));
    }

    public function getShareUrl($jobUrl)
    {
        return [
            'whatsapp' => 'https://api.whatsapp.com/send?text=' . urlencode($jobUrl),
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($jobUrl),
            'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($jobUrl)
        ];
    }

    public function queryParam($param, $default = '', $post = false)
    {
        if ($post) {
            return isset($_POST[$param]) ? $_POST[$param] : $default;
        }
        return isset($_GET[$param]) ? $_GET[$param] : $default;
    }

    public function nlsGetSupplierId()
    {
        return $this->supplierId;
    }

    public function notice($title, $notice)
    {
        if (is_admin()) $this->nlsAdminNotice($title, $notice);
        else $this->nlsPublicNotice($title, $notice);
    }

    private function nlsPublicNotice($title, $notice)
    {

        ob_start();
        echo render('notice', [
            'title' => $title,
            'notice' => $notice
        ]);
        echo ob_get_clean();
    }

    private function nlsAdminNotice($title, $notice)
    {
        add_action('admin_notices', function () use ($title, $notice) {
            $class = 'notice notice-error';
            ob_start();
            printf('<div class="%1$s"><label>%2$s</label><p>%3$s</p></div>', esc_attr($class), esc_html($title), esc_html($notice));
            echo ob_get_clean();
        });
    }

    /**
     * Gets a card by email or phone
     */
    public function getCardByEmailOrCell($email, $cell)
    {
        $card = [];
        if (!empty($email)) {
            $card = $this->nlsCards->ApplicantHunterExecuteNewQuery2('', '', '', '', $email);
        }
        if (count($card) === 0 && !empty($cell)) {
            $card = $this->nlsCards->ApplicantHunterExecuteNewQuery2('', $cell, '', '', '');
        }
        return $card;
    }

    /**
     * Add file to card
     */
    public function insertNewFile($cardId, $file)
    {
        $fileContent = file_get_contents($file['path']);
        return $this->nlsCards->insertNewFile($cardId, $fileContent, $file['name'], $file['ext']);
    }

    /**
     * Init cards service
     */
    public function initCardService()
    {
        try {
            if ($this->auth !== false && !$this->nlsCards) {
                $this->nlsCards = new NlsCards([
                    'auth' => $this->auth,
                ]);
            }
        } catch (\Exception $e) {
            $this->notice(
                __('Could not init Card Services.', 'NlsHunter'),
                __('Error: Card Services: ', 'NlsHunter')
            );
            return null;
        }
        return true;
    }

    /**
     * Init directory service
     */
    public function initDirectoryService()
    {
        try {
            if ($this->auth !== false && !$this->nlsDirectory) {
                $this->nlsDirectory = new NlsDirectory([
                    'auth' => $this->auth
                ]);
            }
        } catch (\Exception $e) {
            $this->notice(
                __('Could not init Directory Services.', 'NlsHunter'),
                __('Error: Directory Services: ', 'NlsHunter')
            );
            return null;
        }
        return true;
    }

    /**
     * Init search service
     */
    public function initSearchService()
    {
        try {
            if ($this->auth !== false && !$this->nlsSearch) {
                $this->nlsSearch = new NlsSearch([
                    'auth' => $this->auth,
                ]);
            }
        } catch (\Exception $e) {
            $this->notice(
                __('Could not init Search Services.', 'NlsHunter'),
                __('Error: Search Services: ', 'NlsHunter')
            );

            return null;
        }
        return true;
    }

    public function getJobByJobCode($jobCode)
    {
        return $this->nlsCards->getJobByJobCode($jobCode);
    }

    public function searchJobByJobCode($jobCode)
    {
        if (!$jobCode) return null;
        $resultRowLimit = 1;
        $resultRowOffset = 0;

        $cache_key = 'nls_hunter_job_' . $jobCode;
        if ($this->nlsFlashCache) wp_cache_delete($cache_key);

        $job = wp_cache_get($cache_key);

        if (false === $job) {
            if (!$this->initSearchService()) return ['totalHits' => 0, 'list' => []];

            $filter = new NlsFilter();

            $filter->addSuplierIdFilter($this->nlsGetSupplierId());

            $filterField = new FilterField('JobCode', SearchPhrase::EXACT, $jobCode, NlsFilter::TERMS_NON_ANALAYZED);
            $filter->addWhereFilter($filterField, WhereCondition::C_AND);

            try {
                $job = $this->nlsSearch->JobHunterExecuteNewQuery2(
                    null,
                    $resultRowOffset,
                    $resultRowLimit,
                    $filter
                );
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return null;
            }
        }

        return $job->TotalHits === 1 && property_exists($job, 'Results') && property_exists($job->Results, 'JobInfo') ? $job->Results->JobInfo : null;
    }

    protected function getListNameById($list, $id)
    {
        if (!is_array($list)) return '';
        foreach ($list as $item) {
            if (key_exists('id', $item) && $item['id'] == $id) return $item['name'];
        }
        return '';
    }

    /**
     * Return the categories
     */
    public function categories()
    {
        $this->initDirectoryService();
        try {
            $categories = $this->nlsDirectory->getCategories();
            return $categories;
        } catch (Exception $ex) {
            $this->notice('Model: categories', $ex->getMessage());
            return null;
        }
    }

    public function jobScopes()
    {
        $this->initDirectoryService();

        $cacheKey = 'JOB_SCOPES';
        $jobScopes = wp_cache_get($cacheKey);
        try {
            if (false === $jobScopes) {
                $jobScopes = $this->nlsDirectory->getJobScopes();
                wp_cache_set($cacheKey, $jobScopes, 'directory', $this->nlsCacheTime);
            }

            return is_array($jobScopes) ? $jobScopes : [];
        } catch (Exception $ex) {
            $this->notice('Model: jobScopes', $ex->getMessage());
            return null;
        }
    }

    public function jobEmploymentType()
    {
        $this->initDirectoryService();

        $cacheKey = 'JOB_EMPLOYMENT_TYPE';
        $jobEmploymentType = wp_cache_get($cacheKey);
        try {
            if (false === $jobEmploymentType) {
                $jobEmploymentType = $this->nlsDirectory->getJobEmploymentType();
                wp_cache_set($cacheKey, $jobEmploymentType, 'directory', $this->nlsCacheTime);
            }

            return is_array($jobEmploymentType) ? $jobEmploymentType : [];
        } catch (Exception $ex) {
            $this->notice('Model: jobEmploymentType', $ex->getMessage());
            return null;
        }
    }

    public function jobEmploymentForm()
    {
        $this->initDirectoryService();

        $cacheKey = 'JOB_EMPLOYMENT_FORM';
        $jobEmploymentForm = wp_cache_get($cacheKey);
        try {
            if (false === $jobEmploymentForm) {
                $jobEmploymentForm = $this->nlsDirectory->getJobEmploymentForm();
                wp_cache_set($cacheKey, $jobEmploymentForm, 'directory', $this->nlsCacheTime);
            }

            return is_array($jobEmploymentForm) ? $jobEmploymentForm : [];
        } catch (Exception $ex) {
            $this->notice('Model: jobEmploymentForm', $ex->getMessage());
            return null;
        }
    }

    public function jobAreas()
    {
        $this->initDirectoryService();

        $cacheKey = 'JOB_AREAS';
        $jobAreas = wp_cache_get($cacheKey);

        try {
            if (false === $jobAreas) {
                $jobAreas = $this->nlsDirectory->getProfessionalFields();
                wp_cache_set($cacheKey, $jobAreas, 'directory', $this->nlsCacheTime);
            }

            return is_array($jobAreas) ? $jobAreas : [];
        } catch (Exception $ex) {
            $this->notice('Model: jobAreas', $ex->getMessage());
            return null;
        }
    }

    public function jobRanks()
    {
        $this->initDirectoryService();

        $cacheKey = 'JOB_RANKS';
        $jobRanks = wp_cache_get($cacheKey);

        try {
            if (false === $jobRanks) {
                $jobRanks = $this->nlsDirectory->getJobRanks();
                wp_cache_set($cacheKey, $jobRanks, 'directory', $this->nlsCacheTime);
            }

            return is_array($jobRanks) ? $jobRanks : [];
        } catch (Exception $ex) {
            $this->notice('Model: jobRanks', $ex->getMessage());
            return null;
        }
    }

    public function hybrid()
    {
        return [
            [
                'id' => 1,
                'name' => 'Hybrid'
            ]

        ];
    }

    public function studyYearOptions()
    {
        return [
            ['id' => __('First Year', 'NlsHunter'), 'name' => __('First Year', 'NlsHunter')],
            ['id' => __('Second Year', 'NlsHunter'), 'name' => __('Second Year', 'NlsHunter')],
            ['id' => __('Third Year', 'NlsHunter'), 'name' => __('Third Year', 'NlsHunter')],
            ['id' => __('Forth Year', 'NlsHunter'), 'name' => __('Forth Year', 'NlsHunter')],
            ['id' => __('Graduate Year', 'NlsHunter'), 'name' => __('Graduate Year', 'NlsHunter')]
        ];
    }

    public function professionalFields()
    {
        $this->initDirectoryService();

        $cacheKey = 'PROFESSIONAL_FIELD';
        $professionalFields = wp_cache_get($cacheKey);

        try {
            if (false === $professionalFields) {
                $professionalFields = $this->nlsDirectory->getProfessionalFields();
                wp_cache_set($cacheKey, $professionalFields, 'directory', $this->nlsCacheTime);
            }

            return is_array($professionalFields) ? $professionalFields : [];
        } catch (Exception $ex) {
            $this->notice('Model: professionalFields', $ex->getMessage());
            return null;
        }
    }

    public function regions()
    {
        $this->initDirectoryService();

        $cacheKey = 'REGIONS';
        $regions = wp_cache_get($cacheKey);
        try {
            if (false === $regions) {
                $regions = $this->nlsDirectory->getRegions();
                wp_cache_set($cacheKey, $regions, 'directory', $this->nlsCacheTime);
            }

            return is_array($regions) ? $regions : [];
        } catch (Exception $ex) {
            $this->notice('Model: regions', $ex->getMessage());
            return null;
        }
    }

    public function getHotJobs($supplierId = null)
    {
        $supplierId = $supplierId ? $supplierId : $this->nlsConfig->getNlsHotJobsSupplierId();

        $res =  $this->getJobHunterExecuteNewQuery2([], null, 0, $this->nlsConfig->getNlsHotJobsCount(), $supplierId);
        return is_array($res) && key_exists('list', $res) ?  $res['list'] : [];
    }

    private function joinVals($param)
    {
        if (!$param || !is_array($param)) return '';
        return implode('_', $param);
    }

    public function getLocationById($id)
    {
        return $this->getListNameById($this->regions(), $id);
    }

    public function getProfessionalFields($professionalFields, $seperator = ' | ')
    {
        $res = '';
        if (!property_exists($professionalFields, 'JobProfessionalFieldInfo')) return $res;

        $info = $professionalFields->JobProfessionalFieldInfo;
        $categories = $this->categories();

        $infos = is_array($info) ? $info : [$info];

        foreach ($infos as $info) {
            if (gettype($info) === 'object' && property_exists($info, 'CategoryId')) {
                $res .= $this->getListNameById($categories, $info->CategoryId) . $seperator;
            }
        }

        return rtrim($res, ' |');
    }

    private function addSearchTerm(&$arr, $term)
    {
        $field = new FilterField('Description', SearchPhrase::ONE_OR_MORE, $term, NlsFilter::TERMS_NON_ANALAYZED);
        $arr[] = $field;

        $field = new FilterField('Requiremets', SearchPhrase::ONE_OR_MORE, $term, NlsFilter::TERMS_NON_ANALAYZED);
        $arr[] = $field;

        $field = new FilterField('JobTitle', SearchPhrase::ONE_OR_MORE, $term, NlsFilter::TERMS_NON_ANALAYZED);
        $arr[] = $field;

        $field = new FilterField('JobCode', SearchPhrase::EXACT, $term, NlsFilter::TERMS_NON_ANALAYZED);
        $arr[] = $field;
    }

    public function getJobHunterExecuteNewQuery2($searchParams = [], $hunterId = null, $page = 0, $resultRowLimit = null, $supplierId = null)
    {
        $supplierId = $supplierId ? $supplierId : $this->nlsGetSupplierId();
        $resultRowLimit = $resultRowLimit ? $resultRowLimit : $this->nlsConfig->getNlsJobsCount();
        $resultRowOffset = is_int($page) ? $page * $resultRowLimit : false;
        $category = key_exists('category', $searchParams) ? $searchParams['category'] : false;
        $employmentForm = key_exists('employment-form', $searchParams) ? $searchParams['employment-form'] : false;
        $region = key_exists('region', $searchParams) ? $searchParams['region'] : false;
        $employmentType = key_exists('employment-type', $searchParams) ? $searchParams['employment-type'] : false;
        $keyword = key_exists('keyword', $searchParams) ? $searchParams['keyword'] : false;

        $cache_key = 'nls_hunter_jobs_' .
            $this->joinVals($category) . '_' .
            $this->joinVals($employmentForm) . '_' .
            $this->joinVals($region) . '_' .
            $this->joinVals($employmentType) . '_' .
            $resultRowOffset . '_' .
            $resultRowLimit;

        if ($this->nlsFlashCache) wp_cache_delete($cache_key);

        $jobs = wp_cache_get($cache_key);

        if (false === $jobs) {
            if (!$this->initSearchService()) return ['totalHits' => 0, 'list' => []];

            if (!is_array($searchParams)) $jobs = [];
            $filter = new NlsFilter();

            $filter->addSuplierIdFilter($supplierId);

            /**
             * Category
             */
            if ($category) {
                $filterField = new FilterField('JobProfessionalFields', SearchPhrase::EXACT, $category, NlsFilter::NESTED);
                $nestedFilterField = new FilterField('JobProfessionalFieldInfo_CategoryId', SearchPhrase::ALL, $category, NlsFilter::NUMERIC_VALUES);
                $filterField->setNested($nestedFilterField);
                $filter->addWhereFilter($filterField, is_array($filterField) ? WhereCondition::C_OR : WhereCondition::C_AND);
            }

            /**
             * Employment Form
             */
            if ($employmentForm) {
                $filterField = new FilterField('EmploymentForm', SearchPhrase::EXACT, $employmentForm, NlsFilter::TERMS_NON_ANALAYZED);
                $filter->addWhereFilter($filterField, is_array($filterField) ? WhereCondition::C_OR : WhereCondition::C_AND);
            }

            /**
             * Region
             */
            if ($region) {
                $filterField = new FilterField('RegionId', SearchPhrase::EXACT, $region, NlsFilter::NUMERIC_VALUES);
                $filter->addWhereFilter($filterField, is_array($filterField) ? WhereCondition::C_OR : WhereCondition::C_AND);
            }


            /**
             * Employment Type
             */
            if ($employmentType) {
                $filterField = new FilterField('EmploymentType', SearchPhrase::EXACT, $employmentType, NlsFilter::TERMS_NON_ANALAYZED);
                $filter->addWhereFilter($filterField, is_array($filterField) ? WhereCondition::C_OR : WhereCondition::C_AND);
            }

            /**
             * Keywords
             */
            if ($keyword) {
                $keywords = preg_split("/[\s,]+/", $keyword);
                $fields = [];

                foreach ($keywords as $term) {
                    $this->addSearchTerm($fields, $term);
                }
                $filter->addWhereFilter($fields, WhereCondition::C_OR);
            }

            try {
                $res = $this->nlsSearch->JobHunterExecuteNewQuery2(
                    $hunterId,
                    $resultRowOffset,
                    $resultRowLimit,
                    $filter
                );

                $jobs['totalHits'] = property_exists($res, 'TotalHits') ? $res->TotalHits : 0;

                if ($jobs['totalHits'] === 0) {
                    $jobs['list'] = [];
                } else {
                    $jobInfo = property_exists($res, 'Results') && property_exists($res->Results, 'JobInfo') ? $res->Results->JobInfo : false;
                    $jobs['list'] = !$jobInfo ? [] : (is_array($jobInfo) ? $jobInfo : [$jobInfo]);
                }

                wp_cache_set($cache_key, $jobs);
            } catch (Exception $ex) {
                $this->notice('Model: getJobHunterExecuteNewQuery2', $ex->getMessage());
                return null;
            }
        }



        return $jobs;
    }

    public function getCardProfessinalField($cardId)
    {
        if (!$this->initCardService()) return [];

        $professionalFields = $this->nlsCards->cardProfessinalField($cardId);

        return $professionalFields;
    }

    public function filesListGet($parentId)
    {
        if (!$this->initCardService()) return [];

        return $this->nlsCards->filesListGet($parentId);
    }

    /**
     * Get job details by jon id
     * @jobId - the jon id
     */
    public function getJobDetails($jobId)
    {
        if (!$this->initCardService()) return [];

        return $this->nlsCards->jobGet($jobId);
    }

    public function getApplicantCVList($applicantId)
    {
        $cacheKey = 'APPLICANT_CV_' . $applicantId;
        $applicantCvList = wp_cache_get($cacheKey);

        if (false === $applicantCvList) {
            $applicantCvList = [];
            if (!$this->initCardService()) return [];
            $cvList = $this->nlsCards->getCVList($applicantId);

            foreach ($cvList as $cv) {
                $fileInfo = $this->nlsCards->getFileInfo($cv->FileId, $applicantId);
                $applicantCvList[] = $fileInfo->FileGetByFileIdResult;
            }
        }
        return $applicantCvList;
    }

    public function listItemsToSelectOptions($list, $id, $value)
    {
        $options = [];
        if (!$list || !is_array($list) || !$id || !$value) return $options;

        foreach ($list as  $key => $item) {
            if (!is_object($item) || !property_exists($item, $id) || !property_exists($item, $value)) continue;
            $options[] = ['id' => trim($item->$id), 'value' => trim($item->$value)];
        }

        return $options;
    }
}
